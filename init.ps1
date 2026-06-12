$ErrorActionPreference = "Stop"

$APP_NAME = "admin.methub-mx"
$PHP_VERSION = "8.3"

# Verificar si el sitio ya está enlazado en Herd
$links = herd links | Out-String
if ($links -match $APP_NAME) {
    herd unlink $APP_NAME
}

# Crear el enlace seguro y aislar la versión de PHP
herd link $APP_NAME
herd secure $APP_NAME
herd isolate $APP_NAME --php=$PHP_VERSION
