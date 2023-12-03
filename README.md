# Homework 3 Back End
This repo contains the back-end component to our functional RevMixer React Application. The backend component (and its set up) be found here:https://github.com/C-h-ris-2/revmixerfrontend.


# Repo Structure: 
* Controller
    * Api
        * BaseController.php
        * UserController.php
* inc
    * bootstrap.php
    * config.php
* Model
    * Database.php
    * SongModel.php
    * UserModel.php
* index.php
* README.md

# Configuration: 

1) Start servers on XAMPP

2) create the database named "users_hw2" in phpmyadmin and create the following two tables:

```zsh
CREATE TABLE users (username VARCHAR(255), password VARCHAR(255))
CREATE TABLE ratings (id INT(11) PRIMARY KEY AUTO_INCREMENT, username VARCHAR(255), artist VARCHAR(255), song VARCHAR(255), rating INT(1))
```

3) Test configuration by running lines on Postman.

# Team contributions:
- Christian Diaz Herrera: 65%
- Cristi Gonzalez 35%

