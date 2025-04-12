<?php

    $dsn = "mysql:host=localhost;dbname=trackstardb";

    $username = "dev";
    $password = "1234";

   try {
    $pdo = new PDO($dsn, $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   } catch (PDOException $e) {
    echo "Connection error". $e->getMessage();
   }