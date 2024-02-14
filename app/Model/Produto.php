<?php 
	class Produto
	{
		public static function selecionaTodos()
		{
			$con = Connection::getConn();

			$sql = "SELECT * FROM produto ORDER BY id DESC";
			$sql = $con->prepare($sql);
			$sql->execute();

			$resultado = array();

			while($row = $sql->fetchObject('Produto')){
				$resultado[] = $row;
			}

			if(!$resultado){
				throw new Exception("Não foi encontrado nenhum registro no banco");
			}
			return $resultado;
		}

		public static function selecionaPorId($idProd)
		{
			$con = Connection::getConn();

			$sql = "SELECT * FROM produto WHERE id = :id";
			$sql = $con->prepare($sql);
			$sql->bindValue(':id', $idProd, PDO::PARAM_INT);
			$sql->execute();

			$resultado = $sql->fetchObject('Produto');

			if(!$resultado){
				throw new Exception("Não foi encontrado nenhum registro no banco");
			}else{
				$resultado->avaliacoes = Avaliacao::selecionarAvaliacoes($resultado->id);
			}
			return $resultado;
		}

		public function insert($dadosProd)
		{
			if(empty($dadosProd['nome']) OR empty($dadosProd['preco']) OR empty($dadosProd['descricao'])){
				throw new Exception("Preencha todos os campos!");

				return false;
			}

			$con = Connection::getConn();

			// $sql = 'INSERT INTO (nome, descricao) VALUES (:nom, :des)';
			// $sql = $con->prepare($sql);  da pra fazer assim

			$sql = $con->prepare('INSERT INTO produto (nome, preco, descricao) VALUES (:nom, :pre, :des)');
			$sql->bindValue(':nom', $dadosProd['nome']);
			$sql->bindValue(':pre', $dadosProd['preco']);
			$sql->bindValue(':des', $dadosProd['descricao']);

			$res = $sql->execute();

			if($res == 0){
				throw new Exception("Falha ao inserir produto");

				return false;
			}

			return true;
		}

		public static function update($params)
		{
			$con = Connection::getConn();

			$sql = "UPDATE produto SET nome = :nom, preco = :pre, descricao = :des WHERE id = :id";
			$sql = $con->prepare($sql);
			$sql->bindValue(':nom', $params['nome']);
			$sql->bindValue(':pre', $params['preco']);
			$sql->bindValue(':des', $params['descricao']);
			$sql->bindValue(':id', $params['id']);
			$resultado = $sql->execute();

			if($resultado == 0){
				throw new Exception("Falha ao alterar publicação");

				return false;
			}

			return true;

		}

		public function delete($id)
		{
			$con = Connection::getConn();

			$sql = "DELETE FROM produto WHERE id = :id";
			$sql = $con->prepare($sql);
			$sql->bindValue(':id', $id);
			$resultado = $sql->execute();

			if($resultado == 0){
				throw new Exception("Falha ao deletar publicação");

				return false;
			}

			return true;
		}

	}
 ?>















