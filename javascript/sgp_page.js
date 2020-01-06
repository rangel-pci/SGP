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



//-------------------------- Atualiza o cardápio ------------------------------------
        function atualiza_cardapio(categoria) {
          var pagina = "server/atualiza_cardapio.php";
          $.ajax({
            type: 'GET',
            dataType: 'html',
            url: pagina,
            beforeSend: function(){
            },
            data: {categoria: categoria},
            success: function (msg)
            {
              $("#tbody").html(msg);
            }
          });
        }
        //- Mostrar pedidos em aberto / Caso receba um 'id' ele fecha o pedido referente ao 'id' -
        function pedido_em_aberto(id){
          if(id == '0'){
            $.ajax({
              type: 'GET',
              dataType: 'html',
              url: 'server/pedido_em_aberto.php',
              beforeSend: function(){
              },
              data: {id: id},
              success: function (msg)
              {
                $("#tbody").html(msg);
              }
            });
          }else{
            $.ajax({
              type: 'GET',
              dataType: 'json',
              url: 'server/pedido_em_aberto.php',
              beforeSend: function(){
              },
              data: {id: id},
              success: function (msg)
              {
                if (msg.erro) {
                  $('#alerta-erro').html(msg.resposta);
                  $('#alerta-erro').fadeIn('slow');
                  $('#alerta-erro').fadeOut(4500);
                }else{
                  $('#alerta').html(msg.resposta);
                  $('#alerta').fadeIn('slow');
                  $('#alerta').fadeOut(4500);

                  pedido_em_aberto('0');
                }
              }
            });
          }
        }
        //--------------------------     Calcula o pedido     ----------------------------------
        var total = 0;
        function soma(nome, preco){
          total += preco;
          $('#pedidos').val($('#pedidos').val() +nome+' -> R$ '+preco+'\n');
          $('#total').html(total.toLocaleString('pt-br', {minimumFractionDigits: 2}));
        }
        //------------    Cancela o pedido ---------------
        function cancela(){
          $('#pedidos').val('');
          $('#total').html(0); 
          $('#cpf').val('');
          total = 0;
        }
        //------------  Abre o pedido ---------------
        function abre_pedido(){
          var itens = $('#pedidos').val();
          var cpf = $('#cpf').val();
          
          var pagina = "server/abre_pedido.php";
          $.ajax({
            type: 'POST',
            dataType: 'json',
            url: pagina,
            beforeSend: function(){
            },
            data: {cpf: cpf, itens: itens, total: total},
            success: function (msg)
            {
              if (msg.erro) {
                $('#alerta-erro').html(msg.resposta);
                $('#alerta-erro').fadeIn('slow');
                $('#alerta-erro').fadeOut(4500);
              }else{
                $('#alerta').html(msg.resposta);
                $('#alerta').fadeIn('slow');
                $('#alerta').fadeOut(4500);

                $('#pedidos').val('');
                $('#total').html(0); 
                $('#cpf').val('');
                total = 0;
              }              
            }
          });
        }