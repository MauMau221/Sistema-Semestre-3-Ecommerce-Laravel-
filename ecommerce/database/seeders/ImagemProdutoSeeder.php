<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ImagemProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Caminho para as imagens de camisas
        $path = 'image/cards/camisas';
        $fullPath = public_path($path);
        
        // Verifica se o diretório existe usando File em vez de Storage
        if (!File::exists($fullPath)) {
            $this->command->error("Diretório não encontrado: $fullPath");
            return;
        }
        
        $this->command->info("Usando diretório: $fullPath");
        
        // Lista todas as imagens disponíveis
        $files = File::files($fullPath);
        $imagens = [];
        
        foreach ($files as $file) {
            $extension = File::extension($file);
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $imagens[] = $file;
            }
        }
        
        if (empty($imagens)) {
            $this->command->warn("Nenhuma imagem encontrada em $fullPath");
            return;
        }
        
        $this->command->info("Encontradas " . count($imagens) . " imagens");
        
        // Obtém todos os produtos da categoria "camisas" (ID 1) ou que contenham "camisa" no nome
        $produtos = Produto::where('categoria_id', 1)
                           ->orWhere('nome', 'like', '%camisa%')
                           ->get();
        
        if ($produtos->isEmpty()) {
            $this->command->warn("Nenhum produto encontrado para associar às imagens");
            return;
        }
        
        $this->command->info("Encontrados " . $produtos->count() . " produtos para associar às imagens");
        
        // Associa imagens aos produtos
        foreach ($produtos as $index => $produto) {
            if (isset($imagens[$index])) {
                // Cria o caminho relativo para o public
                $relativePath = $path . '/' . File::basename($imagens[$index]);
                
                // Atualiza o produto com a URL da imagem
                $produto->url = $relativePath;
                $produto->save();
                
                $this->command->info("Produto '{$produto->nome}' atualizado com a imagem: {$relativePath}");
            } else {
                // Se acabarem as imagens, usa uma imagem aleatória entre as disponíveis
                if (!empty($imagens)) {
                    $randomIndex = array_rand($imagens);
                    $relativePath = $path . '/' . File::basename($imagens[$randomIndex]);
                    
                    $produto->url = $relativePath;
                    $produto->save();
                    
                    $this->command->info("Produto '{$produto->nome}' atualizado com a imagem aleatória: {$relativePath}");
                }
            }
        }
        
        $this->command->info("Processo concluído: imagens associadas aos produtos");
    }
} 