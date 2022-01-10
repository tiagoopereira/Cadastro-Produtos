# Cadastro-Produtos
### Execução
####  Makefile:
    - make run
    - porta utilizada: 8080
#### Rodando separadamente
    - composer install (Para instalar as dependências e gerar o arquivo de autoload).
    - copiar o arquivo ".env.example" para ".env" (cp .env.example .env)
    
    > Utilizando Docker:
        - docker-compose up -d
        - docker exec -it php php bin/console doctrine:migrations:migrate
        - porta utilizada: 8080
          
    > Utilizando somente PHP:
        - Necessário PHP:8.*
        - php -S 0.0.0.0:8080 -t public/
        - php bin/console doctrine:migrations:migrate

#### Rotas
    > Produtos
        - /products [GET] => listagem de produtos
        - /products/create [GET/POST] => criação de produto
        - /products/{id} [GET/POST] => listagem de um produto em modo formulário para edição
        - /products/{id} [DELETE] => exclusão de um produto
        
    > Tags
        - /tags [GET] => listagem de tags
        - /tags/create [GET/POST] => criação de tag
        - /tags/{id} [GET/POST] => listagem de uma tag em modo formulário para edição
        - /tags/{id} [DELETE] => exclusão de uma tag

#### Query de relatório de relevânca de produto
```sql
SELECT
   t.name as "Tag",
   count(pt.product_id) as "Products_Sum"
FROM tags t
LEFT JOIN product_tag pt ON pt.tag_id = t.id
GROUP BY t.id;
```
