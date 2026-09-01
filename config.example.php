<?php
/**
 * EJEMPLO DE CONFIGURACIÓN DE LA BASE DE DATOS
 * 
 * Este archivo es un EJEMPLO de cómo debe verse config.php
 * NO CONTIENE credenciales reales.
 * 
 * INSTRUCCIONES:
 * 1. En tu computador local (XAMPP/AppServ), crea un archivo llamado "config.php"
 * 2. Copia el contenido de este archivo en config.php
 * 3. Reemplaza los valores con tus credenciales locales
 * 4. El archivo config.php NO debe subirse a GitHub (está en .gitignore)
 * 
 * PARA LOCALHOST (XAMPP/AppServ):
 * - DB_HOST: 127.0.0.1 (o localhost)
 * - DB_USER: root
 * - DB_PASS: (vacío si no tiene contraseña)
 * - DB_NAME: baseejemplo
 * 
 * PARA PRODUCCIÓN (Hosting):
 * Establece variables de entorno en tu servidor:
 * - export DB_HOST="servidor-produccion.com"
 * - export DB_USER="usuario_produccion"
 * - export DB_PASS="contraseña_segura"
 * - export DB_NAME="baseejemplo_prod"
 * 
 * O crea un archivo config.php con esos valores en el servidor.
 */

// Configuración que se lee de variables de entorno o usa valores por defecto
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'baseejemplo');

?>
