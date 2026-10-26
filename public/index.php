<?php

require_once __DIR__ . "/../config/db.php";

// Declaracion de la consulta
$consulta="SELECT id, nombre, email, created_at FROM alumnos ORDER BY id DESC";

// Ejecucion de la consulta
$stmt= $pdo->query($consulta);
$alumnos= $stmt->fetchAll(); // Traer todos los registros de la tabla alumnos

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="./CSS/estilos.css">
</head>
<body>
    <h1>CRUD con PDO (Alumno)</h1>
    <h2>Listado</h2>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Validar si hay registros en la tabla alumnos -->
            <?php if(count($alumnos)=== 0 ): ?>
                <tr><td>No tenemos registros</td></tr>
            <?php else:?>
                <!--  Recorrer el array de alumnos y mostrar los datos en la tabla -->
                <?php foreach($alumnos as $a): ?>
                    <tr>
                        <td><?=htmlspecialchars($a['id'])?></td>
                        <td><?=htmlspecialchars($a['nombre']) ?></td>
                        <td><?=htmlspecialchars($a['email']) ?></td>
                        <td><?=htmlspecialchars($a['created_at']) ?></td>
                        <td>
                            <!-- Enlace para editar y eliminar el registro del alumno -->
                            <a href="edit.php?id=<?=htmlspecialchars($a['id'])?>">Editar</a>
                                <!-- Enlace para eliminar el registro del alumno -->
                                <a href="delete.php?id=<?=htmlspecialchars($a['id'])?>" 
                                onclick="return confirm('¿Quieres eliminar el resgitro?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif?>
        </tbody>
    </table>
</body>
</html>