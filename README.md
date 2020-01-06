# SGP - Sistema de Gerenciamento de Pedidos

![SGP - demostração](https://github.com/rangel-pci/SGP/raw/master/imgs/demo.png)

Projeto feito para avaliação de desempenho na matéria de Desenvolvimento Web.

## Propósito

O SGP serve para gerenciar pedidos de lanchonete, padaria, fast-food entre outros.

## Como Executar

Para executar basta baixar ou clonar o repositório com `$git clone https://github.com/rangel-pci/SGP.git`.

Em `/_ANOTAÇÔES_LOGIN_MODELO_SQL` está localizado o script sql para a criação do banco de dados, tipo de croptografia e salt usada nas senhas.

Caso esteja usando o Xampp como servidor web local, basta colocar o projeto dentro de `C:\xampp\htdocs\SGP`, e acessar no navegador em `http://localhost/SGP`.

## Instruções de Uso

O sistema possui uma página de login que leva a duas páginas diferentes:
1. Página de administração, onde é possivel;
	1. Adicionar itens (imagem, nome, descrição, preço e categoria).
	2. Remover itens.
	3. Editar itens.
	4. Alterar senhas de admin e usuário padrão.
2. Página de gerenciamento de pedidos (usuário padrão), onde é possivel.
	1. Adicionar itens ao pedido.
	2. Adicionar CPF ao pedido (opcional).
	3. Cancelar pedido.
	4. Abrir pedido (faz com que o pedido seja aberto e fique em espera até que seja fechado na opção "Pedidos em aberto").
	5. Visualizar e fechar os pedidos em aberto.

### Login Padrão e Admin

- __Padrão__
	- Login: user
	- Senha: user
- __Admin__
	- Login: admin
	- Senha: admin

__Podem ser alteradas direto no BD ou na página de admin__

## Tecnologias Usadas

* [HTML5](https://html.spec.whatwg.org/multipage/) - Estrutura.
* [Bootstrap 4](https://getbootstrap.com.br/docs/4.1/getting-started/introduction/) - Framework Front-end.
* [Javascript](https://developer.mozilla.org/pt-BR/docs/Aprender/JavaScript) - Lógica e eventos no Front-end.
* [JQuery.ajax()](https://api.jquery.com/jquery.ajax/) - Integração do front com o Back-end.
* [PHP](https://www.php.net/manual/pt_BR/index.php) - Lógica do Sistema no Back-end.
* [MySQL](https://dev.mysql.com/doc/) - Banco de Dados.

## Disponibilidade

Este projeto está licenciado sob a licença MIT, portanto, você pode lidar com ele sem restrição, incluindo sem limitação os direitos a usar, copiar, modificar, mesclar, publicar, distribuir, vender copias do software.

As condições impostas para tanto são apenas manter o aviso de copyright e uma copia da licença em todas as cópias do software.

## Licença MIT

Copyright (c) 2019 Rangel Pereira https://github.com/rangel-pci

 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in
 all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 THE SOFTWARE.
