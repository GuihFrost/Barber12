# BarberTime - Sistema Completo de Agendamentos para Barbearia

Sistema completo desenvolvido com **Laravel 12** e **React** para gerenciamento de agendamentos de barbearia.

## 📁 Estrutura do Projeto

```
BarberTime/
├── backend/          # Laravel 12 API
│   ├── app/
│   ├── database/
│   ├── routes/
│   ├── config/
│   └── install.sh
├── frontend/         # React Frontend
│   ├── src/
│   ├── public/
│   └── install.sh
└── README.md
```

## 🚀 Instalação Rápida

### Pré-requisitos
- PHP 8.2 ou superior
- Composer
- Node.js 16 ou superior
- npm

### 1. Instalar Backend (Laravel)

```bash
cd backend
chmod +x install.sh
./install.sh
```

### 2. Instalar Frontend (React)

```bash
cd frontend
chmod +x install.sh
./install.sh
```

## 🎯 Como Executar

### Terminal 1 - Backend
```bash
cd backend
php artisan serve
```
**Backend**: http://localhost:8000

### Terminal 2 - Frontend
```bash
cd frontend
npm run dev
```
**Frontend**: http://localhost:3000

## 📋 Funcionalidades

### Backend (Laravel 12)
- ✅ **API RESTful completa** com todos os endpoints
- ✅ **4 Modelos** (Appointment, Barber, Service, Client)
- ✅ **4 Controllers** com CRUD completo
- ✅ **Migrations** para criar todas as tabelas
- ✅ **Seeders** com dados de exemplo
- ✅ **Validação** de dados completa
- ✅ **Relacionamentos** entre modelos
- ✅ **Middleware** de segurança

### Frontend (React)
- ✅ **Interface moderna** e responsiva
- ✅ **5 Páginas** (Dashboard, Agendamentos, Barbeiros, Serviços, Clientes)
- ✅ **Componentes** reutilizáveis
- ✅ **Context API** para estado
- ✅ **Serviços** para API
- ✅ **Tailwind CSS** para estilização

## 🔗 Endpoints da API

### Agendamentos
- `GET /api/v1/appointments` - Listar agendamentos
- `POST /api/v1/appointments` - Criar agendamento
- `GET /api/v1/appointments/{id}` - Buscar agendamento
- `PUT /api/v1/appointments/{id}` - Atualizar agendamento
- `DELETE /api/v1/appointments/{id}` - Excluir agendamento
- `POST /api/v1/appointments/{id}/confirm` - Confirmar agendamento
- `POST /api/v1/appointments/{id}/cancel` - Cancelar agendamento

### Barbeiros
- `GET /api/v1/barbers` - Listar barbeiros
- `POST /api/v1/barbers` - Criar barbeiro
- `GET /api/v1/barbers/{id}` - Buscar barbeiro
- `PUT /api/v1/barbers/{id}` - Atualizar barbeiro
- `DELETE /api/v1/barbers/{id}` - Excluir barbeiro

### Serviços
- `GET /api/v1/services` - Listar serviços
- `POST /api/v1/services` - Criar serviço
- `GET /api/v1/services/{id}` - Buscar serviço
- `PUT /api/v1/services/{id}` - Atualizar serviço
- `DELETE /api/v1/services/{id}` - Excluir serviço

### Clientes
- `GET /api/v1/clients` - Listar clientes
- `POST /api/v1/clients` - Criar cliente
- `GET /api/v1/clients/{id}` - Buscar cliente
- `PUT /api/v1/clients/{id}` - Atualizar cliente
- `DELETE /api/v1/clients/{id}` - Excluir cliente

### Dashboard
- `GET /api/dashboard/stats` - Estatísticas do dashboard
- `GET /api/health` - Health check

## 🎨 Interface

### Páginas Disponíveis
- **Dashboard** - Visão geral com estatísticas
- **Agendamentos** - Gestão completa de agendamentos
- **Barbeiros** - Cadastro e gestão de barbeiros
- **Serviços** - Catálogo de serviços oferecidos
- **Clientes** - Cadastro e gestão de clientes

### Recursos da Interface
- 🎨 Design moderno e limpo
- 📱 Totalmente responsiva
- ⚡ Carregamento rápido
- 🔄 Atualizações em tempo real
- 🎯 Interface intuitiva

## 🗄️ Banco de Dados

### Tabelas Principais
- **barbers** - Dados dos barbeiros
- **services** - Serviços oferecidos
- **clients** - Dados dos clientes
- **appointments** - Agendamentos

### Dados de Exemplo
O sistema inclui dados de exemplo para demonstração:
- 4 barbeiros cadastrados
- 9 serviços disponíveis
- 5 clientes de exemplo
- 5 agendamentos de demonstração

## 🔧 Configuração

### Backend (.env)
```env
APP_NAME="BarberTime Backend"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

### Frontend (vite.config.js)
```javascript
server: {
  host: '0.0.0.0',
  port: 3000,
  proxy: {
    '/api': {
      target: 'http://localhost:8000',
      changeOrigin: true,
    }
  }
}
```

## 📱 Acesso

Após a instalação, acesse:
- **Frontend**: http://localhost:3000
- **Backend**: http://localhost:8000
- **API**: http://localhost:8000/api/health

## 🚀 Deploy

### Para Produção
1. Configure as variáveis de ambiente
2. Execute `npm run build` no frontend
3. Configure o servidor web (Apache/Nginx)
4. Configure o banco de dados de produção

## 🤝 Contribuição

1. Fork o projeto
2. Crie uma branch para sua feature
3. Commit suas mudanças
4. Push para a branch
5. Abra um Pull Request

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

---

**BarberTime** - Sistema completo de agendamentos para barbearia! ✂️💈