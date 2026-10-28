<?php
    require_once __DIR__ . "/../config/db.php";
    $error = "";
    
    $id=(int)($_GET['id'] ?? 0);
    if ($id <= 0) {
        die("ID inválido");
    }
    //1. Tomar el id
    $consulta = "SELECT id, nombre, email FROM alumnos WHERE id=:id";
    $stmt = $pdo->prepare($consulta);
    $stmt->execute([":id"=>$id]);
    $alumno= $stmt->fetch();

    

    if(!$alumno){
        die("Alumno no encontrado");
    }
    //si se envian datos por el formulario haremos edicion
    if($_SERVER["REQUEST_METHOD"] === "POST"){  
        
    //2. Tomar los datos del formulario
        $nombre = trim($_POST["Nombre"] ?? "");
        $email = trim($_POST["Email"] ?? "");


        //3. Validar los datos
        if($nombre === "" || $email === ""){
            $error = "Todos los campos son obligatorios";

            //4. Actualizar los datos en la base de datos
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = "Email inválido";
            
        }else{
            try{    
                //hace la actualización de los datos en la base de datos
                $sql = "UPDATE alumnos SET nombre=:nombre, email=:email WHERE id=:id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ":nombre"=>$nombre, 
                    ":email"=>$email, 
                    ":id"=>$id
                ]);
                //redirecciona a la página de inicio
                header("Location: index.php");
                exit;
                //si hay un error en la consulta, se captura la excepción y se muestra un mensaje de error
            }catch(PDOException $e){
                $error = "Error al actualizar el alumno: " . $e->getMessage();

            }
        }

    }else{
        //cargar datos del alumno
        $nombre = $alumno["nombre"];
        $email = $alumno["email"];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Editar Alumno</h1>
    <a href="index.php">Inicio</a>
    <?php if($error): ?>
        <p><?=htmlspecialchars($error) ?></p>
    <?php endif; ?>    
    <form method="post">
        <p>ID que modificare  <?php echo($id); ?></p>
        
        <label for="nombre">Nombre:</label>
        <input type="text" name="Nombre" value="<?=htmlspecialchars($nombre) ?>">
        <br>

        <label for="email">Email:</label>
        <input type="email" name="Email" value="<?=htmlspecialchars($email) ?>">
        <br>

        <input type="submit" value="Actualizar">

    </form>
</body>
</html>