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



//-------------------------- Atualiza a tabela ------------------------------------
        function atualiza_tabela(nome, desc=0) {
          var pagina = "server/atualiza_tabela.php";
          var dados = {ordem: nome};
          if (desc == 1) {
            dados = {ordem: nome, desc: ''};
          }
          $.ajax({
            type: 'GET',
            dataType: 'html',
            url: pagina,
            beforeSend: function(){
              
            },
            data: dados,
            success: function (msg)
            {
              $("#tbody").html(msg);
            }
          });
        }
        $( document ).ready(function() {
          atualiza_tabela('id', 0);
        });

        //--------------------------------------- Apaga item da tabela/Banco de Dados
        function apaga_item(id, numero){
          if(confirm('Tem certeza que deseja apagar o item '+numero+'?')){
            var pagina = "server/apaga_item.php";
            $.ajax({
              type: 'POST',
              dataType: 'json',
              url: pagina,
              beforeSend: function(){
                $('#alerta').fadeIn('slow');
                $('#alerta').html('apagando...');
              },
              data: {id: id},
              success: function (msg)
              {
                $('#alerta').html(msg.resposta);
                $('#alerta').fadeIn('slow');
                $('#alerta').fadeOut(4500);
                atualiza_tabela('id', 0);
              }
            });
          } 
        }
        // - se acao for 0 preenche os campos do modal de edição, se for 1 salva as alterações -
        function edita_item(acao = 0, id, numero){
          if (acao == 0) {
            $.ajax({
              type: 'GET',
              dataType: 'json',
              url: 'server/item_info.php',
              beforeSend: function(){},
              data: {id: id},
              success: function (msg)
              {
                $('#edita_item_title').html('Editando item '+numero+': '+msg.nome);
                $('#edita_item_id').val(msg.id);
                $('#edita_item_nome').val(msg.nome);
                $('#edita_item_descricao').val(msg.descricao);
                $('#edita_item_preco').val(msg.preco);
                $('#edita_item_categoria').val(msg.categoria);
              }
            });
          }if (acao == 1){
            var id = $('#edita_item_id').val();
            var nome = $('#edita_item_nome').val();
            var descricao = $('#edita_item_descricao').val();
            var preco = $('#edita_item_preco').val();
            var categoria = $('#edita_item_categoria').val();

            $.ajax({
              type: 'POST',
              dataType: 'json',
              url: 'server/edita_item.php',
              beforeSend: function(){},
              data: {id: id, nome: nome, descricao: descricao, preco: preco, categoria: categoria},
              success: function(msg)
              {
                if(msg.erro == true){
                  $('#alerta-erro').html(msg.resposta);
                  $('#alerta-erro').fadeIn('slow');
                  $('#alerta-erro').fadeOut(4500);
                }else{
                  $('#alerta').html(msg.resposta);
                  $('#alerta').fadeIn('slow');
                  $('#alerta').fadeOut(4500);
                  atualiza_tabela('id', 0);
                }
              }
            });
          }
        }