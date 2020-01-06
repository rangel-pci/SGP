<?php
#Copyright (c) 2019 Rangel Pereira https://github.com/rangel-pci
#
 #Permission is hereby granted, free of charge, to any person obtaining a copy
 #of this software and associated documentation files (the "Software"), to deal
 #in the Software without restriction, including without limitation the rights
 #to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 #copies of the Software, and to permit persons to whom the Software is
 #furnished to do so, subject to the following conditions:
 #
 #The above copyright notice and this permission notice shall be included in
 #all copies or substantial portions of the Software.
 #
 #THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 #IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 #FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 #AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 #LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 #OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 #THE SOFTWARE.
?>



<?php
  session_start();
  /* Verifica se o usuário já está logado */
  if (isset($_SESSION['autenticado'])) {
    if (($_SESSION['autenticado'] == 1)&&($_SESSION['admin'] == 1)) {
      
    }elseif (($_SESSION['autenticado'] == 1)&&($_SESSION['admin'] == 0)){
      echo "<meta http-equiv='refresh' content=1;url='http://localhost/projeto_completo/index.php?page=sgp'>";
      exit();
    }else{
      exit();
    }
  }else{
    echo "<meta http-equiv='refresh' content=1;url='http://localhost/projeto_completo/index.php?page=login'>";
    exit();
  }
  //titulo da página
  $title = 'SGP - Admin Page';
?>
  
  <!--  BODY  -->
  <body class="bg-dark">

    <img class="bg-image" src="imgs/background.jpg">
    <!-- Painel admin -->
    <div class="menu-container rounded text-center text-dark">
      <div class="container-fluid">
        <div class="row">
          <!-- adicionar / apagar -->
          <div class="col-3">
            <div class="menu">            

              <!-- adicionar -->

              <form class="mt-1 text-dark" action="server/adiciona_item.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-12">
                    <!-- Data do sistema/servidor -->
                    <div class=" mb-1 text-center text-dark">
                      <?="Sistema: ", date('d/m/Y')?>
                    </div>
                    <hr style="background: black; height: 2px;">
                    <span class="text-dark"><strong>Adicionar Item</strong></span>
                    <input type="text" name="nome" placeholder="Nome" class="form-control mt-1 mb-1">
                    <textarea class="form-control mt-1 mb-1" name="descricao" placeholder="Descricao"></textarea>
                    <input type="text" name="preco" placeholder="Preço" class="form-control mt-1 mb-1" title="Insira o preço sem espaços ou virgula ex.(2.99, 99888.99, 55577780)">
                    <label class="text-dark" style="width: 100%;">Categoria:
                      <select id="sele" name="select" class="form-control mt-1 mb-1">
                        <option value="lanches">Lanches</option>
                        <option value="adicionais">Adicionais</option>
                        <option value="porcoes">Porções</option>
                        <option value="combos">Combos</option>
                        <option value="bebidas">Bebidas</option>
                      </select>
                    </label>
                    <br>
                    <label class="text-dark">Imagem:
                      <input type="hidden" name="MAX_FILE_SIZE" value="4194304" />
                      <input id="input-file" type="file" name="arquivo" class="form-control mt-1 mb-1">
                    </label>
                    <strong><div id="resposta"></div></strong>                  
                    <button type="submit" class="btn btn-light" id="btn-adicionar">
                      <img src="icons/enviar.svg" alt="img enviar item" width="20px" height="20px">
                      <br>
                      <strong>Enviar</strong>
                    </button>
                    <hr style="background: black; height: 2px;">
                  </div>
                </div>
              </form>
              <!-- Botão para acionar modal  trocar senha -->
              <button type="button" class="btn btn-light" data-toggle="modal" data-target="#trocarsenha">
                <img src="icons/senha.svg" width="20px" height="20px">
                <br>
                <strong>Alterar Senhas</strong>
              </button>
              <hr style="background: black; height: 2px;">
              <div class="row">
                  <!-- Botão sair -->
                  <div class="col-4 text-left mt-1 mb-1 ml-1  ">
                    <form action="server/logout.php" method="POST">
                      <input type="text" value="sair" name="sair" hidden="">
                      <button class="btn btn-light btn-sair">
                        <img src="icons/sair.svg" width="20px" height="20px" style="transform: rotate(180deg);">
                        <strong> Sair</strong>
                      </button>
                    </form>
                  </div>
                  
                </div>
            </div>
          </div>
          <!-- tabela -->
          <div class="col-9">
            <table class="table table-bordered table-light">
              <thead class="thead">
                <tr>
                  <!--<th scope="col">ID <a class="flexa" onclick="atualiza_tabela('id', 0)">&uarr;</a><a class="flexa" onclick="atualiza_tabela('id', 1)">&darr;</a></th>-->
                  <th scope="col">#</th>
                  <th scope="col">Imagem</th>
                  <th scope="col">Nome <a class="flexa" onclick="atualiza_tabela('nome', 0)">&#9652;</a> <a class="flexa" onclick="atualiza_tabela('nome', 1)">&#9662;</a></th>
                  <th scope="col">Categoria <a class="flexa" onclick="atualiza_tabela('categoria', 0)">&#9652;</a> <a class="flexa" onclick="atualiza_tabela('categoria', 1)">&#9662;</a></th>
                  <th scope="col">Descrição</th>
                  <th scope="col">Preço <a class="flexa" onclick="atualiza_tabela('preco', 0)">&#9652;</a> <a class="flexa" onclick="atualiza_tabela('preco', 1)">&#9662;</a></th>
                  <th scope="col">Opções</th>
                </tr>
              </thead>
              <tbody id="tbody">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <div class="alert alert-success text-center" id="alerta"></div>
    <div class="alert alert-danger text-center" id="alerta-erro"></div>
    </div>
    <!--  Modal com formulário para alterar senhas    -->
    <div class="modal fade" id="trocarsenha" tabindex="-1" role="dialog" aria-labelledby="trocarsenha" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="trocarsenha">Alterar Senhas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="server/trocasenha.php" method="POST" class="text-center">
              <p>Trocar senha de:</p>
              <select name="select" class="form-control mt-1 mb-1">
                <option value="admin">Administrador</option>
                <option value="user">Funcionário</option>                
              </select>
              <input type="password" name="senhaA" class="form-control mt-1 mb-1" placeholder="Senha Atual">
              <input type="password" name="senhaN" class="form-control mt-1 mb-1" placeholder="Nova senha">
              <button class="btn btn-primary" type="submit">Alterar</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!--  Modal com formulário para editar um item  -->
    <div class="modal fade" id="edita_item" tabindex="-1" role="dialog" aria-labelledby="edita_item" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="edita_item_title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="text" id="edita_item_id" hidden="" >
            <input type="text" id="edita_item_nome" name="nome" placeholder="Nome" class="form-control mt-1 mb-1">
            <textarea id="edita_item_descricao" class="form-control mt-1 mb-1" name="descricao" placeholder="Descricao"></textarea>
            <input type="text" id="edita_item_preco" name="preco" placeholder="Preço" class="form-control mt-1 mb-1" title="Insira o preço sem espaços ou virgula ex.(2.99, 99888.99, 55577780)">
            <label class="text-dark" style="width: 100%;">Categoria:
              <select id="edita_item_categoria" name="select" class="form-control mt-1 mb-1">
                <option value="lanches">Lanches</option>
                <option value="adicionais">Adicionais</option>
                <option value="porcoes">Porções</option>
                <option value="combos">Combos</option>
                <option value="bebidas">Bebidas</option>
              </select>
            </label>
            <button class="btn btn-primary text-center" data-dismiss="modal" onclick="edita_item(1, 0, 0)">Salvar</button>
          </div>
        </div>
      </div>
    </div>

    <footer>
      <!-- Jquery -->
      <script src="javascript/jquery-3.4.1.min.js"></script>
      <!-- JavaScript Bootstrap -->
      <script src="bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
      <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
      <!-- JavaScript -->
      <script src="javascript/admin_page.js"></script>
    </footer>
  </body>
</html>