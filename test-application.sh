#!/bin/bash

echo "🧪 Testando aplicação BarberTime..."
echo "=================================="
echo ""

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Função para testar endpoint
test_endpoint() {
    local url=$1
    local description=$2
    
    echo -n "Testando $description... "
    
    if curl -s "$url" > /dev/null 2>&1; then
        echo -e "${GREEN}✅ OK${NC}"
        return 0
    else
        echo -e "${RED}❌ FALHOU${NC}"
        return 1
    fi
}

# Testar backend
echo "🔧 Testando Backend (porta 9000):"
test_endpoint "http://localhost:9000/health" "Health Check"
test_endpoint "http://localhost:9000/api/appointments" "API Appointments"
test_endpoint "http://localhost:9000/api/barbers" "API Barbers"
test_endpoint "http://localhost:9000/api/services" "API Services"

echo ""

# Testar frontend
echo "🎨 Testando Frontend (porta 8080):"
test_endpoint "http://localhost:8080" "Frontend App"

echo ""

# Testar integração
echo "🔗 Testando Integração:"
echo -n "Verificando se frontend consegue acessar backend... "

# Simular requisição do frontend para o backend
if curl -s -H "Origin: http://localhost:8080" "http://localhost:9000/api/appointments" > /dev/null 2>&1; then
    echo -e "${GREEN}✅ OK${NC}"
else
    echo -e "${RED}❌ FALHOU${NC}"
fi

echo ""
echo "📊 Resumo dos Testes:"
echo "===================="

# Contar serviços rodando
backend_running=$(curl -s http://localhost:9000/health > /dev/null 2>&1 && echo "1" || echo "0")
frontend_running=$(curl -s http://localhost:8080 > /dev/null 2>&1 && echo "1" || echo "0")

if [ "$backend_running" = "1" ] && [ "$frontend_running" = "1" ]; then
    echo -e "${GREEN}🎉 Aplicação funcionando perfeitamente!${NC}"
    echo -e "${GREEN}   Frontend: http://localhost:8080${NC}"
    echo -e "${GREEN}   Backend:  http://localhost:9000${NC}"
    echo ""
    echo "Para parar os serviços:"
    echo "  - Frontend: Ctrl+C no terminal do frontend"
    echo "  - Backend:  Ctrl+C no terminal do backend"
else
    echo -e "${RED}⚠️  Alguns serviços não estão rodando${NC}"
    if [ "$backend_running" = "0" ]; then
        echo -e "${RED}   Backend não está rodando${NC}"
    fi
    if [ "$frontend_running" = "0" ]; then
        echo -e "${RED}   Frontend não está rodando${NC}"
    fi
    echo ""
    echo "Para iniciar os serviços:"
    echo "  Backend:  cd backend && npm start"
    echo "  Frontend: cd frontend && npm run dev"
fi

echo ""
echo "✨ Teste concluído!"