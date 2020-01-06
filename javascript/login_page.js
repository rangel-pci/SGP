/*php
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
*/



/* chama a funçao de login ao apertar enter no campo de password */
        $('#password').on('keypress',function(e) {
          if(e.which == 13) {
              login();
          }
        });
        /* faz a requisição ajax para logar */
        function login(){
          var login = $('#login').val();
          var password = $('#password').val();
          
          var pagina = "server/login.php";
          $.ajax({
            type: 'POST',
            dataType: 'json',
            url: pagina,
            beforeSend: function(){
              $('#login-resp').html('logando...');
            },
            data: {login: login, senha: password},
            success: function (msg)
            {
              if ((msg.autenticado == 'sim')&&(msg.admin == 1)) {
                window.location.href = 'index.php?page=admin';
              }else if((msg.autenticado == 'sim')&&(msg.admin == '0')){
                window.location.href = 'index.php?page=sgp';
              }else{
                $('#login-resp').html('Login ou senha incorretos!');
                $('#login-resp').fadeIn('slow');
                $('#login-resp').fadeOut(3000);
              }
            }
          });
        }