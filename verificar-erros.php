<?php

/**
 * Verificador de Erros - Laravel 12
 * Execute: php verificar-erros.php
 */

echo "========================================\n";
echo "   VERIFICADOR DE ERROS - LARAVEL 12\n";
echo "========================================\n\n";

$errors = [];
$warnings = [];

// Verificar versão do PHP
echo "[1/10] Verificando versão do PHP...\n";
$phpVersion = PHP_VERSION;
if (version_compare($phpVersion, '8.2.0', '<')) {
    $errors[] = "PHP 8.2+ necessário. Versão atual: $phpVersion";
} else {
    echo "✓ PHP $phpVersion (OK)\n";
}

// Verificar extensões PHP
echo "\n[2/10] Verificando extensões PHP...\n";
$requiredExtensions = ['pdo', 'pdo_mysql', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'json', 'bcmath'];
foreach ($requiredExtensions as $ext) {
    if (!extension_loaded($ext)) {
        $errors[] = "Extensão PHP '$ext' não encontrada";
    } else {
        echo "✓ $ext\n";
    }
}

// Verificar Composer
echo "\n[3/10] Verificando Composer...\n";
$composerVersion = shell_exec('composer --version 2>&1');
if (strpos($composerVersion, 'Composer version') === false) {
    $errors[] = "Composer não encontrado ou não funcionando";
} else {
    echo "✓ Composer instalado\n";
}

// Verificar arquivo .env
echo "\n[4/10] Verificando arquivo .env...\n";
if (!file_exists('.env')) {
    $errors[] = "Arquivo .env não encontrado";
} else {
    echo "✓ Arquivo .env existe\n";
}

// Verificar chave da aplicação
echo "\n[5/10] Verificando chave da aplicação...\n";
$envContent = file_get_contents('.env');
if (strpos($envContent, 'APP_KEY=') !== false && strpos($envContent, 'APP_KEY=') === strpos($envContent, 'APP_KEY=')) {
    $warnings[] = "Chave da aplicação pode não estar configurada";
} else {
    echo "✓ Chave da aplicação configurada\n";
}

// Verificar configuração do banco
echo "\n[6/10] Verificando configuração do banco...\n";
if (strpos($envContent, 'DB_DATABASE=barbertime') === false) {
    $warnings[] = "Banco de dados pode não estar configurado corretamente";
} else {
    echo "✓ Configuração do banco OK\n";
}

// Verificar pasta vendor
echo "\n[7/10] Verificando dependências...\n";
if (!is_dir('vendor')) {
    $errors[] = "Pasta vendor não encontrada. Execute: composer install";
} else {
    echo "✓ Dependências instaladas\n";
}

// Verificar arquivos Laravel
echo "\n[8/10] Verificando arquivos Laravel...\n";
$laravelFiles = ['bootstrap/app.php', 'app/Http/Kernel.php', 'routes/api.php'];
foreach ($laravelFiles as $file) {
    if (!file_exists($file)) {
        $errors[] = "Arquivo Laravel '$file' não encontrado";
    } else {
        echo "✓ $file\n";
    }
}

// Verificar permissões
echo "\n[9/10] Verificando permissões...\n";
$directories = ['storage', 'bootstrap/cache'];
foreach ($directories as $dir) {
    if (!is_writable($dir)) {
        $warnings[] = "Diretório '$dir' não tem permissão de escrita";
    } else {
        echo "✓ $dir (writable)\n";
    }
}

// Verificar conectividade com banco
echo "\n[10/10] Verificando conectividade com banco...\n";
try {
    $pdo = new PDO(
        'mysql:host=127.0.0.1;port=3306',
        'root',
        ''
    );
    echo "✓ Conexão com MySQL OK\n";
} catch (PDOException $e) {
    $warnings[] = "Não foi possível conectar ao MySQL: " . $e->getMessage();
}

// Resumo
echo "\n========================================\n";
echo "   RESUMO DA VERIFICAÇÃO\n";
echo "========================================\n";

if (empty($errors) && empty($warnings)) {
    echo "✅ TUDO OK! O sistema está funcionando perfeitamente.\n";
} else {
    if (!empty($errors)) {
        echo "❌ ERROS ENCONTRADOS:\n";
        foreach ($errors as $error) {
            echo "   • $error\n";
        }
    }
    
    if (!empty($warnings)) {
        echo "\n⚠️  AVISOS:\n";
        foreach ($warnings as $warning) {
            echo "   • $warning\n";
        }
    }
}

echo "\n========================================\n";
echo "   COMANDOS DE CORREÇÃO\n";
echo "========================================\n";
echo "Para corrigir erros, execute:\n";
echo "  Windows: corrigir-erros.bat\n";
echo "  Linux/Mac: ./corrigir-erros.sh\n";
echo "  Manual: composer install && php artisan key:generate\n";
echo "\n";