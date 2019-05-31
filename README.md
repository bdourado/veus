## Desafio Veus

Projeto de API +  Frontend + Docker desenvolvido por Bruno Moura Dourado

A API foi feita em PHP utilizando o framework Laravel, banco de dados MySql e o frontend em VueJS.

No Docker foi utilizado as portas 8888, 33065 e 3001, caso algumas dessas portas estejam ocupadas, fique a vontade para altera-las no `docker-compose.yml`

Para rodar o projeto, basta seguir os passos:

```bash
git clone git@github.com:bdourado/veus.git
```

Após fazer o download do projeto, entrar na pasta Veus:

```bash
cd veus
```

Após entrar na pasta, rodar o seguinte comando para subir os containers Docker:


```bash
docker-compose up -d
```

Após realizar toda a instalação do Docker (pode demorar alguns minutos devido ao Download dos pacotes do Composer), utilizar os seguintes comandos:

```bash
//comando para criar as tabelas popular a base de de dados
docker exec -it php_bdourado_veus php artisan migrate --seed
```
Caso de algum erro na hora de gerar a migration, basta executar o comando novamente. O motivo do erro é devido ao container do banco de dados ainda não ter subido. 

Após realizar a "migration" basta acessar http://localhost:3001.

Login: admin@email.com

Senha: secret

## API:

#### Login:

Método: POST 

Campos:

email: 'admin@email.com'

password: 'secret'

url: http://localhost:8888/api/v1/auth/login


#### Listar todos os produtos (já vem paginado):

Método: GET

Aythorization Bearer Token: Token gerado pelo login

Query string: q & filter

url sem query string: http://localhost:8888/api/v1/products

url com query string: http://localhost:8888/api/v1/products?&q=consequatur&filter=brand:quam


#### Adicionar novo produto:

Método: POST

campos:

nome: string

marcas_id: id da marca

qtty: Integer

preco: Float

url: http://localhost:8888/api/v1/products


#### Editar produto:

Método: PUT

campos:

nome: string

marcas_id: id da marca

qtty: Integer

preco: Float

url: http://localhost:8888/api/v1/products/{id_do_produto}


#### Deletar produto:

Método: DELETE

url: http://localhost:8888/api/v1/products/{id_do_produto}


## Observações

O arquivo '.env' está comitado para que vocês não precisem criar um novo arquivo.

Não é possível fazer edições fora do container. Deixei assim justamente para quando o CNontainer estiver pronto, ter apenas que rodar o comando para realizar a migration.

Não deixei o comando para rodar a migration no Dockerfile.makephp porque a base de dados ainda não terá subido no momento que executará o comando.
