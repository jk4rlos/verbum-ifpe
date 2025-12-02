# Verbum IFPE

Projeto desenvolvido em PHP utilizando o framework Laravel, tendo como propósito fornecer uma plataforma web de gerencialmento paroquial robusta e escalável para paróquias, projeto desenvolvido através do IFPE (Instituto Federal de Pernambuco).  
> **Uma aplicação web voltada para a gestão paroquial e a integração da comunicação religiosa com as redes sociais. A proposta visa modernizar os processos administrativos de paróquias, facilitar a divulgação de eventos e melhorar a interação com os fiéis por meio de ferramentas digitais. O sistema permitirá o controle de informações internas, como sacramentos, agenda, dízimos e avisos, além da publicação automatizada em plataformas como Instagram e Facebook. O trabalho também apresenta um referencial teórico sobre tecnologia da informação, comunicação digital, redes sociais e gestão eclesial, destacando a importância do uso consciente da tecnologia na missão pastoral da Igreja Católica.
**

## :books: Sumário

- [Visão Geral](#visão-geral)
- [Funcionalidades](#funcionalidades)
- [Tecnologias](#tecnologias)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Como rodar localmente](#como-rodar-localmente)

---

## Visão Geral

O **Verbum** é um sistema web desenvolvido para agentes de pastoral, secretários(as) paroquiais, coordenadores de comunidades, catequistas, ministros e demais lideranças responsáveis pela organização interna e pela divulgação de atividades religiosas. Além disso, a plataforma também atende aos fiéis da comunidade, que poderão acessar informações, acompanhar eventos, receber comunicados e se engajar nas ações da paróquia por meio da integração com as redes sociais.

---

## Funcionalidades

  - Cadastro e login de usuários
  - Gestão de conteúdos (Fotos, vídeos, avisos, podcast e etc.) 
  - Painel administrativo
  - Integração com plataformas como Youtube, Instagram, Spotify e etc.
  - Responsivo para dispositivos móveis

---

## Tecnologias

- **Backend:** PHP (Laravel) e Fillament (Painel admnistrativo)
- **Frontend:** Blade (Laravel), HTML5, CSS3, JavaScript
- **Gerenciamento de dependências:** Composer (PHP), NPM/Yarn
- **Build Frontend:** Vite
- **Testes:** PHPUnit
- **Banco de Dados:** MySQL
- **Outros:**  
  - Configuração de ambiente via `.env`

---

## Estrutura do Projeto

Principais diretórios e arquivos:

```
├── .github/            # Workflows de integração e automações
│   └── workflows/
├── app/                # Código-fonte da aplicação (MVC: Models, Views, Controllers)
├── bootstrap/          # Inicialização do framework
├── config/             # Arquivos de configuração
├── database/           # Migrations, seeds e factories
├── public/             # Root da web (index.php, assets públicos)
├── resources/          
│   └── views/          # Templates Blade
│   └── css/js          # Frontend
├── routes/             # Rotas da aplicação (web.php, api.php)
├── storage/            # Arquivos gerados (logs, cache, uploads)
├── tests/              # Testes automatizados (PHPUnit)
├── .env.example        # Exemplo de configuração de ambiente
├── composer.json       # Dependências PHP
├── package.json        # Dependências JS
├── vite.config.js      # Configuração do build frontend
└── artisan             # CLI Laravel
```

---

## Como rodar localmente

1. Clone o repositório:

   ```bash
   git clone https://github.com/jk4rlos/verbum-ifpe.git
   cd verbum-ifpe
   ```

2. Instale as dependências PHP e Node.js:

   ```bash
   composer install
   npm install
   ```

3. Copie o arquivo de configuração de ambiente e ajuste conforme necessário:

   ```bash
   cp .env.example .env
   ```

   > Configure as variáveis do banco, mail, etc. no arquivo `.env`.

4. Gere a chave da aplicação Laravel:

   ```bash
   php artisan key:generate
   ```

5. Rode as migrations para criar as tabelas no banco:

   ```bash
   php artisan migrate
   ```

6. Rode o servidor local:

   ```bash
   php artisan serve
   ```

   Acesse [http://localhost:8000](http://localhost:8000) em seu navegador.

7. Para compilar assets frontend:

   ```bash
   npm run dev
   ```

---

Execute todos os testes com:

```bash
php artisan test
# ou
./vendor/bin/phpunit
```
