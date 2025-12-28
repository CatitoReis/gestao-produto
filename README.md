# Sistema de Gestão de Produtos

Este projeto é uma solução robusta para o gerenciamento de produtos, desenvolvida como parte de um desafio técnico utilizando o framework **Laravel 11**, **Docker** e **Tailwind CSS**.

## Descrição do Projeto
A aplicação consiste em um painel administrativo completo onde usuários autenticados podem gerenciar seu inventário. O foco principal foi a aplicação de boas práticas de arquitetura (Service Layer), segurança e testes automatizados.

### Funcionalidades
- **CRUD Completo**: Cadastro, listagem, edição e exclusão de produtos.
- **Busca Inteligente**: Filtro por nome, descrição ou preço.
- **Autenticação**: Sistema seguro via Laravel Breeze.
- **API RESTful**: Endpoints JSON protegidos por tokens via Laravel Sanctum.
- **Validação Rigorosa**: Regras para preços positivos, estoque não negativo e nomes únicos (com exceção para o próprio registro na edição).

---

## Pré-requisitos e Ambiente

Para garantir que a aplicação rode corretamente, certifique-se de cumprir os seguintes requisitos:

1. **Docker Desktop**: Instalado e em execução.
2. **WSL2 (Windows Subsystem for Linux)**: Se você estiver no **Windows**, é **obrigatório** executar os comandos dentro de um terminal Linux (ex: Ubuntu). Rodar o Sail diretamente no PowerShell ou CMD pode causar erros de permissão e de execução.
rode o comando: wsl --install
3. **Composer**: Necessário para instalar as dependências iniciais e gerar a pasta `vendor`.

## Siga os passos abaixo para rodar o projeto em seu ambiente local utilizando Docker:

1. **Clonar o repositório:**
   git clone https://github.com/CatitoReis/gestao-produto.git

2. **confuguração variavies de ambiente:**
   - Certifique-se de que o arquivo .env existe (copie de .env.example se necessário)
   - Defina a chave de criptografia na variavel de ambiente APP_KEY=base64:sua-chave-aqui no .env
   -exemplo: laravel.test php artisan key:generate

2. **Subir os containers Docker:**
   docker-compose up -d **ou** ./vendor/bin/sail up -d

3. **Preparar o ambiente interno:**
   - ./vendor/bin/sail composer install
   - ./vendor/bin/sail npm install
   - ./vendor/bin/sail npm run build

4. **Executar migrações e Seeds:**
   ./vendor/bin/sail artisan migrate --seed

5. **Como Executar os Testes:**
   ./vendor/bin/sail artisan test

6. **Acesso:**
   http://localhost
