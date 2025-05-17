<?php

namespace Database\Seeders;

use App\Models\Produto;
use App\Models\Estoque;
use Illuminate\Database\Seeder;

class NovosProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Adicionar produtos para categoria Polos (ID: 5)
        $this->criarProdutosPolos();
        
        // Adicionar produtos para categoria Acessorios (ID: 7)
        $this->criarProdutosAcessorios();
    }
    
    /**
     * Criar produtos para categoria Polos
     */
    private function criarProdutosPolos()
    {
        $categoriaId = 5; // ID da categoria "polos"
        
        $produtos = [
            [
                'nome' => 'Polo Básica Azul',
                'desc' => 'Polo básica azul em algodão pima, confortável e elegante para o dia a dia.',
                'preco' => 119.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => null,
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Polo Listrada',
                'desc' => 'Polo listrada com detalhes em contraste, perfeita para um visual casual sofisticado.',
                'preco' => 139.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => null,
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Polo Premium',
                'desc' => 'Polo premium com acabamento diferenciado, bordado no peito e tecido de alta qualidade.',
                'preco' => 159.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => null,
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Polo Manga Longa',
                'desc' => 'Polo de manga longa em algodão, ideal para dias mais frios ou ambientes com ar-condicionado.',
                'preco' => 149.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => null,
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Polo Colorida',
                'desc' => 'Polo em cores vibrantes, perfeita para um visual despojado e cheio de personalidade.',
                'preco' => 129.90,
                'desconto' => 10.00,
                'status' => true,
                'url' => null,
                'categoria_id' => $categoriaId
            ]
        ];

        $this->criarProdutosEEstoque($produtos);
        $this->command->info('Produtos da categoria Polos criados com sucesso!');
    }
    
    /**
     * Criar produtos para categoria Acessorios
     */
    private function criarProdutosAcessorios()
    {
        $categoriaId = 7; // ID da categoria "acessorios"
        
        $produtos = [
            [
                'nome' => 'Relógio Analógico Clássico',
                'desc' => 'Relógio analógico com pulseira em couro legítimo e mostrador clássico.',
                'preco' => 299.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => null,
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Óculos de Sol Premium',
                'desc' => 'Óculos de sol com lentes polarizadas e armação em acetato de alta qualidade.',
                'preco' => 249.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => null,
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Carteira em Couro',
                'desc' => 'Carteira em couro legítimo com múltiplos compartimentos para cartões e documentos.',
                'preco' => 179.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => null,
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Cinto Social',
                'desc' => 'Cinto social em couro com fivela em metal escovado, elegante e durável.',
                'preco' => 129.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => null,
                'categoria_id' => $categoriaId
            ]
        ];

        $this->criarProdutosEEstoque($produtos);
        $this->command->info('Produtos da categoria Acessórios criados com sucesso!');
    }
    
    /**
     * Método comum para criar produtos e estoque
     */
    private function criarProdutosEEstoque($produtos)
    {
        foreach ($produtos as $produto) {
            $novoProduto = Produto::create($produto);
            
            // Adicionar estoque para cada produto com diferentes cores e tamanhos
            $cores = ['Preto', 'Azul', 'Branco', 'Cinza'];
            
            // Para acessórios, usamos tamanhos diferentes
            if ($produto['categoria_id'] == 7) { // ID da categoria "acessorios"
                $tamanhos = ['Único', 'P', 'M', 'G'];
            } else {
                $tamanhos = ['P', 'M', 'G', 'GG'];
            }
            
            foreach ($cores as $cor) {
                foreach ($tamanhos as $tamanho) {
                    Estoque::create([
                        'produto_id' => $novoProduto->id,
                        'cor' => $cor,
                        'tamanho' => $tamanho,
                        'quantidade' => rand(5, 30)
                    ]);
                }
            }
        }
    }
} 