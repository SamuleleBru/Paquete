<?php
require_once "config.php";

class cCliente
{
    function registrar_cliente($cedula, $nombres, $apellidos, $direccion, $email, $celular)
    {
        try {
            $pdo = getDbConnection();

            $stmt = $pdo->prepare(
                "CALL registrar_cliente(:p_cedula, :p_nombres, :p_apellidos, :p_direccion, :p_email, :p_celular)"
            );
            $stmt->execute([
                ':p_cedula' => $cedula,
                ':p_nombres' => $nombres,
                ':p_apellidos' => $apellidos,
                ':p_direccion' => $direccion,
                ':p_email' => $email,
                ':p_celular' => $celular,
            ]);

            return true;
        } catch (Throwable $e) {
            echo "Error al insertar los datos: " . $e->getMessage();
            return false;
        }
    }
}
