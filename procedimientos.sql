-- Procedimientos y funciones para el flujo activo de la aplicación.
-- Ejecutar en el SQL Editor de Supabase antes de desplegar la aplicación.

CREATE OR REPLACE PROCEDURE registrar_cliente(
    p_cedula varchar,
    p_nombres varchar,
    p_apellidos varchar,
    p_direccion varchar,
    p_email varchar,
    p_celular varchar
)
LANGUAGE plpgsql
AS $procedure$
BEGIN
    INSERT INTO clientes (cedula, nombres, apellidos, direccion, email, celular)
    VALUES (p_cedula, p_nombres, p_apellidos, p_direccion, p_email, p_celular);
END;
$procedure$;

CREATE OR REPLACE PROCEDURE actualizar_cliente(
    p_cedula varchar,
    p_nombres varchar,
    p_apellidos varchar,
    p_direccion varchar,
    p_email varchar,
    p_celular varchar
)
LANGUAGE plpgsql
AS $procedure$
BEGIN
    UPDATE clientes
    SET nombres = p_nombres,
        apellidos = p_apellidos,
        direccion = p_direccion,
        email = p_email,
        celular = p_celular
    WHERE cedula = p_cedula;
END;
$procedure$;

CREATE OR REPLACE FUNCTION obtener_cliente(p_cedula varchar)
RETURNS TABLE (
    cedula varchar,
    nombres varchar,
    apellidos varchar,
    direccion varchar,
    email varchar,
    celular varchar
)
LANGUAGE plpgsql
AS $function$
BEGIN
    RETURN QUERY
    SELECT c.cedula, c.nombres, c.apellidos, c.direccion, c.email, c.celular
    FROM clientes AS c
    WHERE c.cedula = p_cedula;
END;
$function$;

CREATE OR REPLACE FUNCTION obtener_movimientos_cliente(p_cedula varchar)
RETURNS TABLE (
    valor_pagado varchar,
    fecha varchar
)
LANGUAGE plpgsql
AS $function$
BEGIN
    RETURN QUERY
    SELECT m.valor_pagado, m.fecha
    FROM movimientos AS m
    WHERE m.cedula = p_cedula;
END;
$function$;

CREATE OR REPLACE FUNCTION obtener_todos_clientes()
RETURNS TABLE (
    cedula varchar,
    nombres varchar,
    apellidos varchar,
    direccion varchar,
    email varchar,
    celular varchar
)
LANGUAGE plpgsql
AS $function$
BEGIN
    RETURN QUERY
    SELECT c.cedula, c.nombres, c.apellidos, c.direccion, c.email, c.celular
    FROM clientes AS c;
END;
$function$;
