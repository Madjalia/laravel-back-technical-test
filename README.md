# Test Technique – Djoli

## Prérequis
- PHP ≥ 8.1
- Yarn ou npm

## Lancer le projet
```bash
#HTTPS
git clone https://github.com/Madjalia/laravel-back-technical-test.git
#SSH 
git clone git@github.com:Madjalia/laravel-back-technical-test.git
cd laravel-back-technical-test
cd back-orders

npm install
# ou
yarn install

php artisan migrate
php artisan serve
```


# IA utilisées
- Chat GPT
  
### Contexte d'utilisation 
- Aide pour corriger les erreurs de validation et relations
- Assistance dans la structure des tables


### Prompts:
- Je voudrais que mon projet laravel me renvoi que des reponses json pour mes requêtes API. Actuellement il me retourne du html quand il y a une erreur dans la requête. Comment je peux configuer mon projet pour ne recevoir que du json pour les erreurs aussi 

- Est ce que c'est une bonne méthode de recalculer subtotal et total dans la méthode store du back plutôt que de les recevoir du frontend ? dis moi les avantages et inconvénients.

- J'ai une erreur dans la consommation de la méthode post de mon API local laravel sur le fontend react, avec la consommation d'une autre API externe. Voici la methode store dans laravel (le code de ma méthode store) et la consommation niveau react (le code de consommation frontend), tu peux me trouver l'erreur ?