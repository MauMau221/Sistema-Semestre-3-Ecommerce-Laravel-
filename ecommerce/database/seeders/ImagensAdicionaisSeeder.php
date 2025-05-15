<?php

namespace Database\Seeders;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ImagensAdicionaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Listar as categorias disponíveis para debug
        $categorias = Categoria::all();
        $this->command->info("Categorias disponíveis:");
        foreach ($categorias as $categoria) {
            $this->command->info("ID: {$categoria->id}, Nome: {$categoria->nome}");
        }

        // Processar as categorias
        $this->processarCategoria('camisetas', ['camiseta', 'tshirt', 't-shirt']);
        $this->processarCategoria('polos', ['polo', 'camisa polo']);
        $this->processarCategoria('acessorios', ['acessorio', 'acessório', 'relogio', 'relógio', 'oculos', 'óculos']);
    }

    /**
     * Processa imagens para uma categoria específica
     */
    private function processarCategoria($pastaImagens, $termosPesquisa)
    {
        // Caminho para as imagens da categoria
        $path = "image/cards/$pastaImagens";
        $fullPath = public_path($path);
        
        // Verifica se o diretório existe usando File
        if (!File::exists($fullPath)) {
            $this->command->error("Diretório não encontrado: $fullPath");
            return;
        }
        
        $this->command->info("Processando imagens de $pastaImagens em: $fullPath");
        
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
        
        // Tenta encontrar a categoria pelo nome
        $categoriaId = null;
        foreach ($termosPesquisa as $termo) {
            $categoria = Categoria::where('nome', 'like', "%$termo%")->first();
            if ($categoria) {
                $categoriaId = $categoria->id;
                $this->command->info("Categoria encontrada: {$categoria->nome} (ID: {$categoria->id})");
                break;
            }
        }
        
        // Obtém produtos baseados no termo de pesquisa
        $produtosQuery = Produto::query();
        
        if ($categoriaId) {
            // Se encontrou a categoria, busca por categoria
            $produtosQuery->where('categoria_id', $categoriaId);
        } else {
            // Caso contrário, busca por nome usando múltiplos termos
            $produtosQuery->where(function($query) use ($termosPesquisa) {
                foreach ($termosPesquisa as $index => $termo) {
                    if ($index === 0) {
                        $query->where('nome', 'like', "%$termo%");
                    } else {
                        $query->orWhere('nome', 'like', "%$termo%");
                    }
                }
            });
        }
        
        $produtos = $produtosQuery->get();
        
        if ($produtos->isEmpty()) {
            $this->command->warn("Nenhum produto encontrado para associar às imagens (pasta: $pastaImagens)");
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
        
        $this->command->info("Processo concluído para $pastaImagens");
    }
} 