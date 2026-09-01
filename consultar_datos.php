<?php
require_once("config.php");

// Validar que se haya enviado una cédula
if (!isset($_POST['cedula']) || empty($_POST['cedula'])) {
    header('Location: ingresar_cedula.php');
    exit;
}

$cedula = $_POST['cedula'];

// Conexión a la base de datos
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// 1. Consultar datos personales del cliente
$sql_cliente = "SELECT * FROM clientes WHERE cedula = ?";
$stmt = $conexion->prepare($sql_cliente);
$stmt->bind_param("s", $cedula);
$stmt->execute();
$res_cliente = $stmt->get_result();
$cliente = $res_cliente->fetch_assoc();
$stmt->close();

// 2. Consultar movimientos (pagos) del cliente
$sql_movimientos = "SELECT * FROM movimientos WHERE cedula = ?";
$stmt = $conexion->prepare($sql_movimientos);
$stmt->bind_param("s", $cedula);
$stmt->execute();
$res_movimientos = $stmt->get_result();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Resultado de la Consulta</title>
<link rel="stylesheet" href="css/estilos.css?v=2">
</head>
<body>
<div class="container">
    <div class="table-container">

<?php if ($cliente): ?>
    <h2>Información del Cliente</h2>
    <table>
        <tbody>
            <tr>
                <th style="width: 30%; text-align: left; background: #f8f9fa;">Cédula</th>
                <td><?php echo htmlspecialchars($cliente['cedula'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <tr>
                <th style="width: 30%; text-align: left; background: #f8f9fa;">Nombres</th>
                <td><?php echo htmlspecialchars($cliente['nombres'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <tr>
                <th style="width: 30%; text-align: left; background: #f8f9fa;">Apellidos</th>
                <td><?php echo htmlspecialchars($cliente['apellidos'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <tr>
                <th style="width: 30%; text-align: left; background: #f8f9fa;">Dirección</th>
                <td><?php echo htmlspecialchars($cliente['direccion'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <tr>
                <th style="width: 30%; text-align: left; background: #f8f9fa;">Email</th>
                <td><?php echo htmlspecialchars($cliente['email'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <tr>
                <th style="width: 30%; text-align: left; background: #f8f9fa;">Celular</th>
                <td><?php echo htmlspecialchars($cliente['celular'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
        </tbody>
    </table>

    <h2>Historial de Movimientos</h2>

    <table>
        <thead>
            <tr>
                <th>Valor Pagado</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        if ($res_movimientos && $res_movimientos->num_rows > 0) {
            while ($movimiento = $res_movimientos->fetch_assoc()) { 
        ?>
            <tr>
                <td><?php echo htmlspecialchars($movimiento['valor_pagado'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($movimiento['fecha'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
        <?php 
            } 
        } else { 
        ?>
            <tr>
                <td colspan="2" style="text-align: center; color: #666;">No se encontraron movimientos registrados.</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php else: ?>
    <div class="alert alert-error">
        <strong>Cliente No Encontrado</strong><br>
        No se encontró ningún cliente registrado con la cédula: <strong><?php echo htmlspecialchars($cedula, ENT_QUOTES, 'UTF-8'); ?></strong>
    </div>
<?php endif; ?>

    <br />
    <div class="nav-links">
        <a href="ingresar_cedula.php">Nueva Consulta</a> 
        <a href="index.php">Regresar al Menú</a>
    </div>
    </div>
</div>
</body>
</html>
</div>

</body>
</html>