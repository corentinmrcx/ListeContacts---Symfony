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

### 3.  Scripts Composer

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
- Ajout d'un script **db** qui éxécute les étapes suivantes :
  - Destruction forcée de la base de données : `php bin/console doctrine:database:drop --force --if-exists`
  - Création de la base de données : `php bin/console doctrine:database:create`
  - Applications des migrations : `php bin/console doctrine:migrations:migrate --no-interaction`
  - Génération des données : `php bin/console doctrine:fixtures:load --no-interaction`
  ```php
  "db": [
      "php bin/console doctrine:database:drop --force --if-exists\n\n",
      "php bin/console doctrine:database:create",
      "php bin/console doctrine:migrations:migrate --no-interaction",
      "php bin/console doctrine:fixtures:load --no-interaction"
  ]
  ```

### 4. DataBase URL
Url pour se connecter a la base de donnée, remplacer par les bonnes données : 
`mysql://votre_user:votre_mdp@serveur:port/nom_database`

### 5. Générateur de Données Factices
- Lancer la création d'un générateur de données :
  `bin/console make:fixtures nomFixtures`
- Lancer création d'une forge de données :
  `bin/console make:factory`

### 6. Utilisateurs et Rôles
- Utilisateur **Tony Stark**
  - **Email** : ``root@example.com``
  - **Mot de passe** : ``test``
  - **Rôle** : ``ROLE_ADMIN``


- Utilisateur **Peter Parker**
  - **Email** : ``user@example.com``
  - **Mot de passe** : ``test``
  - **Rôle** : ``ROLE_USER``

-----------------

**Recharger le fichier de configuration ~/.bash_profile :**
  ```
    source ~/.bash_profile
  ```

-----------------

### Commandes importante 
1. Observer les routes disponibles dans l'environnement de développement : `bin/console debug:router`
2. Observer les routes disponibles dans l'environnement de production : `bin/console debug:router --env=prod`
3. Lancer la création de la base de données : `bin/console doctrine:database:create`
  --> Symfony crée la base de données a partir du .en.local
4. Lancer la construction de la migration : `bin/console make:migration`
5. Lancer l'exécution des migrations : `bin/console doctrine:migrations:migrate`
6. Demander un bundle avec composer : `composer require --dev <nom bundle>`
