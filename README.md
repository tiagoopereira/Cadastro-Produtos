# Cadastro-Produtos
### Execução
####  Makefile:
    - make run
    - localhost:8080
#### Rodando separadamente
    - composer install (Para instalar as dependências e gerar o arquivo de autoload).
    - copiar o arquivo ".env.example" para ".env" (cp .env.example .env)
    
    > Utilizando Docker:
        - docker-compose up -d
        - docker exec -it php php bin/console doctrine:migrations:migrate
  
    > Utilizando somente PHP:
        - Necessário PHP:8.*
        - php -S 0.0.0.0:80 -t public/
        - php bin/console doctrine:migrations:migrate

#### Rotas
    > Produtos
        - /products => listagem de produtos
        - /products/create => criação de produto
        - /products/{id} => listagem de um produto em modo formulário para edição
        - /products/{id} (DELETE) => exclusão de um produto
        
    > Tags
        - /tags => listagem de tags
        - /tags/create => criação de tag
        - /tags/{id} => listagem de uma tag em modo formulário para edição
        - /tags/{id} (DELETE) => exclusão de uma tag
    
