<?php 

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    define("DBSeedScript", "sql/generateSeedScript.sql"); // script with all queries to create the tables and initialize the db
    define("DBUpdateSeedScript", "sql/updateSeedScript.sql"); // script with all alter tables to update the db structure
    define("HOST", "localhost");
    define("USER", "root");
    define("PASS", "");
    define("DBNAME", "testAPI");