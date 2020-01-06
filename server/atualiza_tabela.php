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
	if (isset($_GET['ordem'])) {
		session_start();

		//verifica antes se o usuário está autenticado como admin
		if (!($_SESSION['autenticado']==1 && $_SESSION['admin']==1)) {
			echo "Acesso negado!";
			exit();
		}

		/* se conecta ao banco de dados*/
		require_once('conectaDB.php');
		
		/* lista os itens da tabela */

		if ($_GET['ordem'] == 'nome') {
			if (isset($_GET['desc'])) {
				$ps = $pdo->prepare("SELECT * FROM itens ORDER BY nome DESC");
				$ps->execute();
			}else{
				$ps = $pdo->prepare("SELECT * FROM itens ORDER BY nome");
				$ps->execute();
			}
		}elseif ($_GET['ordem'] == 'categoria') {
			if (isset($_GET['desc'])) {
				$ps = $pdo->prepare("SELECT * FROM itens ORDER BY categoria DESC");
				$ps->execute();
			}else{
				$ps = $pdo->prepare("SELECT * FROM itens ORDER BY categoria");
				$ps->execute();
			}
		}elseif ($_GET['ordem'] == 'preco') {
			if (isset($_GET['desc'])) {
				$ps = $pdo->prepare("SELECT * FROM itens ORDER BY preco DESC");
				$ps->execute();
			}else{
				$ps = $pdo->prepare("SELECT * FROM itens ORDER BY preco");
				$ps->execute();
			}
		}else{
			if (isset($_GET['desc'])) {
				$ps = $pdo->prepare("SELECT * FROM itens ORDER BY id DESC");
				$ps->execute();
			}else{
				$ps = $pdo->prepare("SELECT * FROM itens ORDER BY id");
				$ps->execute();
			}
		}

		$i = 0;
		while ($linha = $ps->fetch()) {
			if ($linha['categoria']=='porcoes') {
				$linha['categoria'] = 'porções';
			}
			$i++;
			//uma <tr> por vez, contendo a id, img, nome, categoria, descrição e preço formatado
			echo "
			<tr class='admin-tr'>
				<th scope='row'>
					$i
				</th>
				<td>
					<img src='imgs/$linha[img]' width='70px' height='70px'>
				</td>
				<td>
					$linha[nome]
				</td>
				<td>
					<strong>$linha[categoria]</strong>
				</td>
				<td>
					$linha[descricao]	
				</td>
				<td>
					R$ ".number_format($linha['preco'], 2, ',', '.')."
				</td>
				
				<td>
					<button class='btn btn-light edita_item' data-toggle='modal' data-target='#edita_item' onclick='edita_item(0, $linha[id], $i)' title='Editar item $i'><img src='icons/editar.svg' width='20px' height='20px'>
					</button>
					<button class='btn btn-light apaga_item' onclick='apaga_item($linha[id], $i)' title='Apagar item $i'><img src='icons/apagar.svg' width='20px' height='20px'>
					</button>
				</td>
			</tr>";
		}
	}

?>