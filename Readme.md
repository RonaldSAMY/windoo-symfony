#Installation de Projet

#Generation de clé ssh pour sécurité
_`mkdir -p config/jwt`_

_`openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096`_

_`openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout`_