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
	if (isset($_GET)) {
		session_start();
		//verifica antes se o usuário está autenticado como user padrão
		if (!($_SESSION['autenticado']==1 && $_SESSION['admin']==0)) {
			echo "Acesso negado!";
			exit();
		}
		
		require_once('conectaDB.php');

		if ($_GET['id'] == 0) {
			$ps = $pdo->prepare('SELECT * FROM pedido WHERE status = ?');
			$ps->execute(['aberto']);

			if ($ps->rowCount() == 0){
				echo "
				<td>
					<div>Sem pedidos em aberto!</div>
				</td>
				";
				exit();
			}

			echo "
				<tr><th>Código</th><th>Itens</th><th>Total</th><th>Data - Hora</th></tr>
			";

			while ($linha = $ps->fetch()) {

				$linha['itens'] = str_replace("\n", '<br>', $linha['itens']);
				$data = explode(' ', $linha['data']);
				$data[0] = explode('-', $data[0]);
				$linha['total'] = number_format($linha['total'], 2, ',', '.');

				echo "
					<tr class='bg-light'>
					<td>$linha[id]</td>
					<td>$linha[itens]</td>
					<td>R$ $linha[total]</td>
					<td>"
					.$data['0']['2']."/".$data['0']['1']."/".$data['0']['0'].
					"<br>$data[1]</td>
					<td>
					<button class='btn btn-success'"?> onclick="pedido_em_aberto('<?="$linha[id]"?>')"<?php echo ">Fechar</button>
					</td>
					</tr>
				";
			}
		}else{
			header('Content-Type: application/json');

			$ps = $pdo->prepare('UPDATE pedido SET status = ? WHERE id = ?');
			$ps->execute(['fechado', $_GET['id']]);

			$n = $ps->rowCount();
			if ($n > 0) {
				$resposta = ['resposta'=>'Pedido '.$_GET['id'].' fechado!'];
				echo json_encode($resposta);
			}else{
				$resposta = ['erro'=>true ,'resposta'=>'O Pedido não pôde ser fechado!'];
				echo json_encode($resposta);
			}
		}
		
	}
?>