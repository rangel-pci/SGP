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
	/* parte responsavel por alterar a senha */
	session_start();

	//verifica antes se o usuário está autenticado como admin
	if (isset($_POST['select']) && $_SESSION['autenticado']==1 && $_SESSION['admin']==1) {
		require_once('conectaDB.php');

		if($_POST['select'] == 'admin'){
			$salt = 'S#@$G%5P4!@';
			$senhaAtual = hash('md5', $salt.$_POST['senhaA']);
			$senhaNova = hash('md5', $salt.$_POST['senhaN']);

			$ps = $pdo->prepare("SELECT senha FROM usuario WHERE login = ?");
			$ps->execute([$_SESSION['usuario']]);

			/* se a senha estiver correta será alterada */
			if ($ps->fetch()['senha'] == $senhaAtual) {
				$ps = $pdo->prepare("UPDATE usuario SET senha = ? WHERE login = ?");
				$ps->execute([$senhaNova, $_SESSION['usuario']]);

				echo "<script type='text/javascript'>alert('Senha Alterada!');</script>";
				echo "<meta http-equiv='refresh' content=1;url='http://localhost/projeto_completo/index.php?page=admin'>";
			}else{
				echo "<script type='text/javascript'>alert('Senha Incorreta!');</script>";
				echo "<meta http-equiv='refresh' content=1;url='http://localhost/projeto_completo/index.php?page=admin'>";
			}
			
		}else if ($_POST['select'] == 'user') {
			
			$salt = 'S#@$G%5P4!@';
			$senhaAtual = hash('md5', $salt.$_POST['senhaA']);
			$senhaNova = hash('md5', $salt.$_POST['senhaN']);

			$ps = $pdo->prepare("SELECT senha FROM usuario WHERE login = ?");
			$ps->execute(['user']);

			/* se a senha estiver correta será alterada */
			if ($ps->fetch()['senha'] == $senhaAtual) {
				$ps = $pdo->prepare("UPDATE usuario SET senha = ? WHERE login = ?");
				$ps->execute([$senhaNova, 'user']);

				echo "<script type='text/javascript'>alert('Senha Alterada!');</script>";
				echo "<meta http-equiv='refresh' content=1;url='http://localhost/projeto_completo/index.php?page=admin'>";
			}else{
				echo "<script type='text/javascript'>alert('Senha Incorreta!');</script>";
				echo "<meta http-equiv='refresh' content=1;url='http://localhost/projeto_completo/index.php?page=admin'>";
			}
		}
	}else{
		echo "Acesso Negado!";
		echo "<meta http-equiv='refresh' content=1;url='http://localhost/projeto_completo/index.php?page=login'>";
	}
?>