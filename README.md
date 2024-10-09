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