<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Registrar Cliente</title>
<link rel="stylesheet" href="css/estilos.css?v=2">
</head>
<body>
<div class="container">
  <div class="form-container">
    <div class="form-title">Registrar Nuevo Cliente</div>
    <form id="form1" name="form1" method="post" action="recibe_datos.php">
      
      <div class="form-group">
        <label for="cedula">Cédula</label>
        <input type="text" id="cedula" name="cedula" required />
      </div>

      <div class="form-group">
        <label for="nombres">Nombres</label>
        <input type="text" id="nombres" name="nombres" required />
      </div>

      <div class="form-group">
        <label for="apellidos">Apellidos</label>
        <input type="text" id="apellidos" name="apellidos" required />
      </div>

      <div class="form-group">
        <label for="direccion">Dirección</label>
        <input type="text" id="direccion" name="direccion" />
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" />
      </div>

      <div class="form-group">
        <label for="celular">Celular</label>
        <input type="text" id="celular" name="celular" />
      </div>

      <div class="btn-container">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>
