<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateStorageLink extends Command
{
    protected $signature = 'app:create-storage-link';
    protected $description = 'Cria o link simbólico do storage se ele não existir';

    public function handle()
    {
        if (File::exists(public_path('storage'))) {
            $this->info('O link simbólico já existe!');
            return 0;
        }

        try {
            $this->call('storage:link');
            $this->info('Link simbólico criado com sucesso!');
            
            // Criar diretório para imagens padrão
            $defaultImagePath = storage_path('app/public/image/default-product.jpg');
            if (!File::exists($defaultImagePath)) {
                File::makeDirectory(dirname($defaultImagePath), 0755, true, true);
                // Copiar uma imagem padrão para o diretório (você precisará criar essa imagem)
                // File::copy(resource_path('images/default-product.jpg'), $defaultImagePath);
                $this->info('Diretório para imagens padrão criado.');
            }
            
            return 0;
        } catch (\Exception $e) {
            $this->error('Erro ao criar o link simbólico: ' . $e->getMessage());
            return 1;
        }
    }
} 