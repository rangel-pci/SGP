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
	if (isset($_GET['categoria'])) {
		session_start();

		//verifica antes se o usuário está autenticado como user padrão
		if (!($_SESSION['autenticado']==1 && $_SESSION['admin']==0)) {
			echo "Acesso negado!";
			exit();
		}

		$categoria = $_GET['categoria'];
		/* se conecta ao banco de dados*/
		require_once('conectaDB.php');
		
		/* lista os itens da tabela de acordo com a categoria */

		$ps = $pdo->prepare("SELECT * FROM itens WHERE categoria = ? ORDER BY nome");
		$ps->execute([$categoria]);

		if($ps->rowCount() == 0){
			echo "
				<td>
					<div>Sem resultados nessa categoria!</div>
				</td>
			";
			exit();
		}
		/* faz uma contagem para declarar <tr> e </tr> a cada 3 <td> */
		$i = 0;
		$j = 4;
		while ($linha = $ps->fetch()) {
			if ($i == 4) {
				echo "</tr>";
				$i = 0;
			}
			$i++;
			if ($j == 4) {
				echo "\n<tr>\n";
				$j = 0;
			}
			$j++;
			//Imprime os dados da tabela dentro de um botão com a função "soma()" em javaScript
			echo "
				<td>
					<button class='btn btn-item btn-light bg-light'"?>onclick="soma('<?=$linha['nome']?>', <?=$linha['preco']?>)"<?php echo">
						<img src='imgs/$linha[img]' width='100px' heigth='100px'>
						<hr>
						<div>$linha[nome]</div>
						<br>
						R$ ".number_format($linha['preco'], 2, ',', '.')."
					</button>
				</td>
			";
		}
	}

?>