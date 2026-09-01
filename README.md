# Sistema de Gestión de Clientes

Aplicación web PHP + MySQL para registrar, consultar, actualizar y listar clientes.

## 📋 Requisitos

- PHP 7.0+
- MySQL 5.5+
- Servidor web (Apache, Nginx, IIS, etc.)

## 🚀 Instalación

### 1. Clonar o descargar el proyecto

```bash
git clone <tu-repositorio>
cd paquete
```

### 2. Configurar la base de datos

#### Opción A: Usando localhost (XAMPP/AppServ)

El proyecto viene configurado para localhost. Solo necesitas:

1. Asegurarse que MySQL está corriendo
2. Crear la base de datos `baseejemplo` (o la que uses)
3. Importar el SQL de estructura (si existe)

#### Opción B: Usando producción/hosting

1. Copiar `config.example.php` como guía
2. Crear un archivo `config.php` en la raíz con tus credenciales
3. O establecer variables de entorno en tu servidor

### 3. Configurar credenciales

**Para LOCALHOST:**

No requiere cambios. El archivo `config.php` ya está configurado con:
- Host: 127.0.0.1
- Usuario: root
- Contraseña: (vacía)
- Base de datos: baseejemplo

**Para PRODUCCIÓN:**

Crea un archivo `config.php` en la raíz del proyecto:

```php
<?php
define('DB_HOST', 'tu-servidor.com');
define('DB_USER', 'tu-usuario');
define('DB_PASS', 'tu-contraseña');
define('DB_NAME', 'tu-base-datos');
?>
```

O establece variables de entorno en tu servidor (método recomendado):

```bash
export DB_HOST="tu-servidor.com"
export DB_USER="tu-usuario"
export DB_PASS="tu-contraseña"
export DB_NAME="tu-base-datos"
```

## 📁 Estructura del Proyecto

```
paquete/
├── config.php              # Configuración de BD (NO en GitHub)
├── config.example.php      # Ejemplo de configuración
├── .gitignore             # Archivos excluidos de GitHub
├── index.php              # Menú principal
├── registrardatos.php     # Formulario registro
├── recibe_datos.php       # Procesa registro
├── ingresar_cedula.php    # Formulario búsqueda
├── consultar_datos.php    # Muestra datos cliente
├── ingresar_cedula2.php   # Formulario actualización
├── actualizardatos.php    # Procesa actualización
├── mostrartodos.php       # Lista todos clientes
├── Cservicios.php         # Clase de servicios
├── css/
│   └── estilos.css        # Estilos modernos
├── fonts/                 # Fuentes
└── php/                   # Código legacy (no usar)
```

## 🔐 Seguridad

### Archivo config.php

- ⚠️ **NO debe subirse a GitHub**
- Contiene credenciales sensibles
- Está excluido en `.gitignore`
- Debe crearse manualmente en cada servidor

### Protecciones implementadas

✓ Prepared statements (previene SQL Injection)
✓ htmlspecialchars() (previene XSS)
✓ Validación de entrada
✓ Uso de mysqli (API moderna)

## 💾 Base de Datos

### Tablas esperadas

#### clientes
```
- cedula (VARCHAR PRIMARY KEY)
- nombres (VARCHAR)
- apellidos (VARCHAR)
- direccion (VARCHAR)
- email (VARCHAR)
- celular (VARCHAR)
```

#### movimientos
```
- consecutivo (VARCHAR)
- cedula (VARCHAR - foreign key)
- valor_pagado (VARCHAR)
- fecha (VARCHAR)
```

## 🌐 Funcionalidades

- ✓ Registrar nuevos clientes
- ✓ Consultar datos de cliente
- ✓ Actualizar información
- ✓ Listar todos los clientes
- ✓ Historial de movimientos/pagos

## 🎨 Diseño

- Interfaz moderna y responsive
- Compatible con móviles
- Estilos profesionales
- Gradientes y transiciones suaves

## 📝 Uso

1. Acceder a `http://localhost/paquete/` (o tu servidor)
2. Usar el menú para navegar
3. Llenar formularios con datos del cliente
4. Los cambios se guardan automáticamente en BD

## 🔧 Desarrollo

### Para agregar funcionalidades

1. Las credenciales de BD están en `config.php` (centralizado)
2. Las clases de servicios están en `Cservicios.php`
3. Los estilos están en `css/estilos.css`
4. Usar siempre prepared statements para consultas

### Para cambiar base de datos

Edita solo `config.php`:
```php
define('DB_HOST', 'nuevo-servidor');
define('DB_USER', 'nuevo-usuario');
define('DB_PASS', 'nueva-contraseña');
define('DB_NAME', 'nueva-base-datos');
```

Todos los archivos usarán automáticamente la nueva configuración.

## ⚠️ Importante

- El archivo `config.php` debe existir en la raíz
- Si no existe, copia `config.example.php` como referencia
- Modifica `config.php` con tus credenciales reales
- **Nunca** subas `config.php` a GitHub

## 📞 Soporte

Para dudas o problemas, revisar la documentación o crear un issue.

## 📄 Licencia

Uso privado.

---

**Última actualización:** 2026-09-01
