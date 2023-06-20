# API de Gerenciamento de Lugares

Esta é uma API simples para gerenciar lugares.

## Como Executar

1. Clone o repositório.
2. Instale as dependências usando o Composer: `composer install`.
3. Crie um arquivo de ambiente a partir do exemplo fornecido: `cp .env.example .env`.
4. Configure as variáveis de ambiente no arquivo `.env`, como conexão com o banco de dados.
5. Execute as migrations para criar as tabelas no banco de dados: `php artisan migrate`.
6. Inicie o servidor de desenvolvimento: `php artisan serve`.
7. no arquivo `docker-compose.yml`, certifique-se de substituir placessystem, postgres e 123123 pelas configurações apropriadas para o seu ambiente.
## Endpoints

### Criar um lugar

**URL:** `/api/places`

**Método:** `POST`

**Corpo da Requisição:**
{
  "name": "Nome do Lugar",
  "slug": "nome-do-lugar",
  "city": "Cidade",
  "state": "Estado"
}

### Editar um lugar

**URL:** `/api/places/{id}`

**Método:** `PUT`

**Corpo da Requisição:**
{
  "name": "Novo Nome do Lugar",
  "city": "Nova Cidade",
  "state": "Novo Estado"
}

### Obter um lugar específico

**URL:** `/api/places/{id}`

**Método:** `GET`

### Listar lugares e filtrá-los por nome

**URL:** `/api/places`

**Método:** `GET`
### Parâmetros de consulta opcionais:name: Filtra os lugares pelo nome. Exemplo: /api/places?name=Nome 


### Excluir um lugar
**URL:** `/api/places/{id}`

**Método:** `DELETE`


