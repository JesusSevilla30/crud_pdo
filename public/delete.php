<?php
    require_once __DIR__ . "/../config/db.php";
    //1. Tomar el id
    $id=(int)($_GET['id'] ?? 0);
    //2. Validar si el id es mayor a 0
    if ($id <= 0) {
        die("ID inválido");
    }

    //3. Eliminar con una consulta preparada
    $query = "DELETE FROM alumnos WHERE id=:id";
    //se guarda la consulta en una variable y se prepara para su ejecución
    $stmt=$pdo->prepare($query);

    //4. Ejecutar la consulta
    $stmt->execute([":id"=>$id]);

    header("Location: index.php");
    exit;
?>