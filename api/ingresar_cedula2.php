<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Actualizar Cliente</title>
<link rel="stylesheet" href="css/estilos.css?v=2">
</head>
<body>
<div class="container">
  <div class="form-container">
    <div class="form-title">Actualizar Datos de Cliente</div>
    <form id="form1" name="form1" method="post" action="actualizardatos.php">
      <div class="form-group">
        <label for="cedula">Cédula a Actualizar</label>
        <input type="text" id="cedula" name="cedula" required />
      </div>
      <div class="btn-container">
        <button type="submit" class="btn btn-primary">Cargar Datos</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>