# BarberTime - Sistema Completo de Agendamentos para Barbearia

Sistema completo desenvolvido com **Laravel 12** e **React** para gerenciamento de agendamentos de barbearia.

## 🚀 Características

- ✅ **Laravel 12** com API RESTful completa
- ✅ **React 18** com interface moderna e responsiva
- ✅ **SQLite** como banco de dados (fácil de usar)
- ✅ **Tailwind CSS** para estilização
- ✅ **Vite** para build e desenvolvimento
- ✅ **Sistema completo** com todas as funcionalidades

## 📋 Funcionalidades

### Backend (Laravel 12)
- 🔐 API RESTful completa
- 📊 Sistema de agendamentos
- 👥 Gestão de barbeiros
- 🛠️ Gestão de serviços
- 👤 Gestão de clientes
- 📈 Dashboard com estatísticas
- 🗄️ Migrations e Seeders
- 🔍 Validação de dados
- 📝 Logs e tratamento de erros

### Frontend (React)
- 🎨 Interface moderna e responsiva
- 📱 Design mobile-first
- 🔄 SPA (Single Page Application)
- 📊 Dashboard interativo
- 📅 Gestão de agendamentos
- 👥 Gestão de barbeiros e clientes
- 🛠️ Gestão de serviços
- ⚡ Carregamento rápido

## 🛠️ Instalação Rápida

### Pré-requisitos
- PHP 8.2 ou superior
- Composer
- Node.js 16 ou superior
- npm ou yarn

### Instalação Automática
```bash
# Clone o repositório
git clone <seu-repositorio>
cd barbertime

# Execute o script de instalação
./install.sh
```

### Instalação Manual
```bash
# 1. Instalar dependências do PHP
composer install

# 2. Instalar dependências do Node.js
npm install

# 3. Configurar ambiente
cp .env.example .env
php artisan key:generate

# 4. Criar banco de dados
touch database/database.sqlite

# 5. Executar migrations e seeders
php artisan migrate --seed

# 6. Compilar assets
npm run build
```

## 🚀 Como Executar

### Desenvolvimento
```bash
# Terminal 1 - Backend (Laravel)
php artisan serve

# Terminal 2 - Frontend (React)
npm run dev
```

### Produção
```bash
# Compilar assets
npm run build

# Executar servidor
php artisan serve
```

## 📊 Estrutura do Projeto

```
BarberTime/
├── app/
│   ├── Http/Controllers/Api/     # Controllers da API
│   ├── Models/                   # Modelos Eloquent
│   └── Providers/                # Service Providers
├── database/
│   ├── migrations/               # Migrations do banco
│   └── seeders/                  # Seeders com dados de exemplo
├── resources/
│   ├── js/                       # Código React
│   │   ├── components/           # Componentes React
│   │   ├── pages/                # Páginas da aplicação
│   │   ├── services/             # Serviços da API
│   │   └── contexts/             # Contextos React
│   └── views/                    # Views Blade
├── routes/
│   ├── api.php                   # Rotas da API
│   └── web.php                   # Rotas web
├── public/                       # Arquivos públicos
└── config/                       # Configurações
```

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
- 🌙 Suporte a temas

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

### Variáveis de Ambiente
```env
APP_NAME="BarberTime"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

VITE_APP_NAME="${APP_NAME}"
```

### Personalização
- Edite `resources/js/` para modificar o frontend
- Edite `app/Http/Controllers/Api/` para modificar a API
- Edite `database/seeders/` para modificar dados de exemplo

## 📱 Acesso

Após a instalação, acesse:
- **Frontend**: http://localhost:8000
- **API**: http://localhost:8000/api
- **Health Check**: http://localhost:8000/api/health

## 🚀 Deploy

### Para Produção
1. Configure as variáveis de ambiente
2. Execute `npm run build`
3. Configure o servidor web (Apache/Nginx)
4. Configure o banco de dados de produção

### Docker (Opcional)
```bash
# Criar Dockerfile para o projeto
docker build -t barbertime .
docker run -p 8000:8000 barbertime
```

## 🤝 Contribuição

1. Fork o projeto
2. Crie uma branch para sua feature
3. Commit suas mudanças
4. Push para a branch
5. Abra um Pull Request

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

## 🆘 Suporte

Para suporte ou dúvidas:
- Abra uma issue no GitHub
- Consulte a documentação do Laravel
- Consulte a documentação do React

---

**BarberTime** - Sistema completo de agendamentos para barbearia! ✂️💈