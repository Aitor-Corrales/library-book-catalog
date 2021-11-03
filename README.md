# library-book-catalog

This web application aims to be a solution for a book-management problem.

## Installation

### Initial steps

Clone the [repository](https://github.com/Aitor-Corrales/library-book-catalog).

```bash
git clone https://github.com/Aitor-Corrales/library-book-catalog.git
```

Inside Symfony folder, create a file '.env.local' that will store the database connection string.

```text
DATABASE_URL=mysql://root:password@mysql:3306/main?sslmode=disable&charset=utf8mb4
```

Once the repository is cloned, initiate docker containers using the 'docker-compose.yaml' file, stored in the root
folder.

```bash
docker-compose up -d --build
```

### setting up the project

The first time, a series of instructions must be carried out on php and mysql containers, in order:

PHP Container: Install the vendors of the project

```bash
composer install
```

MySql Container: Create the Database 'main'.

```bash
CREATE DATABASE main CHARACTER SET utf8 COLLATE utf8_unicode_ci;
```

PHP Container: Create the tables with Doctrine's migration tools.

```bash
php bin/console doctrine:migrations:migrate
```

MySql Container: Use the database created previously.

```bash
USE main;
```

(For these testing purposes, there is a dump stored in Dump folder, which is un the root folder)