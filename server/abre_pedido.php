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
	if (isset($_POST)) {
		session_start();
		//verifica antes se o usuário está autenticado como user padrão
		if (!($_SESSION['autenticado']==1 && $_SESSION['admin']==0)) {
			echo "Acesso negado!";
			exit();
		}

		header('Content-Type: application/json');

		//Verifica se é um CPF válido
		if ($_POST['cpf'] != '') {
			if(preg_match('/[0-9]{3}[0-9]{3}[0-9]{3}[0-9]{2}/', $_POST['cpf']) && 
				strlen($_POST['cpf'])==11 && $_POST['total'] > 0)
			{
			}else{
				$resposta = ['erro'=>true, 'resposta'=>'CPF preenchido de forma inválida!'];
				echo json_encode($resposta);
				exit();
			}
		}

		$cpf = $_POST['cpf'];
		$itens = $_POST['itens'];
		$total = $_POST['total'];

		require_once('conectaDB.php');

		$ps = $pdo->prepare('INSERT INTO pedido (cpf, itens, total) VALUES (?, ?, ?)');
		$ps->execute([$cpf, $itens, $total]);

		$n = $ps->rowCount();

		if ($n > 0) {
			$resposta = ['resposta'=>'Pedido salvo em aberto!'];
			echo json_encode($resposta);
		}else{
			$resposta = ['erro'=>true, 'resposta'=>'O pedido não pôde ser salvo, tente mais tarde!'];
			echo json_encode($resposta);
			exit();
		}
	}
?>