<?php

namespace App\Security;

use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class UserAuthenticator extends AbstractGuardAuthenticator
{
    private $loPasswordEncoder;
    private $loJWThandle;
    private $loTokenExtrtact;
    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        JWTTokenManagerInterface $poJWThandle,
        JWTEncoderInterface $loTokenExtract
    )
    {
        $this->loJWThandle = $poJWThandle;
        $this->loPasswordEncoder = $passwordEncoder;
        $this->loTokenExtrtact = $loTokenExtract;
    }

    public function supports(Request $request)
    {
        return $request->headers->has('windoo-client-token') || $request->headers->has('windoo-login-client') ? true : false;
    }
    public function getCredentials(Request $request)
    {

        if($request->headers->has('windoo-client-token')) { //if user connect with token
            try{
                return [
                    'token' => $this->loTokenExtrtact->decode($request->headers->get('windoo-client-token'))
                ];
            } catch(JWTDecodeFailureException $loException) {
                throw new CustomUserMessageAuthenticationException('Your token is not valid');
            }

        }

        if($request->headers->has('windoo-login-client') && $request->isMethod('POST')) { // if user connect with username and password

            return [
                'username' => $request->request->get('username'),
                'password' => $request->request->get('password')
            ];
        }

        return null;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if(isset($credentials['token'])) {
            if($userProvider->loadUserByUsername($credentials['token']['username']) !== false) {
                return $userProvider->loadUserByUsername($credentials['token']['username']);
            }
        }
        if( isset($credentials['username'])) {
            if($userProvider->loadUserByUsername($credentials['username']) !== false) {
                return $userProvider->loadUserByUsername($credentials['username']);
            }
        }
        throw new CustomUserMessageAuthenticationException('Email could not be found.');
    }
    public function checkCredentials($credentials, UserInterface $user)
    {
        if(isset($credentials['token'])) {
            return true;
        }

        if( isset($credentials['username'])) {
            return $this->loPasswordEncoder->isPasswordValid($user, $credentials['password']);
        }

        return false;
    }
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = [
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        ];
        return new JsonResponse($data, Response::HTTP_FORBIDDEN);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        if($request->headers->has('windoo-login-client') && $request->isMethod('POST')) { // if user connect with username and password
            return new JsonResponse(['token'=>$this->loJWThandle->create($token->getUser())]);
        }
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new JsonResponse(
            ['message' => 'Illegal Access, Merci de vérifié votre Header','@type' => 'IllegalAccess'],Response::HTTP_FORBIDDEN);
    }
    public function supportsRememberMe()
    {
        // todo
    }
}
