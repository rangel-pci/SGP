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
	/* parte responsavel por inserir os itens no Banco de Dados, e retornar o erro ou successo da ação */
	if (isset($_POST['select'])&&(preg_match('/[0-9]+/',$_POST['preco']))) {
		session_start();

		//verifica antes se o usuário está autenticado como admin
		if (!($_SESSION['autenticado']==1 && $_SESSION['admin']==1)) {
			echo "Acesso negado!";
			exit();
		}

		$categoria = $_POST['select'];
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$preco = $_POST['preco'];

		if ($descricao == ''){
			$descricao = '-';
		}

		/* verifica se o usuário inseriu um valor com virgula, espaço ou letra */
		if (preg_match('/,|\s+|[a-zA-Z]+/', $preco)) {
			echo "Erro: Não insira espaços, virgulas ou letras no preço.\n<br>\n O item não pôde ser salvo no Banco de Dados! \n<br>\n<a href='http://localhost/projeto_completo/index.php?page=admin'>Voltar</a>";
			exit();
		}else{
			//$preco = number_format($_POST['preco'], 2, ',', '.');
		}
		/* faz a verificação do arquivo img */
		if (isset($_FILES['arquivo'])) {
			$extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
			if (($extensao == 'jpg' || $extensao == 'png')&&(filesize($_FILES['arquivo']['tmp_name']) < 4194304)) {
				$arquivo_nome = md5(uniqid($_FILES['arquivo']['name'])).".".$extensao;
				$dir = "../imgs/";

				move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir.$arquivo_nome);
			}else{
				echo "Erro: Preencha os campos de forma correta!
				\n<br>
				*Apenas arquivos com extensão .jpg e .png com tamanho máximo de 4mb são suportados!\n<br>\n O item não pôde ser salvo no Banco de Dados!\n<br>\n <a href='http://localhost/projeto_completo/index.php?page=admin'>Voltar</a>";
				/* retorna um erro e para o script caso a imagem não atenda os requisitos */
				exit();
			}
		}

		/* se conecta ao banco de dados caso tudo tenha ocorrido bem*/
		require_once('conectaDB.php');

		$ps = $pdo->prepare("INSERT INTO itens (nome, preco, img, descricao, categoria) VALUES (?, ?, ?, ?, ?)");
		$ps->execute([$nome, $preco, $arquivo_nome, $descricao, $categoria]);

		$n = $ps->rowCount();
		/* retorna uma mensagem caso o item tenha sido salvo com sucsso ou não no BD */
		if ($n > 0) {
			echo "<div style='margin-left:auto;margin-right:auto;'><strong>Item adicionado!</strong></div>";
			echo "<meta http-equiv='refresh' content=1;url='http://localhost/projeto_completo/index.php?page=admin'>";
		}else{
			echo "Ocorreu um erro o item não pôde ser salvo no Banco de Dados!\n<br>\n <a href='http://localhost/projeto_completo/index.php?page=admin'>Voltar</a>";
		}
	}else{
		echo "Preencha os campos de forma correta!";
		echo "<meta http-equiv='refresh' content=1;url='http://localhost/projeto_completo/index.php?page=admin'>";
	}
?>