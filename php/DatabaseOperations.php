<?php
    define('ROOT_DIR', realpath(__DIR__.'/..'));

    global $connection; 

    function connectToMYSQL($dbName = false){
        $hostDB = 'localhost';
        $usernameDB = 'admin';
        $passwordDB = 'admin';

        if ($_SERVER['HTTP_HOST'] !== 'localhost'){
            require "creds.php";
        }
        
        
        // Connect to db using mysqli
        //TODO - Fix connecting to database, maybe OO
        if ($dbName){
            $connection = new mysqli($hostDB, $usernameDB, $passwordDB, $dbName);
        } else {
            $connection = new mysqli($hostDB, $usernameDB, $passwordDB);
        }
        
        //Check if connection was made
        if (!$connection) {
            die("Error: connection to database wasn't established");
        }
        return $connection;
    }

    function getQueryIfDatabaseExists($dbName){
        //Function returns query to check if database exists
        return "
            SELECT
                *
            FROM
                INFORMATION_SCHEMA.TABLES
            WHERE
                TABLE_SCHEMA = '{$dbName}'
        ";
    }

    function getQueryIfTableExists($dbName, $tableName, $columnName = false){
        //Function returns query to check if given table exists in database. It can also check if column exists if you pass the $columnName argument
        $qr = "
            SELECT
                *
            FROM
                INFORMATION_SCHEMA.TABLES
            WHERE
                TABLE_SCHEMA = '{$dbName}'
            AND
                TABLE_NAME = '{$tableName}'
        ";

        if ($columnName){
            $qr .= " AND COLUMN_NAME = '{$columnName}'";
        }
        return $qr;
    }

    $connection = connectToMYSQL("bartiseznux96_onlypepes");
    //Create database if doesn't exist and recreate connection if it does 
    if (!$connection->query(getQueryIfDatabaseExists("bartiseznux96_onlypepes"))){
        $connection = connectToMYSQL("bartiseznux96_onlypepes");
    } else {
        $connection->query(file_get_contents(ROOT_DIR . "/sql/createDatabase.sql"));
    };


    //Create table if doesn't exist and database is present
    if ($connection->query(getQueryIfTableExists("bartiseznux96_onlypepes", "pepelist"))) {
        $connection->query(file_get_contents(ROOT_DIR . "/sql/createTable.sql"));
    }
