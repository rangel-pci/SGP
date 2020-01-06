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
	/* Parte responsavel por apagar o item na tabela/BD */
	
	if (isset($_POST['id'])) {
		header('Content-Type: application/json');
		session_start();

		//verifica antes se o usuário está autenticado como admin
		if (!($_SESSION['autenticado']==1 && $_SESSION['admin']==1)) {
			$resposta = ['resposta'=>'Acesso negado!'];
			echo json_encode($resposta);
			exit();
		}
		/* se conecta ao banco de dados*/
		require_once('conectaDB.php');

		$ps = $pdo->prepare("SELECT img FROM itens WHERE id = ?");
		$ps->execute([$_POST['id']]);
		$img = '../imgs/'.$ps->fetch()['img'];

		$ps = $pdo->prepare("DELETE FROM itens WHERE id = ?");
		$ps->execute([$_POST['id']]);

		$n = $ps->rowCount();
		if($n > 0){
			unlink($img);
			$resposta = ['resposta'=>'Item apagado com sucesso!'];
			echo json_encode($resposta);
		}else{
			$resposta = ['resposta'=>'Erro ao tentar apagar o item de id '.$_POST['id'].'!'];
			echo json_encode($resposta);
		}
	}else{
		echo "<meta http-equiv='refresh' content=1;url='http://localhost/projeto_completo/index.php?page=login'>";
	}
?>