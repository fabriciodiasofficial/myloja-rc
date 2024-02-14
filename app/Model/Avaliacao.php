<?php 
	class Avaliacao
	{
		public static function selecionarAvaliacoes($idProd)
		{
			$con = Connection::getConn();

			$sql = "SELECT * FROM avaliacao WHERE id_produto = :id";
			$sql = $con->prepare($sql);
			$sql->bindValue(':id', $idProd, PDO::PARAM_INT);
			$sql->execute();

			$resultado = array();

			while($row = $sql->fetchObject('Avaliacao')){
				$resultado[] = $row;
			}

			return $resultado;
		}


		public static function inserir($reqProd)
		{
			$con = Connection::getConn();

			$sql = "INSERT INTO avaliacao (nome, nota, id_produto) VALUES (:nom, :nt, :idp)";
			$sql = $con->prepare($sql);
			$sql->bindValue(':nom', $reqProd['nome']);
			$sql->bindValue(':nt', $reqProd['nota']);
			$sql->bindValue(':idp', $reqProd['id']);
			$sql->execute();

			if($sql->rowCount()){
				return true;
			}

			throw new Exception("Falha na inserção");
		}


	}
 ?>








