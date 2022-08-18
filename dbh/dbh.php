<?php


// local connection
define('HOST_SERVER', 'localhost:3308');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'appraisal');


// define('HOST_SERVER', 'localhost');
// define('DB_USER', 'ngs');
// define('DB_PASSWORD', 'Ngsappdb123$');
// define('DB_NAME', 'appraisal');




// use PDO to make connection to database

    $dsn = "mysql:host=" . HOST_SERVER . ";dbname=" . DB_NAME;

    try {
        
        $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    }
    catch (POOException $e) {
        echo $e->getMessage();
    }
    
