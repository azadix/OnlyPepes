<?php  
    class Database {
        private $host;
        private $login;
        private $pass;
        private $databaseName;
        
        protected $connection;

        function __construct($tempHost = "localhost", $tempLogin="admin", $tempPass = "admin", $tempDatabasebName="bartiseznux96_onlypepes") {
            $this->host = $tempHost;
            $this->login = $tempLogin;
            $this->pass = $tempPass;
            $this->databaseName = $tempDatabasebName;
        }

        function getDatabaseName(){
            return $this->databaseName;
        }

        function connect(){
            $this->connection = new mysqli($this->host, $this->login, $this->pass, $this->databaseName);
            if (!$this->connection) {
                return $this->connection;
            }
        }

        function query($sqlQuery) {
            return mysqli_query($this->connection, $sqlQuery);
        }
    }