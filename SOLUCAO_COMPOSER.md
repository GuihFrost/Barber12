# 🔧 **Solução para Erro do Composer**

## ❌ **Problema**
```
Your requirements could not be resolved to an installable set of packages.
laravel/sanctum[v3.2.0, ..., v3.3.3] require illuminate/support ^9.21|^10.0
```

## ✅ **Solução**

### **1. Deletar arquivos de cache**
```bash
# Deletar vendor e composer.lock
rm -rf vendor/
rm composer.lock

# Ou no Windows:
# rmdir /s vendor
# del composer.lock
```

### **2. Atualizar composer.json para versões compatíveis**
```json
{
    "require": {
        "php": "^8.1",
        "guzzlehttp/guzzle": "^7.2",
        "laravel/framework": "^10.10",
        "laravel/sanctum": "^3.2",
        "laravel/tinker": "^2.8",
        "spatie/laravel-permission": "^5.10"
    }
}
```

### **3. Instalar dependências**
```bash
composer install --no-cache
```

### **4. Se ainda der erro, usar versões específicas**
```bash
composer require laravel/framework:^10.10
composer require laravel/sanctum:^3.2
composer require spatie/laravel-permission:^5.10
```

### **5. Gerar chave e executar**
```bash
php artisan key:generate
php artisan migrate
php artisan serve
```

## 🚀 **Comandos Completos**

```bash
# 1. Limpar tudo
rm -rf vendor/ composer.lock

# 2. Instalar dependências
composer install --no-cache

# 3. Configurar aplicação
php artisan key:generate
php artisan migrate

# 4. Iniciar servidor
php artisan serve
```

## 🔑 **Se php artisan não funcionar**

Adicione manualmente no `.env`:
```env
APP_KEY=base64:YourAppKeyHere1234567890123456789012345678901234567890=
```