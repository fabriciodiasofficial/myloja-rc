<?php 
//Não interfere
	class ProdController
	{
		public function index($params)
		{
			try{
				$produto = Produto::selecionaPorId($params);

				$loader = new \Twig\Loader\FilesystemLoader('app/View');
				$twig = new \Twig\Environment($loader);
				$template = $twig->load('single.html');

				$parametros = array();
				$parametros['id'] = $produto->id;
				$parametros['nome'] = $produto->nome;
				$parametros['preco'] = $produto->preco;
				$parametros['descricao'] = $produto->descricao;
				$parametros['avaliacoes'] = $produto->avaliacoes;

				$descricao = $template->render($parametros);
				echo $descricao;

			}catch(Exception $e){
				echo $e->getMessage();
			}
		}

		public function addAvaliacao()
		{
			try{
				Avaliacao::inserir($_POST);

				header('Location: http://localhost/estudo/myloja-rc/?pagina=prod&id='.$_POST['id']);
			}catch(Exception $e){
				echo'<script>alert("'.$e->getMessage().'");</script>';
				echo'<script>location.href="http://localhost/estudo/myloja-rc/?pagina=prod&id='.$_POST['id'].'"</script>';
			}
		}
	}
 ?>