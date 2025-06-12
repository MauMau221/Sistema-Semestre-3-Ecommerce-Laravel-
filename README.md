# LARAVEL-3-Semestre_Ecommerce
Para que o projeto funcione certifique se as seguintes dependências estão instaladas:  <br>  
PHP 8.2.x >=  <br>  
Composer version 2.7.2 >= <br>  
Node.Js v20.9.0 >=  <br>  

-------------------------------------------
- Para acessar o projeto crie uma pasta com o nome que preferir. <br>  
- Com a pasta aberta no VSCode abra o terminal e siga a sequencia de comandos. <br>  
git init <br>  
git add . <br>  
git commit -m "Primeiro commit".  <br>  
git clone https://github.com/MauMau221/LARAVEL-3-Semestre_Ecommerce.git <br>  
cd LARAVEL-3-Semestre_Ecommerce <br>  
cd ecommerce <br>  
composer install <br>  

- Agora é só renomear o arquivo ".env.example" para ".env" <br>  
- Gerar a chave da aplicação: <br>  
php artisan key:generate <br>  
- Rodar as migrations para iniciar o banco de dados <br>  
php artisan migrate --seed <br>  

- Para funcionar login com o google devemos adicionar em .env <br>  
GOOGLE_CLIENT_ID="client_id" <br>  
GOOGLE_CLIENT_SECRET="client_secret" <br>  

- Agora devemos incluir as dependências do googleApi em nosso composer <br>  
composer require google/apiclient

- Agora é só iniciar o servidor: <br>  
php artisan serve <br>

- Comandos para gerar dados fictícios: <br>  
php artisan db:seed <br>  
---------------------------------------------

Base do site https://www.aramis.com.br/casual-15-off
