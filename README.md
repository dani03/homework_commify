# Tax Calculator

## français
Ce document explique comment configurer et exécuter le projet Tax Calculator. 
Suivez attentivement les étapes pour garantir une installation correcte. 
Deux méthodes d'installation sont disponibles: avec Makefile (recommandée) ou manuellement.

---

## Installation avec Makefile (recommandée)

1. Naviguez jusqu'au dossier du projet à l'aide d'un terminal.
2. Exécutez la commande suivante: `make build`. Cela va compiler et préparer le projet.
3. Lancez la commande suivante pour compiler les assets front-end dans un autre terminal du meme dossier: `npm run dev`.
4. Vous pouvez maintenant tester le projet.

---

## Installation manuelle

### Prérequis

Assurez-vous que les outils suivants sont installés sur votre machine:

- PHP
- Composer
- NPM
- Laravel

### Étapes

1. **Télécharger le projet:**

    - Clonez ou téléchargez le projet sur votre machine.

2. **Naviguer dans le dossier du projet:**

    - Ouvrez un terminal et accédez au dossier du projet.

3. **Installer les dépendances:**

    - Exécutez la commande: `composer install`.
    - Puis exécutez: `npm install`.

4. **Configurer le fichier d'environnement:**

    - Copiez le fichier `.env.example` et renommez-le en `.env`.

5. **Générer la clé de l'application:**

    - Utilisez la commande: `php artisan key:generate`.

6. **Initialiser la base de données:**

    - Lancez: `php artisan migrate --seed`.
    - Le prompt proposera de créer une base de données SQLite. Tapez `yes` pour confirmer, ou configurez une base MySQL selon vos besoins.
    - Cette commande initialise la base de données et y ajoute des données essentielles.

7. **Démarrer le serveur PHP:**

    - Utilisez: `php artisan serve`.
    - Ou pour un port spécifique: `php artisan serve --port [exemple: 3000]`.
    -  Pour lancer les tests `php artisan test`

8. **Compiler les assets front-end:**

    - Exécutez: `npm run dev`.

9. **Tester le projet:**

    - Copiez l’URL affichée dans votre navigateur.
    - Le calculateur de taxes est prêt à être utilisé.

---



# Tax Calculator

## english.

This document explains how to set up and run the Tax Calculator project.  
Follow the steps carefully to ensure proper installation.  
Two installation methods are available: using Makefile (recommended) or manually.

---

## Installation Using Makefile (Recommended)

1. Navigate to the project folder using a terminal.
2. Run the following command: `make build`. This will compile and prepare the project.
3. Run the following command in another terminal within the same folder to build the front-end assets: `npm run dev`.
4. You can now test the project.

---

## Manual Installation

### Prerequisites

Ensure the following tools are installed on your machine:

- PHP
- Composer
- NPM
- Laravel

### Steps

1. **Download the Project:**

    - Clone or download the project to your machine.

2. **Navigate to the Project Folder:**

    - Open a terminal and navigate to the project folder.

3. **Install Dependencies:**

    - Run the command: `composer install`.
    - Then run: `npm install`.

4. **Set Up the Environment File:**

    - Copy the `.env.example` file and rename it to `.env`.

5. **Generate the Application Key:**

    - Use the command: `php artisan key:generate`.

6. **Initialize the Database:**

    - Run: `php artisan migrate --seed`.
    - The prompt will offer to create a SQLite database. Type `yes` to confirm, or configure a MySQL database if needed.
    - This command initializes the database and adds essential data.

7. **Start the PHP Server:**

    - Use: `php artisan serve`.
    - Or for a specific port: `php artisan serve --port [e.g., 3000]`.
    - For running tests `php artisan test`

8. **Build the Front-End Assets:**

    - Run: `npm run dev`.

9. **Test the Project:**

    - Copy the URL displayed into your browser.
    - The tax calculator is now ready to use.

---
