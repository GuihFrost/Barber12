@echo off
echo ========================================
echo    CONFIGURAÇÃO AUTOMÁTICA - LARAVEL 12
echo ========================================
echo.

echo [1/6] Verificando sistema...
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ PHP não encontrado. Instale PHP 8.2+ primeiro.
    pause
    exit /b 1
)
echo ✓ PHP encontrado

composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Composer não encontrado. Instale Composer primeiro.
    pause
    exit /b 1
)
echo ✓ Composer encontrado

echo.
echo [2/6] Configurando banco de dados...
echo Criando banco 'barbertime'...
mysql -u root -e "CREATE DATABASE IF NOT EXISTS barbertime;" 2>nul
if %errorlevel% neq 0 (
    echo ⚠️  Não foi possível criar o banco automaticamente.
    echo    Crie manualmente no phpMyAdmin: http://localhost/phpmyadmin
    echo    Nome do banco: barbertime
) else (
    echo ✓ Banco 'barbertime' criado
)

echo.
echo [3/6] Configurando arquivo .env...
if not exist .env (
    copy .env.example .env
    echo ✓ Arquivo .env criado
) else (
    echo ✓ Arquivo .env já existe
)

echo.
echo [4/6] Instalando dependências...
composer install --no-interaction --prefer-dist --optimize-autoloader
if %errorlevel% neq 0 (
    echo ❌ Erro ao instalar dependências
    pause
    exit /b 1
)
echo ✓ Dependências instaladas

echo.
echo [5/6] Configurando aplicação...
php artisan key:generate --no-interaction
php artisan config:cache
php artisan route:cache
echo ✓ Aplicação configurada

echo.
echo [6/6] Executando migrations...
php artisan migrate --force
if %errorlevel% neq 0 (
    echo ⚠️  Erro ao executar migrations. Execute manualmente: php artisan migrate
) else (
    echo ✓ Migrations executadas
)

echo.
echo ========================================
echo    CONFIGURAÇÃO CONCLUÍDA!
echo ========================================
echo.
echo Para iniciar o servidor:
echo   php artisan serve
echo.
echo URLs de acesso:
echo   Frontend: http://localhost:5173
echo   Backend:  http://localhost:8000
echo   API:      http://localhost:8000/api/health
echo.
echo Para verificar erros:
echo   php verificar-erros.php
echo.
pause