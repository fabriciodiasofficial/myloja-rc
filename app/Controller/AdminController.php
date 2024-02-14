<?php
//não interfere
	class AdminController
	{
		public function index()
		{
			$loader = new \Twig\Loader\FilesystemLoader('app/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('admin.html');

			$objProdutos = Produto::selecionaTodos();

			$parametros = array();
			$parametros['produtos'] = $objProdutos;

			$descricao = $template->render($parametros);
			echo $descricao;
		}

		public function create()
		{
			$loader = new \Twig\Loader\FilesystemLoader('app/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('create.html');

			$parametros = array();

			$descricao = $template->render($parametros);
			echo $descricao;
		}

		public function insert()
		{
			try{
				Produto::insert($_POST);

				echo'<script>alert("Produto inserido com sucesso!");</script>';
				echo'<script>location.href="http://localhost/estudo/myloja-rc/?pagina=admin&metodo=index"</script>';

			}catch(Exception $e){
				echo'<script>alert("'.$e->getMessage().'");</script>';
				echo'<script>location.href="http://localhost/estudo/myloja-rc/?pagina=admin&metodo=create"</script>';
			}
		}

		public function change($paramId)
		{
			$loader = new \Twig\Loader\FilesystemLoader('app\View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('update.html');

			$prod = Produto::selecionaPorId($paramId);

			$parametros = array();
			$parametros['id'] = $prod->id;
			$parametros['nome'] = $prod->nome;
			$parametros['preco'] = $prod->preco;
			$parametros['descricao'] = $prod->descricao;

			$descricao = $template->render($parametros);
			echo $descricao;
		}

		public function update()
		{
			try{
				Produto::update($_POST);

				echo'<script>alert("Publicação alterada com sucesso!");</script>';
				echo'<script>location.href="http://localhost/estudo/myloja-rc/?pagina=admin&metodo=index"</script>';
			}catch(Exception $e){
				echo'<script>alert("'.$e->getMessage().'");</script>';
				echo'<script>location=href="http://localhost/estudo/myloja-rc/?pagina=admin&metodo=change&id='.$_POST['id'].'"</script>';
			}
		}

		public function delete($paramId)//Apenas para identificação $paramId
		{
			try{
				Produto::delete($paramId);

				echo'<script>alert("Publicação deletada com sucesso!");</script>';
				echo'<script>location.href="http://localhost/estudo/myloja-rc/?pagina=admin&metodo=index"</script>';
			}catch(Exception $e){
				echo'<script>alert("'.$e->getMessage().'");</sccript>';
				echo'<script>location.href="http://localhost/estudo/myloja-rc/?pagina=admin&metodo=index"</script>';
			}
		}

	}