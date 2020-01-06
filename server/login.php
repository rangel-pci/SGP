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
	/* Parte responsavel pela autenticação */

	header('Content-Type: application/json');

	session_start();

	if (isset($_POST['login'])) {
		
		$login = $_POST['login'];
		$salt = 'S#@$G%5P4!@';
		$senha = hash('md5', $salt.$_POST['senha']);

		/* se conecta ao banco de dados */
		require_once('conectaDB.php');

		/* verifica se existe algum usuário com este login */
		$ps = $pdo->prepare("SELECT * FROM usuario WHERE login = ?");
		$ps->execute([$login]);

		/* se existir um usuário com esse login ele verifica a senha */
		if ($linha = $ps->fetch()) {

			/* caso a senha também esteja correta ele retorna um json informando que o 
			usuário tá autenticado, o tipo da conta (admin = 1 -> administrador ou admin = 0 -> conta padrão) e
			preenche as variáveis de sessão */
			if ($senha == $linha['senha']) {

				$_SESSION['usuario'] = $linha['login'];
				$_SESSION['autenticado'] = 1;
				$_SESSION['admin'] = $linha['admin'];

				$resposta = ['autenticado'=>'sim', 'admin'=>$linha['admin']];
				echo json_encode($resposta);
			}else{
				$resposta = ['autenticado'=>'nao', 'admin'=> 0];
				echo json_encode($resposta);
			}
		/* caso não exista usuário com o login informado */
		}else{

			$resposta = ['autenticado'=>'nao', 'admin'=> 0];
			echo json_encode($resposta);
		}
	}
?>