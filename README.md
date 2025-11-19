📋 To-Do List em PHP

Um sistema simples e funcional de lista de tarefas com cadastro, login, edição, exclusão, validação, design moderno e proteção por sessão.
Desenvolvido em PHP + MySQL, com interface estilizada em CSS e interações dinâmicas com JavaScript.

🚀 Funcionalidades

👤 Cadastro de usuários

🔐 Login com senha criptografada (password_hash)

🔒 Sessão protegida para impedir acesso sem login

➕ Adicionar tarefa

✏️ Editar tarefa

❌ Excluir tarefa

📌 Listar apenas tarefas do usuário logado

⚡ Feedback visual com JavaScript

🎨 Interface moderna com CSS (tema neon/dark)

🛠️ Tecnologias Utilizadas

PHP 7+

MySQL

HTML5

CSS3

JavaScript 

XAMPP

▶️ Como Rodar o Projeto

Instale XAMPP, WAMP ou LAMP

Coloque o projeto dentro da pasta htdocs

Inicie Apache + MySQL

Importe o banco de dados no phpMyAdmin

Acesse no navegador:

http://localhost/to%20do%20list/

🗄 Banco de Dados 
Crie o banco todo_db e execute:

CREATE DATABASE todo_db;
USE todo_db;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL
);

CREATE TABLE tarefas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  descricao VARCHAR(255) NOT NULL,
  status ENUM('pendente','concluída') DEFAULT 'pendente',
  id_usuario INT,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

🎨 Layout

O layout utiliza:

Gradiente animado com movimento contínuo no fundo

Fonte Noto Sans

Cards com vidro escuro (glass effect)

Sombras profundas e neon verde

Componentes com bordas arredondadas de alto contraste

Botões modernos com efeito hover de aumento

Ícone de voltar fixo com estilo neon

Layout totalmente responsivo, adaptado para telas pequenas

O estilo segue uma estética moderna, vibrante e futurista, misturando roxo, azul e laranja no fundo com verde neon para elementos interativos

🔑 Segurança

Uso de password_hash() e password_verify()

Verificação de sessão em todas páginas protegidas

Validação básica de formulário

📌 Melhorias Futuras

Marcar tarefa como concluída

Adicionar datas e horários às tarefas

Criar opção de prioridade (baixa / média / alta)

Versão em API

📄 Licença

Uso livre para estudo e modificação.
