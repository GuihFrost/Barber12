#!/bin/bash

echo "🚀 Instalando Backend BarberTime..."
echo "=================================="

# Verificar se PHP está instalado
if ! command -v php &> /dev/null; then
    echo "❌ PHP não encontrado. Instale PHP 8.2 ou superior."
    exit 1
fi

# Verificar se Composer está instalado
if ! command -v composer &> /dev/null; then
    echo "❌ Composer não encontrado. Instale o Composer."
    exit 1
fi

echo "✅ Dependências verificadas"

# Instalar dependências do PHP
echo "📦 Instalando dependências do PHP..."
composer install --no-dev --optimize-autoloader

# Gerar chave da aplicação
echo "🔑 Gerando chave da aplicação..."
php artisan key:generate

# Criar banco de dados SQLite
echo "🗄️ Criando banco de dados..."
touch database/database.sqlite

# Executar migrations
echo "📊 Executando migrations..."
php artisan migrate --force

# Executar seeders
echo "🌱 Executando seeders..."
php artisan db:seed --force

echo ""
echo "✅ Backend instalado com sucesso!"
echo ""
echo "Para executar o backend:"
echo "  php artisan serve"
echo ""
echo "O backend estará disponível em: http://localhost:8000"
echo ""