# DOCUMENTACIÓN TÉCNICA - DESPLIEGUE EN PRODUCCIÓN

## Antes de Publicar en GitHub

### ✓ Archivos Protegidos

- `config.php` - Excluido en `.gitignore` ✓
- `.env` - Excluido en `.gitignore` ✓
- `*.sql` - Excluido en `.gitignore` ✓
- Credenciales - No en código fuente ✓

### ✓ Archivos de Seguridad Creados

- `.gitignore` - Protege archivos sensibles
- `config.example.php` - Documentación de configuración
- `README.md` - Instrucciones de instalación

---

## Cómo Desplegar en Producción

### Paso 1: Subir a GitHub

```bash
cd /ruta/al/paquete
git init
git add .
git commit -m "Inicial"
git remote add origin https://github.com/usuario/paquete.git
git push -u origin main
```

**Nota:** El archivo `config.php` NO se subirá (está en `.gitignore`)

### Paso 2: Descargar en Hosting

```bash
git clone https://github.com/usuario/paquete.git /var/www/html/paquete
```

### Paso 3: Configurar Base de Datos

#### Opción A: Crear `config.php` en el servidor

SSH al servidor hosting y crear:

```bash
cd /var/www/html/paquete
nano config.php
```

Contenido:
```php
<?php
define('DB_HOST', 'servidor-mysql.com');
define('DB_USER', 'usuario_hosting');
define('DB_PASS', 'contraseña_hosting');
define('DB_NAME', 'baseejemplo_prod');
?>
```

Guardar: `Ctrl+O` → `Enter` → `Ctrl+X`

#### Opción B: Usar Variables de Entorno (Recomendado)

En tu panel de hosting (cPanel, Plesk, etc.):

Agregar variables de entorno:
- `DB_HOST` = servidor-mysql.com
- `DB_USER` = usuario_hosting
- `DB_PASS` = contraseña_hosting
- `DB_NAME` = baseejemplo_prod

O en terminal:
```bash
export DB_HOST="servidor-mysql.com"
export DB_USER="usuario_hosting"
export DB_PASS="contraseña_hosting"
export DB_NAME="baseejemplo_prod"
```

### Paso 4: Importar Base de Datos

En hosting:
```bash
mysql -u usuario_hosting -p baseejemplo_prod < baseejemplo.sql
```

O usar phpMyAdmin:
1. Ir a `https://tudominio.com/cpanel` → phpMyAdmin
2. Crear BD `baseejemplo_prod`
3. Importar archivo SQL

### Paso 5: Verificar Permisos

```bash
chmod 755 /var/www/html/paquete
chmod 644 /var/www/html/paquete/*.php
chmod 755 /var/www/html/paquete/css
chmod 755 /var/www/html/paquete/fonts
```

---

## Checklist Pre-Despliegue

Antes de hacer `git push`:

- [ ] `.gitignore` existe y está completo
- [ ] `config.php` NO está en staging: `git status`
- [ ] `config.example.php` está en repositorio
- [ ] `README.md` está en repositorio
- [ ] No hay contraseñas en commits anteriores
- [ ] Archivo `.env` (si existe) no está en staging
- [ ] Backups `.sql` no están en staging

### Verificar archivo staging:
```bash
git status
```

Debe mostrar `config.php` como untracked (no en repositorio)

---

## Checklist Post-Despliegue

En el servidor hosting:

- [ ] `config.php` creado con credenciales correctas
- [ ] Base de datos `baseejemplo_prod` creada e importada
- [ ] Tablas `clientes` y `movimientos` existentes
- [ ] Página accesible: `https://tudominio.com`
- [ ] Menú carga correctamente
- [ ] Registro de cliente funciona
- [ ] Consulta funciona
- [ ] Actualización funciona
- [ ] BD recibe datos correctamente

### Prueba rápida:
```bash
curl https://tudominio.com
```

Debe retornar HTML del menú principal (sin errores de conexión)

---

## Configuración de SSL/HTTPS

**En hosting cPanel:**
1. AutoSSL (automático)
2. O usar Let's Encrypt (gratuito)

**Asegurar redirect HTTP → HTTPS:**

En `.htaccess`:
```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

## Monitoreo y Mantenimiento

### Logs

Revisar errores:
```bash
tail -f /var/log/php-fpm/error.log
tail -f /var/log/apache2/error.log
```

### Backups Automáticos

Configurar backups diarios de BD:
```bash
0 2 * * * mysqldump -u usuario -p"contraseña" baseejemplo_prod > /backups/$(date +\%Y\%m\%d).sql
```

### Monitoreo de Espacio

```bash
df -h
du -sh /var/www/html/paquete
```

---

## Rollback (Volver a Versión Anterior)

Si hay problemas:
```bash
git log --oneline
git revert <commit-hash>
git push
```

O restaurar versión anterior:
```bash
git checkout <commit-hash> -- .
git commit -m "Rollback a commit anterior"
git push
```

---

## Seguridad Adicional

### Proteger `config.php` con permisos

```bash
chmod 600 /var/www/html/paquete/config.php
```

Solo el propietario puede leer (máxima seguridad)

### Deshabilitar directory listing

En `.htaccess`:
```apache
Options -Indexes
```

### Prevenir acceso directo a archivos sensibles

En `.htaccess`:
```apache
<FilesMatch "\.php$">
    Deny from all
</FilesMatch>
<FilesMatch "^index\.php$">
    Allow from all
</FilesMatch>
```

---

## Troubleshooting

### Error: "config.php not found"

Solución: Crear `config.php` con credenciales correctas

### Error: "Conexión fallida a BD"

Verificar:
1. Datos en `config.php` son correctos
2. BD existe en servidor
3. Usuario tiene permisos
4. Puerto MySQL es 3306

### Error: "No se puede conectar a MySQL"

```bash
mysql -h servidor-mysql.com -u usuario -p
```

Verificar conexión directa

---

## Contacto y Soporte

Para problemas en producción, contactar al hosting.

Documentación: Ver `README.md`

---

**Creado:** 2026-09-01
**Versión:** 1.0
