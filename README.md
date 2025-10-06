# BarberTime

Sistema completo de agendamentos para barbearia com frontend React e backend Node.js.

## 🚀 Arquitetura

### Frontend
- **React 18** - Biblioteca JavaScript
- **Vite** - Build tool
- **TypeScript** - Tipagem estática
- **Tailwind CSS** - Estilização
- **Shadcn/ui** - Componentes UI
- **React Router** - Roteamento
- **React Query** - Gerenciamento de estado
- **Context API** - Estado global

### Backend
- **Node.js** - Runtime JavaScript
- **Express.js** - Framework web
- **MongoDB** - Banco de dados
- **Mongoose** - ODM
- **JWT** - Autenticação
- **Winston** - Logging

## 📋 Pré-requisitos

- Node.js 18+
- MongoDB 5+
- npm ou yarn

## 🛠️ Instalação

### 1. Clone o repositório
```bash
git clone <repository-url>
cd barbertime
```

### 2. Configure o Backend
```bash
cd backend
npm install
cp .env.example .env
# Edite o arquivo .env com suas configurações
npm run dev
```

### 3. Configure o Frontend
```bash
cd ../
npm install
cp .env.example .env
# Edite o arquivo .env com a URL da API
npm run dev
```

### 4. Acesse a aplicação
- Frontend: `http://localhost:5173`
- Backend API: `http://localhost:5000`

## 🎨 Funcionalidades

### Frontend
- ✅ Landing page responsiva
- ✅ Sistema de agendamentos em etapas
- ✅ Dashboard administrativo completo
- ✅ Gerenciamento de serviços e barbeiros
- ✅ Sistema de clientes com histórico
- ✅ Relatórios e analytics
- ✅ Sistema de promoções
- ✅ Avaliações e reviews
- ✅ Autenticação e autorização
- ✅ Design moderno e responsivo

### Backend
- ✅ API REST completa
- ✅ Autenticação JWT
- ✅ Sistema de roles (admin, barber, client)
- ✅ Banco de dados MongoDB
- ✅ Validação de dados
- ✅ Rate limiting
- ✅ Logs estruturados
- ✅ Sistema de backup
- ✅ Documentação da API

## 📱 Responsividade

O sistema é totalmente responsivo e funciona perfeitamente em:
- 📱 Mobile (320px+)
- 📱 Tablet (768px+)
- 💻 Desktop (1024px+)

## 🔐 Segurança

- Autenticação JWT
- Criptografia de senhas (bcrypt)
- Rate limiting
- Validação de dados
- CORS configurado
- Headers de segurança

## 📊 Monitoramento

- Health check endpoint
- Logs estruturados
- Métricas de performance
- Sistema de backup automático

## 🚀 Deploy

### Docker
```bash
# Backend
cd backend
docker build -t barbertime-backend .
docker run -p 5000:5000 barbertime-backend

# Frontend
docker build -t barbertime-frontend .
docker run -p 3000:3000 barbertime-frontend
```

### Variáveis de Ambiente

#### Frontend (.env)
```env
VITE_API_URL=http://localhost:5000/api
VITE_APP_NAME=BarberTime
```

#### Backend (.env)
```env
PORT=5000
MONGODB_URI=mongodb://localhost:27017/barbertime
JWT_SECRET=your-super-secret-jwt-key-here
NODE_ENV=development
```

## 🧪 Testes

```bash
# Backend
cd backend
npm test

# Frontend
npm test
```

## 📚 Documentação

- [Backend API Documentation](./backend/README.md)
- [Frontend Components](./src/components/README.md)
- [Database Schema](./docs/database.md)

## 🎯 Próximos Passos

- [ ] PWA (Progressive Web App)
- [ ] Notificações push
- [ ] Integração com WhatsApp Business
- [ ] Sistema de pagamentos
- [ ] App mobile (React Native)
- [ ] Analytics avançados

## 🤝 Contribuição

1. Fork o projeto
2. Crie uma branch para sua feature
3. Commit suas mudanças
4. Push para a branch
5. Abra um Pull Request

## 📄 Licença

Este projeto está sob a licença MIT.