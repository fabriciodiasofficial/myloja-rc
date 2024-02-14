<?php 	
require_once 'app/Core/Core.php';

require 'lib/Database/Connection.php';

require_once 'app/Controller/HomeController.php';
require_once 'app/Controller/ErroController.php';
require_once 'app/Controller/ProdController.php';
require_once 'app/Controller/SobreController.php';
require_once 'app/Controller/AdminController.php';

require_once 'app/Model/Produto.php';
require_once 'app/Model/Avaliacao.php';

require_once 'vendor/autoload.php';

$template = file_get_contents('app/Template/estrutura.html');

ob_start();
		$core = new Core;
		$core->start($_GET);

		$saida = ob_get_contents();
ob_end_clean();
//tpl abrev. template
$tplPronto = str_replace('{{area_dinamica}}', $saida, $template);

echo $tplPronto;
 ?>