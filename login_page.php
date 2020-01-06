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
      echo "<meta http-equiv='refresh' content=1;url='http://localhost/projeto_completo/index.php?page=admin'>";
      exit();
    }else{
      echo "<meta http-equiv='refresh' content=1;url='http://localhost/projeto_completo/index.php?page=sgp'>";
      exit();
    }
  }  
?>
  <!--  BODY  -->
  <body class="bg-dark">
    <img class="bg-image" src="imgs/background.jpg">

    <div class="login bg-success rounded text-center text-light">
      <div class="mt-2 mb-2"><strong>Log in</strong></div>
      <input id="login" class="rounded mb-2 p-2 text-dark" type="text" name="login" placeholder="Usuário">
      <br>
      <input id="password" class="rounded p-2 text-dark" type="password" name="senha" placeholder="Senha">
      <br>
      <button onclick="login()" type="submit" class="mt-2 rounded text-light bg-dark"><strong>Entrar</strong></button>
      <div class="mt-1 mb-1 text-warning"><strong><div id="login-resp"></div></strong></div>
    </div>

    <footer>
      <!-- Jquery -->
      <script src="javascript/jquery-3.4.1.min.js"></script>
      <!-- JavaScript Bootstrap -->
      <script src="bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
      <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
      <!-- JavaScript -->
      <script src="javascript/login_page.js"></script>
    </footer>
  </body>
</html>