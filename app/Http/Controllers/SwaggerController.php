<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: 'LuxJoias API',
    version: '1.0.0',
    description: 'API REST do e-commerce LuxJoias — correntes, cordões, relógios, pulseiras e pingentes.',
    contact: new OA\Contact(email: 'admin@luxjoias.com')
)]
#[OA\Server(url: 'http://127.0.0.1:8000', description: 'Servidor local')]
#[OA\SecurityScheme(securityScheme: 'basicAuth', type: 'http', scheme: 'basic')]

// Tags
#[OA\Tag(name: 'Status',        description: 'Saúde da API')]
#[OA\Tag(name: 'Produtos',      description: 'Listagem e busca de produtos')]
#[OA\Tag(name: 'Carrinho',      description: 'Cálculo do carrinho')]
#[OA\Tag(name: 'Autenticação',  description: 'Login e registro')]
#[OA\Tag(name: 'Pedidos',       description: 'Criação de pedidos')]

// ── STATUS ────────────────────────────────────────────────────────────────────
#[OA\Get(
    path: '/api/health',
    summary: 'Verifica se a API está no ar',
    tags: ['Status'],
    responses: [new OA\Response(response: 200, description: 'API funcionando',
        content: new OA\JsonContent(example: ['status' => 'ok']))]
)]

// ── PRODUTOS ──────────────────────────────────────────────────────────────────
#[OA\Get(
    path: '/api/product/{id}',
    summary: 'Retorna um produto pelo ID',
    tags: ['Produtos'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
    responses: [
        new OA\Response(response: 200, description: 'Produto encontrado'),
        new OA\Response(response: 404, description: 'Produto não encontrado'),
    ]
)]
#[OA\Get(
    path: '/api/search',
    summary: 'Busca produtos com filtros e paginação',
    tags: ['Produtos'],
    parameters: [
        new OA\Parameter(name: 'query', in: 'query', description: 'Texto de busca',    schema: new OA\Schema(type: 'string')),
        new OA\Parameter(name: 'cat',   in: 'query', description: 'Categoria',          schema: new OA\Schema(type: 'string')),
        new OA\Parameter(name: 'page',  in: 'query', description: 'Página',             schema: new OA\Schema(type: 'integer', default: 1)),
        new OA\Parameter(name: 'limit', in: 'query', description: 'Itens por página',   schema: new OA\Schema(type: 'integer', default: 10)),
    ],
    responses: [new OA\Response(response: 200, description: 'Lista paginada de produtos')]
)]
#[OA\Post(
    path: '/api/products',
    summary: 'Cria um novo produto (requer autenticação básica)',
    security: [['basicAuth' => []]],
    requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
        required: ['name', 'price'],
        properties: [
            new OA\Property(property: 'name',        type: 'string',  example: 'Corrente Prata 925'),
            new OA\Property(property: 'description', type: 'string',  example: 'Corrente estilo cubana'),
            new OA\Property(property: 'price',       type: 'number',  example: 349.90),
            new OA\Property(property: 'stock',       type: 'integer', example: 10),
            new OA\Property(property: 'category',    type: 'string',  example: 'correntes'),
            new OA\Property(property: 'color',       type: 'string',  example: 'Prata'),
            new OA\Property(property: 'size',        type: 'string',  example: '60cm'),
            new OA\Property(property: 'weight',      type: 'number',  example: 0.045),
            new OA\Property(property: 'image',       type: 'string',  example: 'https://exemplo.com/img.jpg'),
        ]
    )),
    tags: ['Produtos'],
    responses: [
        new OA\Response(response: 201, description: 'Produto criado'),
        new OA\Response(response: 401, description: 'Não autorizado'),
    ]
)]
#[OA\Delete(
    path: '/api/product/{id}',
    summary: 'Remove um produto (requer autenticação básica)',
    security: [['basicAuth' => []]],
    tags: ['Produtos'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))],
    responses: [
        new OA\Response(response: 200, description: 'Produto removido'),
        new OA\Response(response: 404, description: 'Produto não encontrado'),
    ]
)]

// ── CARRINHO ──────────────────────────────────────────────────────────────────
#[OA\Post(
    path: '/api/cart',
    summary: 'Calcula subtotal, frete, desconto e total do carrinho',
    requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
        required: ['items'],
        properties: [
            new OA\Property(property: 'items', type: 'array',
                items: new OA\Items(properties: [
                    new OA\Property(property: 'productId', type: 'integer', example: 1),
                    new OA\Property(property: 'qty',       type: 'integer', example: 2),
                ])
            ),
            new OA\Property(property: 'cupomCode', type: 'string', example: 'URI10'),
        ]
    )),
    tags: ['Carrinho'],
    responses: [new OA\Response(response: 200, description: 'Resumo do carrinho',
        content: new OA\JsonContent(properties: [
            new OA\Property(property: 'subtotal', type: 'number', example: 699.80),
            new OA\Property(property: 'freight',  type: 'number', example: 0),
            new OA\Property(property: 'discount', type: 'number', example: 69.98),
            new OA\Property(property: 'total',    type: 'number', example: 629.82),
        ])
    )]
)]

// ── AUTENTICAÇÃO ──────────────────────────────────────────────────────────────
#[OA\Post(
    path: '/api/login',
    summary: 'Autentica um usuário e retorna seus dados',
    requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
        required: ['email', 'password'],
        properties: [
            new OA\Property(property: 'email',    type: 'string', example: 'usuario@email.com'),
            new OA\Property(property: 'password', type: 'string', example: '123456'),
        ]
    )),
    tags: ['Autenticação'],
    responses: [
        new OA\Response(response: 200, description: 'Login realizado com sucesso'),
        new OA\Response(response: 401, description: 'Credenciais inválidas'),
    ]
)]
#[OA\Post(
    path: '/api/register',
    summary: 'Cria uma nova conta de usuário',
    requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
        required: ['name', 'email', 'password'],
        properties: [
            new OA\Property(property: 'name',     type: 'string', example: 'João Silva'),
            new OA\Property(property: 'email',    type: 'string', example: 'joao@email.com'),
            new OA\Property(property: 'password', type: 'string', example: 'senha123'),
        ]
    )),
    tags: ['Autenticação'],
    responses: [
        new OA\Response(response: 201, description: 'Usuário criado'),
        new OA\Response(response: 422, description: 'Dados inválidos ou e-mail já cadastrado'),
    ]
)]

// ── PEDIDOS ───────────────────────────────────────────────────────────────────
#[OA\Post(
    path: '/api/orders',
    summary: 'Cria um pedido (usuário deve estar autenticado via sessão web)',
    requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(
        required: ['customer_name', 'customer_email', 'payment_method', 'subtotal', 'freight', 'discount', 'total', 'items'],
        properties: [
            new OA\Property(property: 'customer_name',  type: 'string', example: 'João Silva'),
            new OA\Property(property: 'customer_email', type: 'string', example: 'joao@email.com'),
            new OA\Property(property: 'customer_phone', type: 'string', example: '(11) 99999-9999'),
            new OA\Property(property: 'address',        type: 'string', example: 'Rua das Joias, 10, SP'),
            new OA\Property(property: 'payment_method', type: 'string', enum: ['cartao', 'pix', 'boleto']),
            new OA\Property(property: 'subtotal',       type: 'number', example: 349.90),
            new OA\Property(property: 'freight',        type: 'number', example: 0),
            new OA\Property(property: 'discount',       type: 'number', example: 0),
            new OA\Property(property: 'total',          type: 'number', example: 349.90),
            new OA\Property(property: 'items', type: 'array',
                items: new OA\Items(properties: [
                    new OA\Property(property: 'productId', type: 'integer', example: 1),
                    new OA\Property(property: 'qty',       type: 'integer', example: 1),
                ])
            ),
        ]
    )),
    tags: ['Pedidos'],
    responses: [
        new OA\Response(response: 201, description: 'Pedido criado com sucesso'),
        new OA\Response(response: 422, description: 'Dados inválidos'),
    ]
)]
class SwaggerController extends Controller {}
