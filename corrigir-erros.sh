#!/bin/bash

echo "========================================"
echo "   CORREÇÃO AUTOMÁTICA - LARAVEL 12"
echo "========================================"
echo

echo "[1/8] Limpando cache e arquivos antigos..."
rm -rf vendor/
rm -f composer.lock
echo "✓ Cache limpo"

echo
echo "[2/8] Instalando dependências Laravel 12..."
composer require laravel/framework:^12.0
composer require laravel/sanctum:^4.0
composer require laravel/tinker:^2.9
composer require spatie/laravel-permission:^6.0
composer require guzzlehttp/guzzle:^7.2
echo "✓ Dependências instaladas"

echo
echo "[3/8] Instalando dependências de desenvolvimento..."
composer require --dev fakerphp/faker:^1.24
composer require --dev laravel/pint:^1.13
composer require --dev laravel/sail:^1.26
composer require --dev mockery/mockery:^1.6
composer require --dev nunomaduro/collision:^8.0
composer require --dev phpunit/phpunit:^11.0
composer require --dev spatie/laravel-ignition:^2.4
echo "✓ Dependências de desenvolvimento instaladas"

echo
echo "[4/8] Configurando aplicação..."
if [ ! -f .env ]; then
    cp .env.example .env
fi
echo "✓ Arquivo .env criado"

echo
echo "[5/8] Gerando chave da aplicação..."
php artisan key:generate
echo "✓ Chave gerada"

echo
echo "[6/8] Limpando cache..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo "✓ Cache limpo"

echo
echo "[7/8] Executando migrations..."
php artisan migrate
echo "✓ Migrations executadas"

echo
echo "[8/8] Verificando instalação..."
php artisan --version
echo "✓ Instalação verificada"

echo
echo "========================================"
echo "   INSTALAÇÃO CONCLUÍDA COM SUCESSO!"
echo "========================================"
echo
echo "Para iniciar o servidor:"
echo "  php artisan serve"
echo
echo "URLs de acesso:"
echo "  Frontend: http://localhost:5173"
echo "  Backend:  http://localhost:8000"
echo "  API:      http://localhost:8000/api/health"
echo