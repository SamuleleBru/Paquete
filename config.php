<?php
/**
 * CONFIGURACIÓN CENTRALIZADA DE LA BASE DE DATOS
 *
 * Usa PostgreSQL de Supabase a través de la variable de entorno DATABASE_URL.
 * No se almacena ninguna contraseña dentro del código.
 */

function loadEnvFile()
{
    $envFile = __DIR__ . '/.env';

    if (!is_file($envFile)) {
        return;
    }

    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return;
    }

    foreach ($lines as $line) {
        $line = trim($line);

        if ($line === '' || strpos($line, '#') === 0) {
            continue;
        }

        $parts = explode('=', $line, 2);
        if (count($parts) !== 2) {
            continue;
        }

        $key = trim($parts[0]);
        $value = trim($parts[1]);

        if ($value !== '') {
            $value = preg_replace('/^"(.*)"$/', '$1', $value);
            $value = preg_replace("/^'(.*)'$/", '$1', $value);
            putenv($key . '=' . $value);
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

loadEnvFile();

function getDatabaseUrl()
{
    $databaseUrl = getenv('DATABASE_URL');

    if ($databaseUrl === false || trim((string) $databaseUrl) === '') {
        throw new RuntimeException('La variable de entorno DATABASE_URL no está definida.');
    }

    return $databaseUrl;
}

function parseDatabaseUrlToPdoConfig($databaseUrl)
{
    $parts = parse_url($databaseUrl);

    if ($parts === false || !isset($parts['scheme']) || !isset($parts['host'])) {
        throw new RuntimeException('DATABASE_URL no tiene un formato válido para PostgreSQL.');
    }

    $scheme = strtolower($parts['scheme']);
    if ($scheme !== 'postgresql' && $scheme !== 'postgres') {
        throw new RuntimeException('DATABASE_URL no corresponde a PostgreSQL.');
    }

    $host = $parts['host'];
    $port = isset($parts['port']) ? (int) $parts['port'] : 5432;
    $dbname = isset($parts['path']) ? ltrim($parts['path'], '/') : '';
    $user = isset($parts['user']) ? rawurldecode($parts['user']) : '';
    $password = isset($parts['pass']) ? rawurldecode($parts['pass']) : '';

    if ($dbname === '') {
        throw new RuntimeException('DATABASE_URL no incluye una base de datos válida.');
    }

    $dsn = 'pgsql:host=' . $host . ';port=' . $port . ';dbname=' . $dbname;

    return [
        'dsn' => $dsn,
        'user' => $user,
        'password' => $password,
    ];
}

function getDbConnection()
{
    $databaseUrl = getDatabaseUrl();
    $config = parseDatabaseUrlToPdoConfig($databaseUrl);

    try {
        $pdo = new PDO($config['dsn'], $config['user'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);

        return $pdo;
    } catch (PDOException $e) {
        throw new RuntimeException('No se pudo conectar a PostgreSQL: ' . $e->getMessage());
    }
}

