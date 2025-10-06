#!/bin/bash

echo "🎨 Instalando Frontend BarberTime..."
echo "==================================="

# Verificar se Node.js está instalado
if ! command -v node &> /dev/null; then
    echo "❌ Node.js não encontrado. Instale Node.js 16 ou superior."
    exit 1
fi

# Verificar se npm está instalado
if ! command -v npm &> /dev/null; then
    echo "❌ npm não encontrado. Instale o npm."
    exit 1
fi

echo "✅ Dependências verificadas"

# Instalar dependências do Node.js
echo "📦 Instalando dependências do Node.js..."
npm install

echo ""
echo "✅ Frontend instalado com sucesso!"
echo ""
echo "Para executar o frontend:"
echo "  npm run dev"
echo ""
echo "O frontend estará disponível em: http://localhost:3000"
echo ""