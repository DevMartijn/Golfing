<?php

include("dbconfig.php");

class DataFunctions{
	public $result;

	function Insert($tableName,$insertArray){
		$query = "";
		$query .= "INSERT INTO `".$tableName."` VALUES (0,";

		for ($i = 0; $i < count($insertArray); $i++) {
			
				$query .= "?";
			
			if($i < count($insertArray) - 1){
				$query .= ",";
			}
		}
		$query .= ");";
   
   
		$instance = ConnectDb::getInstance();
		$PDOconnection = $instance->getConnection();
		$this->result = $PDOconnection->prepare($query);
    
		try{
			$this->result->execute($insertArray);
		} catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
	}
	
	function GetAll($tableName){
		$instance = ConnectDb::getInstance();
		$PDOconnection = $instance->getConnection();
		$this->result = $PDOconnection->prepare('SELECT * FROM `' . $tableName . '`');
		$this->result->execute();
		return $this->result;
	}
 
}



?>