# Moltro — E-commerce de Joias e Acessórios

E-commerce completo desenvolvido com **Laravel 12** e **MySQL** para apresentação acadêmica. A loja comercializa correntes, cordões, relógios, pulseiras, pingentes e anéis.

---

## Tecnologias

| Camada | Tecnologia |
|--------|-----------|
| Backend | PHP 8.2 + Laravel 12 |
| Banco de dados | MySQL |
| Frontend | Blade + Tailwind CSS (CDN) |
| Autenticação | Laravel Session Auth |
| Documentação API | Swagger UI (l5-swagger) |

---

## Como rodar o projeto

### Pré-requisitos

- PHP 8.2+
- Composer
- MySQL
- Node.js (opcional)

### Passo a passo

```bash
# 1. Clonar o repositório
git clone <url-do-repositorio>
cd Programa-oWebTDE

# 2. Instalar dependências PHP
composer install

# 3. Copiar o arquivo de ambiente
cp .env.example .env

# 4. Gerar a chave da aplicação
php artisan key:generate

# 5. Configurar o banco no .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Moltro
DB_USERNAME=root
DB_PASSWORD=

# 6. Criar o banco de dados e rodar as migrations
php artisan migrate

# 7. Popular o banco com produtos de exemplo
php artisan db:seed --class=ProductSeeder

# 8. Gerar a documentação Swagger
php artisan l5-swagger:generate

# 9. Iniciar o servidor
php artisan serve
```

Acesse: **http://127.0.0.1:8000**

---

## Usuário admin padrão

Crie via Tinker após as migrations:

```bash
php artisan tinker
```

```php
App\Models\User::create([
    'name'     => 'Admin',
    'email'    => 'admin@teste.com',
    'password' => bcrypt('123456'),
    'is_admin' => true,
]);
```

---

## Páginas web

| Rota | Descrição |
|------|-----------|
| `/` | Home com banner, categorias e destaques |
| `/busca` | Busca e filtro por categoria |
| `/p/{slug}/{id}` | Página do produto |
| `/carrinho` | Carrinho de compras |
| `/checkout` | Finalizar compra (requer login) |
| `/favoritos` | Produtos favoritados |
| `/login` | Login |
| `/register` | Cadastro |
| `/meus-pedidos` | Histórico de pedidos (requer login) |
| `/meus-pedidos/{id}` | Detalhe do pedido |
| `/admin` | Painel administrativo (requer admin) |
| `/api/documentation` | Documentação Swagger |

---

## API REST

Base URL: `http://127.0.0.1:8000/api`

### Status

```
GET /api/health
```
```json
{ "status": "ok" }
```

---

### Produtos

#### Buscar produtos
```
GET /api/search?query=corrente&cat=correntes&page=1&limit=10
```

#### Obter produto por ID
```
GET /api/product/{id}
```

#### Criar produto *(Basic Auth)*
```
POST /api/products
Content-Type: application/json

{
  "name": "Corrente Prata 925",
  "description": "Corrente estilo cubana",
  "price": 349.90,
  "stock": 10,
  "category": "correntes",
  "color": "Prata",
  "size": "60cm",
  "weight": 0.045,
  "image": "https://exemplo.com/img.jpg"
}
```

#### Deletar produto *(Basic Auth)*
```
DELETE /api/product/{id}
```

---

### Carrinho

```
POST /api/cart
Content-Type: application/json

{
  "items": [
    { "productId": 1, "qty": 2 }
  ],
  "cupomCode": "URI10"
}
```

**Resposta:**
```json
{
  "subtotal": 699.80,
  "freight": 0,
  "discount": 69.98,
  "total": 629.82,
  "items": [...]
}
```

> Cupom disponível: `URI10` — 10% de desconto. Frete grátis para pedidos acima de R$ 300.

---

### Autenticação

#### Login
```
POST /api/login
Content-Type: application/json

{
  "email": "usuario@email.com",
  "password": "123456"
}
```

#### Registro
```
POST /api/register
Content-Type: application/json

{
  "name": "João Silva",
  "email": "joao@email.com",
  "password": "senha123"
}
```

---

### Pedidos

```
POST /api/orders
Content-Type: application/json

{
  "customer_name": "João Silva",
  "customer_email": "joao@email.com",
  "customer_phone": "(11) 99999-9999",
  "address": "Rua das Joias, 10, São Paulo - SP",
  "payment_method": "pix",
  "subtotal": 349.90,
  "freight": 0,
  "discount": 0,
  "total": 349.90,
  "items": [
    { "productId": 1, "qty": 1 }
  ]
}
```

---

## Categorias disponíveis

`correntes` · `cordoes` · `relogios` · `pulseiras` · `pingentes` · `aneis`

---

## Estrutura do projeto

```
app/
├── Http/Controllers/
│   ├── AdminController.php     # CRUD de produtos (admin)
│   ├── AuthController.php      # Login, registro, logout
│   ├── CartController.php      # Cálculo do carrinho
│   ├── OrderController.php     # Pedidos
│   ├── PageController.php      # Páginas web
│   ├── ProductController.php   # API de produtos
│   └── SwaggerController.php   # Anotações OpenAPI
├── Models/
│   ├── Order.php
│   ├── OrderItem.php
│   ├── Product.php
│   └── User.php
resources/views/
├── admin/          # Painel admin
├── layouts/        # Layouts base (app, admin)
├── home, search, product, cart, checkout, orders...
routes/
├── web.php         # Rotas web
└── api.php         # Rotas da API REST
```

---

## Licença

Projeto acadêmico — uso educacional.
