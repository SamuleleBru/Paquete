<?php
// Validar que los datos requeridos estén presentes
if (!isset($_POST['cedula']) || empty($_POST['cedula']) || 
    !isset($_POST['nombres']) || empty($_POST['nombres']) ||
    !isset($_POST['apellidos']) || empty($_POST['apellidos'])) {
    header('Location: registrardatos.php?error=campos_requeridos');
    exit;
}

$cedula = trim($_POST['cedula']);
$nombres = trim($_POST['nombres']);
$apellidos = trim($_POST['apellidos']);
$direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$celular = isset($_POST['celular']) ? trim($_POST['celular']) : '';

include_once("Cservicios.php");
$objconsulta = new cCliente;
$resultado = $objconsulta->registrar_cliente($cedula, $nombres, $apellidos, $direccion, $email, $celular);
$success = ($resultado === true);
$error_msg = "";
if (!$success) {
    $error_msg = "Ocurrió un error al registrar el cliente.";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Registro Procesado</title>
<link rel="stylesheet" href="css/estilos.css?v=2">
</head>
<body>
<div class="container">
  <div class="form-container" style="text-align: center; padding: 60px 40px;">
    <?php if ($success): ?>
      <div class="alert alert-success" style="font-size: 1.1rem; margin-bottom: 30px;">
        <strong style="font-size: 1.5rem;">✓</strong><br><br>
        <strong>¡Registro Completado!</strong><br><br>
        El cliente ha sido registrado correctamente.<br><br>
        <small>Redirigiendo en 3 segundos...</small>
      </div>
      <script>
        setTimeout(function() {
          window.location.href = 'index.php';
        }, 3000);
      </script>
    <?php else: ?>
      <div class="alert alert-error" style="font-size: 1.1rem; margin-bottom: 30px;">
        <strong style="font-size: 1.5rem;">✗</strong><br><br>
        <strong>Error al Registrar</strong><br><br>
        <?php echo htmlspecialchars($error_msg, ENT_QUOTES, 'UTF-8'); ?><br><br>
      </div>
      <div class="nav-links">
        <a href="registrardatos.php">Intentar de Nuevo</a>
        <a href="index.php">Ir al Menú</a>
      </div>
    <?php endif; ?>
  </div>
</div>
</body>
</html>
