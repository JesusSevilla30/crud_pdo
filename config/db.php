<?php
    //  Cargar la configuracion
    $config = require __DIR__ . "/config.php";
    
    $host = $config["DB_HOST"];
    $dbname = $config["DB_NAME"];
    $user = $config["DB_USER"];
    $pass = $config["DB_PASS"];
    $charset = $config["DB_CHARSET"];

    // Opciones reocmendadas de PDO
    $options=[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Modo de error de PDO: Excepciones try-catch
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //Llamar los datos en tablas
        PDO::ATTR_EMULATE_PREPARES => false, //No usar otros drivers de base de datos, usar el nativo de MySQL
    ];

    try {
        //motor +host +nombre db +charset
        $dsn = "mysql:host=$host; dbname=$dbname; charset=$charset";

        $pdo = new PDO($dsn, $user, $pass, $options);

    } catch (PDOException $e) {

        die("Error en la conexion a la base de datos: " . $e->getMessage());
        
    }

?>