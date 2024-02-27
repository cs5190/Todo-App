<?php 

Trait Database {
	public function runQuery($query, $parameters = []) {
		try {
			$databaseConnection = $this->connect();
			$statement = $databaseConnection->prepare($query);
	
			$executionSucceeded = $statement->execute($parameters);
		
			if (!$executionSucceeded) {
				return false;
			}
		
			$queryResults = $statement->fetchAll(PDO::FETCH_OBJ);
		
			if (is_array($queryResults) && count($queryResults) > 0) {
				
				return $queryResults;
			}
		
			return false;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}

	public function runInsert($query, $parameters = []) {
		try {
			$databaseConnection = $this->connect();
			$statement = $databaseConnection->prepare($query);
	
			$executionSucceeded = $statement->execute($parameters);
		
			if (!$executionSucceeded) {
				return false;
			}
		
			return true;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}

	private function connect() {
		return new PDO($this->generateDSN(), DBUSER, DBPASS);
	}

	private function generateDSN() {
		return DBDRIVER . ':host=' . DBHOST . ';port=' . DBPORT . ";dbname=" . DBNAME;
	}
}
