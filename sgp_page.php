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
    if (($_SESSION['autenticado'] == 1)&&($_SESSION['admin'] == 0)) {
      
    }elseif (($_SESSION['autenticado'] == 1)&&($_SESSION['admin'] == 1)){
      echo "<meta http-equiv='refresh' content=1;url='http://localhost/projeto_completo/index.php?page=admin'>";
      exit();
    }else{
      exit();
    }
  }else{
    echo "<meta http-equiv='refresh' content=1;url='http://localhost/projeto_completo/index.php?page=login'>";
    exit();
  }
?>
  
  <!--  BODY  -->
  <body class="bg-dark">
    <img class="bg-image" src="imgs/background.jpg">
    <!-- Painel admin -->
    <div class="menu-container rounded text-center text-dark">
      <!--  Menu  -->
      <div class="row">
        <div class="col-12 rounded bg-light">
          <div class="menu-categorias d-flex justify-content-end">
            <button class="btn btn-light btn-menu-sgp" onclick="atualiza_cardapio('lanches')"><strong>Lanches</strong></button>
            <button class="btn btn-light btn-menu-sgp" onclick="atualiza_cardapio('adicionais')"><strong>Adicionais</strong></button>
            <button class="btn btn-light btn-menu-sgp" onclick="atualiza_cardapio('porcoes')"><strong>Porções</strong></button>
            <button class="btn btn-light btn-menu-sgp" onclick="atualiza_cardapio('combos')"><strong>Combos</strong></button>
            <button class="btn btn-light btn-menu-sgp" onclick="atualiza_cardapio('bebidas')"><strong>Bebidas</strong></button>
            <button class="btn btn-secondary btn-menu-sgp" onclick="pedido_em_aberto('0')"><strong>Pedidos em aberto</strong></button>
            <!-- Data do sistema/servidor -->
            <div class="text-dark ml-5">
              <?="Sistema: ", date('d/m/Y')?>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">

          <!-- Calculadora -->
          <div class="col-3">
            <div class="calculadora" style="max-width: 100%;">
              <div class="text-dark"><strong>Pedidos</strong></div>
              <br>
              <textarea id="pedidos" disabled="" rows="10" cols="27" class="form-control text-dark font-weight-bold"></textarea>
              <!-- total -->
              <div class="pl-2 pt-1 text-left text-dark bg-light font-weight-bold">A receber: R$ <span id="total" class="text-danger"> 0</span></div>

              <div class="bg-light pt-1 pb-1">
                <hr style="background: black; height: 2px;">
                <div class="row">
                  <div class="col-12">
                    <input type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF - cliente">
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <button class="btn font-weight-bold" onclick="cancela()">
                      Cancelar
                      <br>
                      <img src="icons/apagar.svg" width="20px" height="20px">
                    </button>
                  </div>
                  <div class="col-6">
                    <button class="btn font-weight-bold" onclick="abre_pedido()">
                      Abrir Pedido
                      <br>
                      <img src="icons/finalizar.png" width="25px" height="25px">
                    </button>
                  </div>
                </div>
                <hr style="background: black; height: 2px;">
                <div class="row">
                  <!-- Botão sair -->
                  <div class="col-4 text-left mt-1 ml-1  ">
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
          </div>

          <!-- tabela -->
          <div class="col-9">
            <table class="table table-bordered table-secondary">
              <tbody id="tbody">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="alert alert-success text-center" id="alerta"></div>
    <div class="alert alert-danger text-center" id="alerta-erro"></div>
    <footer>
      <!-- Jquery -->
      <script src="javascript/jquery-3.4.1.min.js"></script>
      <!-- JavaScript Bootstrap -->
      <script src="bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
      <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
      <!-- JavaScript -->
      <script src="javascript/sgp_page.js"></script>
    </footer>
  </body>
</html>