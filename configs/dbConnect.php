<?php
    $configFile = file_get_contents('./configs/config.json');
    $globalConfigs = json_decode($configFile, true);

    $dbConfig = $globalConfigs["database"];

    $connection = new PDO('mysql:host='.$dbConfig["host"].";port=". $dbConfig['port'] .';dbname='. $dbConfig['db_name'],
     $dbConfig['user'] , $dbConfig['password']);
