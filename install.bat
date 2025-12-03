@echo off
echo ========================================
echo   Sistem Absensi Modern - Installer
echo   Windows Installation Script
echo ========================================
echo.

REM Check PHP version
echo [1/8] Checking PHP version...
php -v >nul 2>&1
if errorlevel 1 (
    echo ERROR: PHP not found! Please install PHP 8.2 or higher.
    pause
    exit /b 1
)
php -r "if (version_compare(PHP_VERSION, '8.2.0', '<')) { echo 'ERROR: PHP 8.2+ required. Current: ' . PHP_VERSION; exit(1); }"
if errorlevel 1 (
    pause
    exit /b 1
)
echo    PHP version OK
echo.

REM Check Composer
echo [2/8] Checking Composer...
where composer >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: Composer not found! Please install Composer from https://getcomposer.org
    pause
    exit /b 1
)
echo    Composer found
echo.

REM Check Node/NPM
echo [3/8] Checking Node.js and NPM...
where node >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: Node.js not found! Please install Node.js from https://nodejs.org
    pause
    exit /b 1
)
where npm >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: NPM not found! Please install Node.js from https://nodejs.org
    pause
    exit /b 1
)
echo    Node.js and NPM found
echo.

REM Create required Laravel directories
echo [3.5/8] Creating Laravel directories...
if not exist bootstrap\cache mkdir bootstrap\cache
if not exist storage\framework\cache\data mkdir storage\framework\cache\data
if not exist storage\framework\sessions mkdir storage\framework\sessions
if not exist storage\framework\views mkdir storage\framework\views
if not exist storage\logs mkdir storage\logs
if not exist storage\app\public mkdir storage\app\public
echo    Directories created
echo.

REM Install Composer dependencies
echo [4/8] Installing Composer dependencies...
composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs
if errorlevel 1 (
    echo ERROR: Composer install failed!
    pause
    exit /b 1
)
echo    Composer dependencies installed
echo.

REM Install NPM dependencies
echo [5/8] Installing NPM dependencies...
call npm install
if errorlevel 1 (
    echo ERROR: NPM install failed!
    pause
    exit /b 1
)
echo    NPM dependencies installed
echo.

REM Build assets
echo [6/8] Building frontend assets...
call npm run build
if errorlevel 1 (
    echo ERROR: Asset build failed!
    pause
    exit /b 1
)
echo    Assets built successfully
echo.

REM Copy .env file
echo [7/8] Setting up environment file...
if not exist .env (
    copy .env.example .env
    echo    .env file created
) else (
    echo    .env file already exists, skipping...
)
echo.

REM Generate app key
echo [8/8] Generating application key...
php artisan key:generate --ansi
echo.

REM Create database
echo Creating SQLite database...
if not exist database (
    mkdir database
)
type nul > database\database.sqlite
echo    Database file created
echo.

REM Run migrations and seeders
echo Running database migrations and seeders...
php artisan migrate --seed --force
if errorlevel 1 (
    echo WARNING: Migration failed! Please check your database configuration.
    echo You can run 'php artisan migrate --seed' manually later.
) else (
    echo    Database setup complete
)
echo.

echo ========================================
echo   Installation Complete!
echo ========================================
echo.
echo Next steps:
echo 1. Configure Google OAuth credentials in .env file:
echo    - GOOGLE_CLIENT_ID
echo    - GOOGLE_CLIENT_SECRET
echo.
echo 2. Update office coordinates in .env (if needed):
echo    - OFFICE_LATITUDE
echo    - OFFICE_LONGITUDE
echo    - ATTENDANCE_RADIUS (default: 50 meters)
echo.
echo 3. Start development server:
echo    php artisan serve
echo.
echo 4. Open browser at: http://localhost:8000
echo.
echo Default accounts:
echo    Owner:    gustiadityamuzaky08@gmail.com
echo    Admin:    gustiadityacreator07@gmail.com
echo    Employee: fajartergg@gmail.com
echo.
echo ========================================
pause
