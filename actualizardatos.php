<?php
require_once("config.php");

// Conexión a la base de datos
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$mensaje = "";
$cliente = null;

// 1. SI SE ENVIÓ EL FORMULARIO DE EDICIÓN (Guardar cambios)
if (isset($_POST['btn_guardar'])) {
    $cedula    = $_POST['cedula'];
    $nombres   = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $email     = $_POST['email'];
    $celular   = $_POST['celular'];

    // Usar prepared statement para prevenir SQL Injection
    $sql_update = "UPDATE clientes SET 
                    nombres = ?, 
                    apellidos = ?, 
                    direccion = ?, 
                    email = ?, 
                    celular = ? 
                   WHERE cedula = ?";
    
    $stmt = $conexion->prepare($sql_update);
    $stmt->bind_param("ssssss", $nombres, $apellidos, $direccion, $email, $celular, $cedula);
    
    if ($stmt->execute()) {
        $mensaje = "<div class='alert alert-success'><strong>¡Datos actualizados correctamente!</strong></div>";
    } else {
        $mensaje = "<div class='alert alert-error'><strong>Error al actualizar:</strong> " . $stmt->error . "</div>";
    }
    $stmt->close();

    // Volver a cargar los datos actualizados para mostrarlos en el formulario
    $sql_select = "SELECT * FROM clientes WHERE cedula = ?";
    $stmt = $conexion->prepare($sql_select);
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $res = $stmt->get_result();
    $cliente = $res->fetch_assoc();
    $stmt->close();
} 
// 2. SI SE LLEGA DESDE `ingresar_cedula2.php` (Buscar cliente a editar)
else if (isset($_POST['cedula']) && !empty($_POST['cedula'])) {
    $cedula = $_POST['cedula'];
    $sql_select = "SELECT * FROM clientes WHERE cedula = ?";
    $stmt = $conexion->prepare($sql_select);
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $res = $stmt->get_result();
    $cliente = $res->fetch_assoc();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Actualizar Datos del Cliente</title>
<link rel="stylesheet" href="css/estilos.css?v=2">
</head>
<body>
<div class="container">
  <div class="form-container">
    <div class="form-title">Actualizar Datos de Cliente</div>

    <?php echo $mensaje; ?>

    <?php if ($cliente): ?>
    <form id="form1" name="form1" method="post" action="actualizardatos.php">
      
      <div class="form-group">
        <label for="cedula">Cédula (No editable)</label>
        <input type="text" id="cedula" name="cedula" value="<?php echo htmlspecialchars($cliente['cedula'], ENT_QUOTES, 'UTF-8'); ?>" readonly />
      </div>

      <div class="form-group">
        <label for="nombres">Nombres</label>
        <input type="text" id="nombres" name="nombres" value="<?php echo htmlspecialchars($cliente['nombres'], ENT_QUOTES, 'UTF-8'); ?>" required />
      </div>

      <div class="form-group">
        <label for="apellidos">Apellidos</label>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo htmlspecialchars($cliente['apellidos'], ENT_QUOTES, 'UTF-8'); ?>" required />
      </div>

      <div class="form-group">
        <label for="direccion">Dirección</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($cliente['direccion'], ENT_QUOTES, 'UTF-8'); ?>" />
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($cliente['email'], ENT_QUOTES, 'UTF-8'); ?>" />
      </div>

      <div class="form-group">
        <label for="celular">Celular</label>
        <input type="text" id="celular" name="celular" value="<?php echo htmlspecialchars($cliente['celular'], ENT_QUOTES, 'UTF-8'); ?>" />
      </div>

      <div class="btn-container">
        <button type="submit" name="btn_guardar" class="btn btn-primary">Actualizar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
      </div>
    </form>
    <?php else: ?>
      <div class="alert alert-warning">
        <strong>Cliente No Encontrado</strong><br>
        No se encontró ningún cliente para editar.
      </div>
      <div class="nav-links">
        <a href="ingresar_cedula2.php">Intentar de nuevo</a> 
        <a href="index.php">Regresar al Menú</a>
      </div>
    <?php endif; ?>
  </div>
</div>
</body>
</html>