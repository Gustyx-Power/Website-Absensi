#!/bin/bash

echo "========================================"
echo "  Sistem Absensi Modern - Installer"
echo "  Linux/Mac Installation Script"
echo "========================================"
echo

# Check PHP version
echo "[1/8] Checking PHP version..."
if ! command -v php &> /dev/null; then
    echo "ERROR: PHP not found! Please install PHP 8.2 or higher."
    exit 1
fi

PHP_VERSION=$(php -r "echo PHP_VERSION;")
REQUIRED_VERSION="8.2.0"
if ! php -r "exit(version_compare(PHP_VERSION, '$REQUIRED_VERSION', '>=') ? 0 : 1);"; then
    echo "ERROR: PHP 8.2+ required. Current: $PHP_VERSION"
    exit 1
fi
echo "   PHP version OK ($PHP_VERSION)"
echo

# Check Composer
echo "[2/8] Checking Composer..."
if ! command -v composer &> /dev/null; then
    echo "ERROR: Composer not found! Please install Composer from https://getcomposer.org"
    exit 1
fi
echo "   Composer found"
echo

# Check Node/NPM
echo "[3/8] Checking Node.js and NPM..."
if ! command -v node &> /dev/null; then
    echo "ERROR: Node.js not found! Please install Node.js from https://nodejs.org"
    exit 1
fi
if ! command -v npm &> /dev/null; then
    echo "ERROR: NPM not found! Please install Node.js from https://nodejs.org"
    exit 1
fi
echo "   Node.js and NPM found"
echo

# Install Composer dependencies
echo "[4/8] Installing Composer dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader
if [ $? -ne 0 ]; then
    echo "ERROR: Composer install failed!"
    exit 1
fi
echo "   Composer dependencies installed"
echo

# Install NPM dependencies
echo "[5/8] Installing NPM dependencies..."
npm install
if [ $? -ne 0 ]; then
    echo "ERROR: NPM install failed!"
    exit 1
fi
echo "   NPM dependencies installed"
echo

# Build assets
echo "[6/8] Building frontend assets..."
npm run build
if [ $? -ne 0 ]; then
    echo "ERROR: Asset build failed!"
    exit 1
fi
echo "   Assets built successfully"
echo

# Copy .env file
echo "[7/8] Setting up environment file..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "   .env file created"
else
    echo "   .env file already exists, skipping..."
fi
echo

# Generate app key
echo "[8/8] Generating application key..."
php artisan key:generate --ansi
echo

# Create database
echo "Creating SQLite database..."
mkdir -p database
touch database/database.sqlite
echo "   Database file created"
echo

# Run migrations and seeders
echo "Running database migrations and seeders..."
php artisan migrate --seed --force
if [ $? -ne 0 ]; then
    echo "WARNING: Migration failed! Please check your database configuration."
    echo "You can run 'php artisan migrate --seed' manually later."
else
    echo "   Database setup complete"
fi
echo

echo "========================================"
echo "  Installation Complete!"
echo "========================================"
echo
echo "Next steps:"
echo "1. Configure Google OAuth credentials in .env file:"
echo "   - GOOGLE_CLIENT_ID"
echo "   - GOOGLE_CLIENT_SECRET"
echo
echo "2. Update office coordinates in .env (if needed):"
echo "   - OFFICE_LATITUDE"
echo "   - OFFICE_LONGITUDE"
echo "   - ATTENDANCE_RADIUS (default: 50 meters)"
echo
echo "3. Start development server:"
echo "   php artisan serve"
echo
echo "4. Open browser at: http://localhost:8000"
echo
echo "Default accounts:"
echo "   Owner:    gustiadityamuzaky08@gmail.com"
echo "   Admin:    gustiadityacreator07@gmail.com"
echo "   Employee: fajartergg@gmail.com"
echo
echo "========================================"
