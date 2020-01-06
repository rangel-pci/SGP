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
	if (isset($_POST['id']) && preg_match('/[0-9]+/',$_POST['preco'])) {

		/* verifica se o usuário inseriu um valor com virgula, espaço ou letra */
		if (preg_match('/,|\s+|[a-zA-Z]+/', $_POST['preco'])) {
			$resposta = ['erro'=>true, 'resposta'=>'Erro: Não insira espaços, virgulas ou letras no preço. O item não pôde ser salvo no Banco de Dados!'];
			echo json_encode($resposta);
			exit();
		}
		
		session_start();
		//verifica antes se o usuário está autenticado como admin
		if (!($_SESSION['autenticado']==1 && $_SESSION['admin']==1)) {
			echo json_encode(array('erro'=>true, 'resposta' =>'Acesso negado!'));
			exit();
		}


		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$preco = $_POST['preco'];
		$categoria = $_POST['categoria'];

		require_once('conectaDB.php');

		$ps = $pdo->prepare(
			'UPDATE itens SET nome = ?, descricao = ?, preco = ?, categoria = ? WHERE id = ?'
		);
		$ps->execute([$nome, $descricao, $preco, $categoria, $id]);

		$n = $ps->rowCount();
		if ($n > 0) {
			$resposta = ['resposta'=>'Item salvo!'];
			echo json_encode($resposta);
		}else{
			$resposta = ['erro'=>true, 'resposta'=>'Erro: O item não pôde ser salvo no Banco de Dados! Tente novamente mais tarde!'];
			echo json_encode($resposta);
		}
	}
?>