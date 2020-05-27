<html><head><title>Setting up database</title></head><body>

<h3>Setting up...</h3>

<?php
require_once 'functions.php';

createTable($db_connect, 'users', 
            'id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP');

createTable($db_connect, 'admin',
            'id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(50) NOT NULL');


mysqli_close($db_connect);

?>
<br />...done.
</body></html>