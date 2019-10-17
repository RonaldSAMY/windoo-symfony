<?php

namespace App\Controller;

use App\Entity\Idea;
use App\Form\IdeaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class IdeaController extends AbstractController
{
    private $loSerializer;
    /**
     * @var EntityManagerInterface $em
     */
    private $em;

    public function __construct(EntityManagerInterface $poEm,SerializerInterface $poSerializer)
    {
        $this->em = $poEm;
        $this->loSerializer = $poSerializer;
    }

    /**
     * @Route("/idea/all", name="idea_all")
     */
    public function index()
    {
        $loIdeaRepo = $this->em->getRepository(Idea::class);
        $laIdeas = $loIdeaRepo->findAll();

        return new Response($this->loSerializer->serialize($laIdeas,'json'),Response::HTTP_OK);
    }

    /**
     * @Route("/idea/add", name="idea_add")
     */
    public function addIdea(Request $poRequest)
    {
        $loIdea = new Idea();
        $loForm = $this->createForm(IdeaType::class,$loIdea);
        $laFormResult = json_decode($poRequest->getContent(),true);
        $loForm->submit($laFormResult);
        $loIdea->setDateCreation(new \DateTime('now'));
        $loIdea->setClient($this->getUser());
        $this->em->persist($loIdea);
        $this->em->flush();
        return New Response($this->loSerializer->serialize($loIdea,'json'),Response::HTTP_CREATED);
    }

    /**
     * @Route("/idea/{id}/vote", name="idea_vote")
     */
    public function voteIdea()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/IdeaController.php',
        ]);
    }

    /**
     * @Route("/idea/{id}/delete", name="idea_delete")
     */
    public function deleteIdea()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/IdeaController.php',
        ]);
    }
}
