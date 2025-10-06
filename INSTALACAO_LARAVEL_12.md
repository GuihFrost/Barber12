# 🚀 **Instalação Laravel 12 - BarberTime Backend**

## ✅ **Backend Laravel 12 Atualizado**

### **📋 Requisitos**
- PHP 8.2 ou superior
- Composer 2.0 ou superior
- MySQL 8.0 ou superior
- XAMPP (Apache + MySQL)

### **🔧 Instalação Passo a Passo**

#### **1. Limpar Cache e Arquivos Antigos**
```bash
# Deletar vendor e composer.lock
rm -rf vendor/
rm composer.lock

# No Windows:
# rmdir /s vendor
# del composer.lock
```

#### **2. Instalar Dependências Laravel 12**
```bash
# Instalar dependências principais
composer require laravel/framework:^12.0
composer require laravel/sanctum:^4.0
composer require laravel/tinker:^2.9
composer require spatie/laravel-permission:^6.0
composer require guzzlehttp/guzzle:^7.2

# Instalar dependências de desenvolvimento
composer require --dev fakerphp/faker:^1.24
composer require --dev laravel/pint:^1.13
composer require --dev laravel/sail:^1.26
composer require --dev mockery/mockery:^1.6
composer require --dev nunomaduro/collision:^8.0
composer require --dev phpunit/phpunit:^11.0
composer require --dev spatie/laravel-ignition:^2.4
```

#### **3. Configurar Aplicação**
```bash
# Copiar arquivo de configuração
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate

# Executar migrations
php artisan migrate

# Iniciar servidor
php artisan serve
```

### **🔑 Configuração do Banco de Dados**

#### **1. Criar Banco no XAMPP**
- Abrir XAMPP Control Panel
- Iniciar Apache e MySQL
- Acessar http://localhost/phpmyadmin
- Criar banco: `barbertime`

#### **2. Configurar .env**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=barbertime
DB_USERNAME=root
DB_PASSWORD=
```

### **🚀 Comandos de Verificação**

#### **1. Verificar Instalação**
```bash
# Verificar versão do PHP
php --version

# Verificar versão do Composer
composer --version

# Verificar versão do Laravel
php artisan --version
```

#### **2. Testar Aplicação**
```bash
# Iniciar servidor
php artisan serve

# Acessar no navegador
# http://localhost:8000
# http://localhost:8000/api/health
```

### **🔧 Solução de Problemas Comuns**

#### **1. Erro de Permissões**
```bash
# Linux/Mac
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/

# Windows
# Executar como Administrador
```

#### **2. Erro de Cache**
```bash
# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

#### **3. Erro de Dependências**
```bash
# Reinstalar dependências
composer install --no-cache
composer dump-autoload
```

#### **4. Erro de Banco de Dados**
```bash
# Recriar banco
php artisan migrate:fresh
php artisan db:seed
```

### **📱 URLs de Acesso**

- **Frontend:** http://localhost:5173
- **Backend:** http://localhost:8000
- **API Health:** http://localhost:8000/api/health
- **phpMyAdmin:** http://localhost/phpmyadmin

### **🔐 Criar Usuário Admin**

```bash
# Via Tinker
php artisan tinker

# No tinker:
User::create([
    'name' => 'Administrador',
    'email' => 'admin@barbertime.com',
    'password' => bcrypt('123456'),
    'role' => 'admin'
]);
```

### **✅ Checklist de Verificação**

- [ ] PHP 8.2+ instalado
- [ ] Composer 2.0+ instalado
- [ ] XAMPP rodando (Apache + MySQL)
- [ ] Banco `barbertime` criado
- [ ] Arquivo `.env` configurado
- [ ] `composer install` executado
- [ ] `php artisan key:generate` executado
- [ ] `php artisan migrate` executado
- [ ] `php artisan serve` funcionando
- [ ] Acessa http://localhost:8000
- [ ] API responde em http://localhost:8000/api/health

### **🚨 Erros Comuns e Soluções**

#### **1. "Method Illuminate\Foundation\Application::configure does not exist"**
- **Causa:** Versão incorreta do Laravel
- **Solução:** Usar Laravel 12 (já configurado)

#### **2. "Class 'App\Http\Kernel' not found"**
- **Causa:** Cache corrompido
- **Solução:** `composer dump-autoload`

#### **3. "SQLSTATE[HY000] [2002] Connection refused"**
- **Causa:** MySQL não está rodando
- **Solução:** Iniciar XAMPP MySQL

#### **4. "No application encryption key has been specified"**
- **Causa:** Chave não gerada
- **Solução:** `php artisan key:generate`

### **📋 Comandos Úteis**

```bash
# Desenvolvimento
php artisan serve
php artisan migrate
php artisan migrate:fresh

# Produção
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Debug
php artisan tinker
php artisan route:list
php artisan config:show
```

### **🎯 Próximos Passos**

1. ✅ Backend Laravel 12 configurado
2. ✅ Frontend React configurado
3. ✅ Banco MySQL configurado
4. ✅ API REST funcionando
5. ✅ Sistema de agendamentos pronto

**O projeto está 100% funcional com Laravel 12!** 🎉