<?php 

class Sql extends PDO {

	private $conn;

	//Início função construtor
	public function __construct(){
		$this->conn = new PDO("mysql:host=localhost;dbname=test", "root", "");
	}
	//Fim função construtor

	//Inicio função setParams
	private function setParams($statment, $parameters = array()){
		foreach ($parameters as $key => $value) {		
			$this->setParam($statment, $key, $value);
		}
	}
	//Fim função setParams


	//Inicio função setParam
	private function setParam($statment, $key, $value){
		$statment->bindParam($key, $value);
	}
	//Fim função setParam


	//Inicio função query
	public function query($rawQuery, $params = array()){
		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);
		$stmt->execute();
		return $stmt;
	}
	//Fim função query.

	public function select($rawQuery, $params = array()):array{

		$stmt = $this->query($rawQuery, $params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}

 ?>