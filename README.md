# SnowTricks
 [![Codacy Badge](https://api.codacy.com/project/badge/Grade/a5fd2402405e41d4b8ae07f636766c02)](https://www.codacy.com/manual/cedflam/SnowTricks?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=cedflam/SnowTricks&amp;utm_campaign=Badge_Grade)
 #### Community site SnowTricks
SnowTricks is a sharing website about snowboard tricks. This project was built during my [web develpment learning](https://openclassrooms.com/paths/developpeur-se-d-application-php-symfony) with OpenClassrooms. 
 This application is built with Symfony ~5.0
## Built with
##### Back-end
* Symfony 5
* Doctrine 

 ##### Front-end
* Twig
* Jquery
* Bootstrap
## Install
 1. Clone or download the repository into your environment.   
 2. Run "composer install" in terminal
 3. Install the database (php bin/console doctrine:database:create) and load migration (php bin/console doctrine:migrations:migrate) or import directly snowtricks.sql with phpMyAdmin.
 
     
 NOTE : 
parameters:
    env(DATABASE_URL): 'mysql://db_user:db_password@127.0.0.1:3306/db_name'
   ## connexion with user : email = max@gmail.com pass = password
 
