<?php 
	class HomeController
	{
		public function index()
		{
			try{
				$colectProdutos = Produto::selecionaTodos();

				$loader = new \Twig\Loader\FilesystemLoader('app/View');
				$twig = new \Twig\Environment($loader);
				$template = $twig->load('home.html');

				$parametros = array();
				$parametros['produtos'] = $colectProdutos;

				$descricao = $template->render($parametros);
				echo $descricao;

			}catch(Exception $e){
				echo $e->getMessage();
			}
		}
	}
 ?>