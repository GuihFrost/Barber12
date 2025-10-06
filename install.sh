#!/bin/bash

echo "🚀 Instalando BarberTime - Sistema de Agendamentos"
echo "=================================================="

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

# Verificar se Node.js está instalado
if ! command -v node &> /dev/null; then
    echo "❌ Node.js não encontrado. Instale Node.js 16 ou superior."
    exit 1
fi

echo "✅ Dependências verificadas"

# Instalar dependências do PHP
echo "📦 Instalando dependências do PHP..."
composer install --no-dev --optimize-autoloader

# Instalar dependências do Node.js
echo "📦 Instalando dependências do Node.js..."
npm install

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

# Compilar assets
echo "🎨 Compilando assets..."
npm run build

echo ""
echo "✅ Instalação concluída com sucesso!"
echo ""
echo "Para executar o sistema:"
echo "1. Backend: php artisan serve"
echo "2. Frontend: npm run dev"
echo ""
echo "Acesse: http://localhost:8000"
echo ""