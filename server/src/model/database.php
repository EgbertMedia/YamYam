<?php

/**
 *
 */
class Database {

	/**
	 * Connect to database
	 */
	function __construct() {

		$this->dbname = 'yamyam';
		$this->username = 'yamyam';
		$this->password = 'mazlm6BXQullOttd!';

		try {
			$this->dbh = new PDO('mysql:dbname='.$this->dbname.';host=localhost', $this->username, $this->password);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}

	}

	/**
	 * Function to prepare a SQL statement
	 *
	 * @param  string $query
	 *
	 * @return [type]        [description]
	 */
	public function prepare($query) {
		$this->stmt = $this->dbh->prepare($query);
	}

	/**
	 * Exec last prepared statement
	 *
	 * @return int Number of affected rows
	 */
	public function exec() {
		return $this->stmt->execute();
	}

	/**
	 * Get all rows from last SQL statement
	 *
	 * @return array Array of result of last statement
	 */
	public function getAll() {
		return $this->stmt->fetchAll();
	}

	/**
	 * Get single row as assoc array of result from last sql statement
	 *
	 * @return [type] [description]
	 */
	public function getSingle() {
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}
}


?>
