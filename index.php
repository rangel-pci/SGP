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

	if(isset($_GET['page'])){

		switch ($_GET['page']) {
			case 'login':
				$title = 'SGP - Login Page';
				require_once('header.php');
				require_once('login_page.php');
				break;
			case 'admin':
				$title = 'SGP - Admin Page';
				require_once('header.php');
				require_once('admin_page.php');
				break;
			case 'sgp':
				$title = 'SGP - Sistema de Gerenciamento de Pedidos';
				require_once('header.php');
				require_once('sgp_page.php');
				break;
			
			default:
				$title = 'SGP - Login Page';
				require_once('header.php');
				require_once('login_page.php');
				break;
		}

	}else{
		$title = 'SGP - Login Page';
		require_once('header.php');
		require_once('login_page.php');
	}
?>