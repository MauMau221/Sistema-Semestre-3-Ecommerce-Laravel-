<?php

namespace App\Services;

use App\Models\Produto;
use Illuminate\Support\Facades\File;

/**
 * Classe ProductImageService
 * 
 * Esta classe é responsável por gerenciar e processar as imagens dos produtos no sistema.
 * Ela centraliza toda a lógica de busca, priorização e fallback de imagens.
 */
class ProductImageService
{
    /**
     * Diretório base para as imagens de produtos
     */
    protected $baseDir = 'image/cards';
    
    /**
     * Obtém a URL da imagem para um produto
     * 
     * Este é o método principal que busca e retorna a melhor imagem disponível para o produto,
     * seguindo uma série de prioridades e fallbacks.
     * 
     * @param Produto $produto O objeto do produto
     * @param string|null $categoria O nome da categoria (opcional)
     * @return string A URL da imagem pronta para uso
     */
    public function getProductImageUrl(Produto $produto, ?string $categoria = null): string
    {
        // Se o produto já tem uma URL de imagem definida no banco de dados, usa ela
        if ($produto->url && File::exists(public_path($produto->url))) {
            return asset($produto->url);
        }
        
        // Se a categoria não foi fornecida, tenta obtê-la do produto
        if (!$categoria) {
            $categoria = $produto->categoria ? strtolower($produto->categoria->nome) : null;
        }
        
        // Busca todos os possíveis caminhos de imagem em ordem de prioridade
        $possiblePaths = $this->getPossibleImagePaths($produto, $categoria);
        
        // Verifica cada caminho possível e retorna o primeiro que existir
        foreach ($possiblePaths as $path) {
            if (File::exists(public_path($path))) {
                return asset($path);
            }
        }
        
        // Se nenhuma imagem específica for encontrada, retorna a imagem padrão
        return asset("{$this->baseDir}/default.jpg");
    }
    
    /**
     * Obtém todos os caminhos possíveis de imagem para um produto
     * 
     * Este método gera uma lista priorizada de possíveis localizações onde 
     * a imagem do produto pode estar armazenada.
     * 
     * @param Produto $produto O objeto do produto
     * @param string|null $categoria O nome da categoria
     * @return array Lista de caminhos possíveis de imagem
     */
    protected function getPossibleImagePaths(Produto $produto, ?string $categoria): array
    {
        $id = $produto->id;
        $nome = $this->formatNameForFile($produto->nome);
        $paths = [];
        
        // Extensões de imagem comuns para verificar
        $extensions = ['jpg', 'jpeg', 'png', 'webp'];
        
        // Se temos uma categoria, verifica primeiro os caminhos específicos da categoria
        if ($categoria) {
            foreach ($extensions as $ext) {
                // Padrão: categoria/id_produto.ext (ex: camisas/1.jpg)
                $paths[] = "{$this->baseDir}/{$categoria}/{$id}.{$ext}";
                
                // Padrão: categoria/id_produto_nome.ext (ex: camisas/1_camiseta_basica.jpg)
                $paths[] = "{$this->baseDir}/{$categoria}/{$id}_{$nome}.{$ext}";
                
                // Suporte a padrão legado: categoria/camisa{id}.ext
                $paths[] = "{$this->baseDir}/{$categoria}/camisa{$id}.{$ext}";
                
                // Nomenclatura específica por tipo de produto
                // (ex: camisas/camisa1.jpg, calcas/calca1.jpg)
                if ($categoria == 'camisas' || $categoria == 'camisetas' || $categoria == 'polos') {
                    $paths[] = "{$this->baseDir}/{$categoria}/camisa{$id}.{$ext}";
                } elseif ($categoria == 'calcas') {
                    $paths[] = "{$this->baseDir}/{$categoria}/calca{$id}.{$ext}";
                } elseif ($categoria == 'calcados') {
                    $paths[] = "{$this->baseDir}/{$categoria}/calcado{$id}.{$ext}";
                } elseif ($categoria == 'jaquetas') {
                    $paths[] = "{$this->baseDir}/{$categoria}/jaqueta{$id}.{$ext}";
                } elseif ($categoria == 'acessorios') {
                    $paths[] = "{$this->baseDir}/{$categoria}/acessorio{$id}.{$ext}";
                }
            }
            
            // Imagem padrão da categoria como fallback
            $paths[] = "{$this->baseDir}/{$categoria}/default.jpg";
        }
        
        // Caminhos genéricos sem categoria (diretório produtos)
        foreach ($extensions as $ext) {
            $paths[] = "{$this->baseDir}/produtos/{$id}.{$ext}";
            $paths[] = "{$this->baseDir}/produtos/{$id}_{$nome}.{$ext}";
        }
        
        // Fallback para imagem numerada (determinística baseada no ID do produto)
        // Garante que o mesmo produto sempre use a mesma imagem de fallback
        $randomIndex = ($id % 5) + 1; // Resulta em um número entre 1 e 5
        $paths[] = "{$this->baseDir}/image{$randomIndex}.png";
        
        return $paths;
    }
    
    /**
     * Formata um nome de produto para uso em nomes de arquivos
     * 
     * Converte o nome do produto em um formato seguro para uso em nomes de arquivos,
     * removendo acentos, caracteres especiais e padronizando o formato.
     * 
     * @param string $name O nome do produto
     * @return string Nome formatado para arquivos
     */
    protected function formatNameForFile(string $name): string
    {
        // Remove acentos
        $name = $this->removeAccents($name);
        
        // Converte para minúsculas, substitui espaços e caracteres especiais por underscore
        $name = strtolower($name);
        $name = preg_replace('/[^a-z0-9]/', '_', $name);
        $name = preg_replace('/_+/', '_', $name); // Substitui múltiplos underscores por um único
        $name = trim($name, '_');
        
        return $name;
    }
    
    /**
     * Remove acentos de uma string
     * 
     * Função útil para normalizar textos para uso em URLs e nomes de arquivos.
     * 
     * @param string $string A string de entrada
     * @return string A string sem acentos
     */
    protected function removeAccents(string $string): string
    {
        if (!preg_match('/[\x80-\xff]/', $string)) {
            return $string;
        }

        $chars = [
            // Latin-1 Supplement
            'ª' => 'a', 'º' => 'o', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
            'Æ' => 'AE', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I',
            'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O',
            'Ö' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 'ß' => 's',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o',
            'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'þ' => 'th', 'ÿ' => 'y',
        ];
        
        return strtr($string, $chars);
    }
} 