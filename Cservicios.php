<?php
require_once("config.php");

class cCliente
{

	function registrar_cliente($cedula,$nombres,$apellidos,$direccion,$email,$celular)
	{
        $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conexion->connect_error) {
          die("conexion fallida" . $conexion->connect_error);
        }
        
        // Usar prepared statement para prevenir SQL Injection
        $sql = "INSERT INTO clientes (cedula, nombres, apellidos, direccion, email, celular) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conexion->prepare($sql);
        if (!$stmt) {
            echo "Error en preparación: " . $conexion->error;
            return false;
        }
        
        $stmt->bind_param("ssssss", $cedula, $nombres, $apellidos, $direccion, $email, $celular);
        
        if($stmt->execute()){
          $stmt->close();
          $conexion->close();
          return true;
        }
        else{
                echo "Error al insertar los datos: " . $stmt->error;
                $stmt->close();
                $conexion->close();
                return false;
        }
	}
}
