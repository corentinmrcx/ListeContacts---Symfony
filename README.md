# Symfony Contacts
## MARCOUX Corentin
## Installation / Configuration

### 1. Installation de Symfony

- Installation de l'éxécutable de **Symfony** :
    ``wget https://get.symfony.com/cli/installer -O - | bash``
- Vérification du bon fonctionnement de l'exécutable **Symfony** : ``symfony self:version``
- Contrôler la compatibilité du system : ``symfony check:requirements  --verbose``

### 2. Création d'un projet Symfony

- Vérification que **Composer** fonctionne correctement : ``composer about``
- Mise a jour de **Composer** : ``composer self-update``
- Création d'un nouveau projet **Symfony** : ``symfony --version 6.3 --webapp new symfony-contacts``
- Lancer le serveur **Symfony** : ``symfony serve``


```
Lancer un projet phpstorm a partir du terminal :
phpstorm . &
```

### 3.  Mise en place de scripts Composer

- Ajout d'un script **Start** qui lance le serveur Web de test
    ```
    "start": [
            "Composer\\Config::disableProcessTimeout",
            "symfony serve"
    ],
   ```
- Ajout d'un script **test:phpcs** qui lance la commande de vérification du code :
    ```
    "test:phpcs": [
        "php vendor/bin/php-cs-fixer fix --dry-run"
    ],
  ```
- Ajout d'un script **fix:phpcs** qui lance la commande de correction du code : 
    ```
    "fix:phpcs": [
        "php vendor/bin/php-cs-fixer fix"
    ],
  ```
- Ajout d'un script **test:twigcs** qui lance la commande de vérification du code par Twig CS Fixer :
    ```
    "test:twigcs": [
        "php vendor/bin/twig-cs-fixer lint"
    ],
    ```
- Ajout d'un script **fix:twigcs** qui lance la commande de correction du code par Twig CS Fixer :
    ```
    "fix:twigcs": [
        "php vendor/bin/twig-cs-fixer fix"
    ]
    ```
- Ajout d'un script **test:codeception** qui nettoie le répertoire *_output* et lance les tests de Coception :
  ```
  "test:codeception": [
    "codecept clean",
    "php vendor/bin/codecept run"
  ],
  ```
- Ajout d'un script **test** qui test la mise en forme du code PHP, TWIG et lance les test avec Codeception : 
    ```
    "test": [
        "@test:phpcs", "@test:twigcs", "@test:codeception"
    ]
    ```

### 4. DataBase URL
Url pour se connecter a la base de donnée, remplacer par les bonnes données : 
`mysql://votre_user:votre_mdp@serveur:port/nom_database`





