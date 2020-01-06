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
	if (isset($_GET['id'])) {
		session_start();
		//verifica antes se o usuário está autenticado como admin ou padrão
		if (!(($_SESSION['autenticado']==1 && $_SESSION['admin']==1)||($_SESSION['autenticado']==1 && $_SESSION['admin']==0))) {
			
			echo "Acesso negado!";
			exit();
		}

		header('Content-Type: application/json');

		require_once('conectaDB.php');

		$id = $_GET['id'];

		$ps = $pdo->prepare('SELECT * FROM itens WHERE id = ?');
		$ps->execute([$id]);

		$linha = $ps->fetch();

		$resposta = ['id'=>$linha['id'],'nome'=>$linha['nome'], 'descricao'=>$linha['descricao'], 'preco'=>$linha['preco'], 'categoria'=>$linha['categoria'], 'img'=>$linha['img']];
		echo json_encode($resposta);
	}
?>