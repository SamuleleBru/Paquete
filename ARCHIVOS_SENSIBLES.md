# ARCHIVOS SENSIBLES - NO SUBIR A GITHUB

## ⚠️ CRÍTICOS - NO DEBEN SUBIRSE JAMÁS

### Archivos con Credenciales

- **config.php** - Contiene credenciales MySQL
  - ✓ Está en `.gitignore`
  - ✓ Debe existir en tu computador (localhost)
  - ✓ NO se subirá a GitHub
  - ✗ NO existe en repositorio remoto

- **.env** - Archivo de variables de entorno
  - ✓ Está en `.gitignore`
  - ✗ NO debe subirse

- **.env.local** - Configuración local
  - ✓ Está en `.gitignore`
  - ✗ NO debe subirse

### Archivos de Datos Sensibles

- **\*.sql** - Backups de BD con datos reales
  - ✓ Están en `.gitignore`
  - ⚠️ Pueden contener información personal
  - ✗ NO deben subirse

- **\*.backup** - Backups genéricos
  - ✓ Están en `.gitignore`
  - ✗ NO deben subirse

---

## 📁 ARCHIVOS QUE SÍ DEBEN SUBIRSE

### Código Fuente

- ✓ index.php
- ✓ registrardatos.php
- ✓ recibe_datos.php
- ✓ ingresar_cedula.php
- ✓ consultar_datos.php
- ✓ ingresar_cedula2.php
- ✓ actualizardatos.php
- ✓ mostrartodos.php
- ✓ Cservicios.php

### Configuración de Ejemplo

- ✓ config.example.php (sin contraseñas)

### Estilos y Recursos

- ✓ css/estilos.css
- ✓ fonts/

### Documentación

- ✓ README.md
- ✓ PRODUCCION.md
- ✓ ARCHIVOS_SENSIBLES.md (este archivo)

### Control de Versión

- ✓ .gitignore (lista de archivos excluidos)
- ✓ .git/ (creado automáticamente)

---

## 🔍 Cómo Verificar Antes de Subir

### Paso 1: Ver qué archivos se van a subir

```bash
git status
```

**Debe mostrar:**
- `config.php` como **untracked** (rojo, NO listado en staging)
- Los demás `.php` como `new file` (verde, listos para subir)

### Paso 2: Verificar `.gitignore`

```bash
cat .gitignore
```

**Debe contener:**
- `config.php`
- `.env`
- `*.sql`
- `.backup`, `.bak`

### Paso 3: Revisar commits anteriores

```bash
git log --name-only
```

**Verificar que:**
- `config.php` NO aparece en commits anteriores
- `*.sql` NO aparece en commits anteriores

---

## ⚠️ SI ACCIDENTALMENTE SUBISTE CREDENCIALES

### Opción A: Rápido (Recomendado)

1. Cambiar INMEDIATAMENTE las contraseñas en hosting/BD

2. Remover del historio de Git:
```bash
git rm --cached config.php
git commit --amend
git push --force-with-lease
```

3. Regenerar las credenciales en hosting

### Opción B: Nuclear (Más seguro)

Si las credenciales estaban expuestas por mucho tiempo:

1. Cambiar TODAS las contraseñas en hosting/BD
2. Investigar logs de acceso para detectar uso no autorizado
3. Contactar al proveedor de hosting
4. Considerar cambiar usuario SSH/FTP

---

## 📋 Checklist Final

Antes de hacer `git push`:

- [ ] He ejecutado `git status`
- [ ] `config.php` aparece como **untracked** (NO en staging)
- [ ] Los archivos `.php` aparecen como **new file**
- [ ] `.gitignore` existe y contiene `config.php`
- [ ] `config.example.php` está presente
- [ ] No tengo `.env` en staging
- [ ] No tengo `*.sql` en staging

Si todo está bien:
```bash
git push
```

---

## 📞 Recordar

- ✓ `config.php` debe estar en tu computador
- ✓ `config.php` NO debe estar en GitHub
- ✓ Crear `config.php` en hosting cuando depliegues
- ✓ Nunca compartir credenciales por email/chat
- ✓ Usar `.gitignore` para proteger archivos sensibles

---

**Última actualización:** 2026-09-01
