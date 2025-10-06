#!/bin/bash

echo "========================================"
echo "   CONFIGURAÇÃO AUTOMÁTICA - LARAVEL 12"
echo "========================================"
echo

echo "[1/6] Verificando sistema..."
if ! command -v php &> /dev/null; then
    echo "❌ PHP não encontrado. Instale PHP 8.2+ primeiro."
    exit 1
fi
echo "✓ PHP encontrado"

if ! command -v composer &> /dev/null; then
    echo "❌ Composer não encontrado. Instale Composer primeiro."
    exit 1
fi
echo "✓ Composer encontrado"

echo
echo "[2/6] Configurando banco de dados..."
echo "Criando banco 'barbertime'..."
mysql -u root -e "CREATE DATABASE IF NOT EXISTS barbertime;" 2>/dev/null
if [ $? -ne 0 ]; then
    echo "⚠️  Não foi possível criar o banco automaticamente."
    echo "   Crie manualmente no phpMyAdmin: http://localhost/phpmyadmin"
    echo "   Nome do banco: barbertime"
else
    echo "✓ Banco 'barbertime' criado"
fi

echo
echo "[3/6] Configurando arquivo .env..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✓ Arquivo .env criado"
else
    echo "✓ Arquivo .env já existe"
fi

echo
echo "[4/6] Instalando dependências..."
composer install --no-interaction --prefer-dist --optimize-autoloader
if [ $? -ne 0 ]; then
    echo "❌ Erro ao instalar dependências"
    exit 1
fi
echo "✓ Dependências instaladas"

echo
echo "[5/6] Configurando aplicação..."
php artisan key:generate --no-interaction
php artisan config:cache
php artisan route:cache
echo "✓ Aplicação configurada"

echo
echo "[6/6] Executando migrations..."
php artisan migrate --force
if [ $? -ne 0 ]; then
    echo "⚠️  Erro ao executar migrations. Execute manualmente: php artisan migrate"
else
    echo "✓ Migrations executadas"
fi

echo
echo "========================================"
echo "   CONFIGURAÇÃO CONCLUÍDA!"
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
echo "Para verificar erros:"
echo "  php verificar-erros.php"
echo