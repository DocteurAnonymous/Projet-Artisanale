<?php

    function connectionDB () {

        $server = "localhost";   
        $username = "root";      
        $password = "";          
        $dbname = "projet_artisanale"; 
        $port = "3306";   
        
        try {

            $pdo = new PDO("mysql:host=$server;port=$port;dbname=$dbname",$username,$password);
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            return $pdo; 


        } catch (PDOException $error) {
            
            die($error);
        } 

        
    }
