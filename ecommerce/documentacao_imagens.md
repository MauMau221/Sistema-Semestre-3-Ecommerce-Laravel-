# Configuração de Imagens para Produtos

## Estrutura e Organização de Imagens

Este sistema foi configurado para lidar com imagens de produtos utilizando o storage do Laravel. As imagens são armazenadas em `storage/app/public/image/cards/camisas` e são associadas aos produtos através do campo `url` na tabela de produtos.

## Como utilizar imagens para os produtos

### 1. Preparar as imagens

1. Coloque suas imagens na pasta `storage/app/public/image/cards/camisas`.
2. Certifique-se de que as imagens têm formato jpg, jpeg, png ou gif.
3. Idealmente, nomeie as imagens de forma descritiva, por exemplo: `camisa-social-azul.jpg`.

### 2. Criar o link simbólico (se ainda não existe)

O Laravel requer um link simbólico entre a pasta de storage e a pasta public para acessar as imagens. Execute:

```bash
php artisan app:create-storage-link
```

Este comando criará o link simbólico se ele ainda não existir.

### 3. Associar imagens aos produtos

Você tem duas opções para associar imagens aos produtos:

#### Opção 1: Executar o seeder específico para imagens

Se você já tem produtos criados e deseja associar imagens a eles:

```bash
php artisan db:seed --class=ImagemProdutoSeeder
```

Este seeder irá:
- Escanear a pasta `storage/app/public/image/cards/camisas`
- Encontrar produtos com categoria "camisas" ou que têm "camisa" no nome
- Associar cada imagem a um produto (na ordem em que foram encontrados)

#### Opção 2: Adicionar imagens durante a criação de produtos

Ao criar novos seeders para produtos, use o código do `CamisasSeeder.php` como modelo. Ele foi modificado para buscar imagens disponíveis e associá-las aos produtos automaticamente.

### 4. Verificar as associações

Após executar os seeders, você pode verificar se as imagens foram corretamente associadas através do painel administrativo ou consultando diretamente o banco de dados.

## Estrutura do código

1. **Campo URL no banco de dados**: O campo `url` na tabela `produtos` armazena o caminho relativo da imagem.
2. **Views adaptadas**: As views foram adaptadas para verificar:
   - Primeiro, se o produto tem uma URL no banco de dados
   - Caso contrário, busca pela convenção antiga (camisa{id}.jpg)
   - Em último caso, mostra uma imagem padrão

## Adicionando múltiplas imagens por produto

Para implementar múltiplas imagens por produto, seria necessário:

1. Criar uma nova tabela `imagens_produto` com os campos:
   - `id` (chave primária)
   - `produto_id` (chave estrangeira para a tabela produtos)
   - `url` (caminho da imagem)
   - `ordem` (para a ordem de exibição)
   - `é_principal` (boolean para marcar a imagem principal)

2. Criar o relacionamento no modelo Produto:
   ```php
   public function imagens()
   {
       return $this->hasMany(ImagemProduto::class);
   }
   ```

3. Adaptar as views para buscar várias imagens por produto.

## Solução de problemas

### Imagens não aparecem
- Verifique se o link simbólico foi criado corretamente
- Certifique-se de que as permissões de arquivo estão corretas
- Verifique se as URLs no banco de dados apontam para o caminho correto

### Imagens não são associadas corretamente
- Verifique se os produtos existem e correspondem aos critérios no seeder
- Certifique-se de que as imagens estão na pasta correta e nos formatos suportados 