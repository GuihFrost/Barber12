# 🔧 **Solução de Problemas - Laravel 12**

## ❌ **Problemas Comuns e Soluções**

### **1. Erro: "Method Illuminate\Foundation\Application::configure does not exist"**
**Causa:** Versão incorreta do Laravel
**Solução:**
```bash
# Limpar cache
rm -rf vendor/ composer.lock

# Instalar Laravel 12
composer require laravel/framework:^12.0
```

### **2. Erro: "Class 'App\Http\Kernel' not found"**
**Causa:** Cache corrompido
**Solução:**
```bash
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

### **3. Erro: "SQLSTATE[HY000] [2002] Connection refused"**
**Causa:** MySQL não está rodando
**Solução:**
- Abrir XAMPP Control Panel
- Iniciar MySQL
- Verificar se a porta 3306 está livre

### **4. Erro: "No application encryption key has been specified"**
**Causa:** Chave não gerada
**Solução:**
```bash
php artisan key:generate
```

### **5. Erro: "Target class [App\Http\Middleware\RoleMiddleware] does not exist"**
**Causa:** Middleware não registrado
**Solução:**
```bash
composer dump-autoload
php artisan config:clear
```

### **6. Erro: "Class 'Laravel\Sanctum\Sanctum' not found"**
**Causa:** Sanctum não instalado
**Solução:**
```bash
composer require laravel/sanctum:^4.0
```

### **7. Erro: "Class 'Spatie\Permission\PermissionServiceProvider' not found"**
**Causa:** Spatie Permission não instalado
**Solução:**
```bash
composer require spatie/laravel-permission:^6.0
```

### **8. Erro: "Call to undefined method Illuminate\Foundation\Application::configure"**
**Causa:** Laravel 11+ sendo usado com bootstrap Laravel 10
**Solução:**
```bash
# Atualizar bootstrap/app.php para Laravel 12
# (já feito no projeto)
```

### **9. Erro: "Class 'App\Providers\RouteServiceProvider' not found"**
**Causa:** Service Provider não encontrado
**Solução:**
```bash
composer dump-autoload
php artisan config:clear
```

### **10. Erro: "Target class [App\Http\Controllers\AuthController] does not exist"**
**Causa:** Controller não encontrado
**Solução:**
```bash
composer dump-autoload
php artisan config:clear
```

## 🔧 **Comandos de Correção Automática**

### **Windows:**
```bash
# Executar correção automática
corrigir-erros.bat

# Configuração automática
configurar-automatico.bat

# Verificar erros
php verificar-erros.php
```

### **Linux/Mac:**
```bash
# Executar correção automática
./corrigir-erros.sh

# Configuração automática
./corrigir-erros.sh

# Verificar erros
php verificar-erros.php
```

## 🚀 **Comandos de Emergência**

### **Reset Completo:**
```bash
# Limpar tudo
rm -rf vendor/ composer.lock storage/framework/cache/* storage/framework/sessions/* storage/framework/views/*

# Reinstalar
composer install
php artisan key:generate
php artisan migrate
```

### **Verificar Sistema:**
```bash
# Verificar PHP
php --version

# Verificar Composer
composer --version

# Verificar Laravel
php artisan --version

# Verificar banco
php artisan tinker
# No tinker: DB::connection()->getPdo();
```

## 📋 **Checklist de Verificação**

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

## 🆘 **Se Nada Funcionar**

1. **Verificar logs:**
```bash
tail -f storage/logs/laravel.log
```

2. **Executar verificação:**
```bash
php verificar-erros.php
```

3. **Reset completo:**
```bash
# Deletar tudo
rm -rf vendor/ composer.lock storage/framework/cache/* storage/framework/sessions/* storage/framework/views/*

# Reinstalar
composer install
php artisan key:generate
php artisan migrate
php artisan serve
```

4. **Verificar permissões:**
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

## ✅ **Status Final**

Após seguir todas as correções:
- ✅ Laravel 12 funcionando
- ✅ Banco MySQL conectado
- ✅ API REST respondendo
- ✅ Sistema de agendamentos pronto
- ✅ Frontend e Backend integrados

**O projeto está 100% funcional!** 🎉