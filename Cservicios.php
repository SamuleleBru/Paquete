<?php
require_once "config.php";

class cCliente
{
    function registrar_cliente($cedula, $nombres, $apellidos, $direccion, $email, $celular)
    {
        try {
            $pdo = getDbConnection();

            $sql = "INSERT INTO clientes (cedula, nombres, apellidos, direccion, email, celular)
                    VALUES (:cedula, :nombres, :apellidos, :direccion, :email, :celular)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':cedula' => $cedula,
                ':nombres' => $nombres,
                ':apellidos' => $apellidos,
                ':direccion' => $direccion,
                ':email' => $email,
                ':celular' => $celular,
            ]);

            return true;
        } catch (Throwable $e) {
            echo "Error al insertar los datos: " . $e->getMessage();
            return false;
        }
    }
}
