<?php
/**
 * Parent class of models
 */
abstract class ModelParent
{
	/**
	 *
	 */
	function __construct() {

	}

	/**
	* Get table name
	*/
	abstract protected function getTableName();

	/**
	 * Get all function
	 *
	 * @return array Return array of all products
	 */
	public static function getAll() {
		$db = new Database();
		$db->prepare("SELECT * FROM ".$this->getTableName());
		$db->exec();
		return $db->getAll();
	}

	/**
	 * [getSelf description]
	 *
	 * @return array Return array with
	 */
	public function getSelf() {
		$db = new Database();
		$db->prepare("SELECT * FROM ".$this->getTableName()." WHERE id = :id");
		$db->bind(':id', $this->id, PDO::PARAM_INT);
		$db->exec();
		return $db->getSingle();
	}

	/**
	 * [deleteSelf description]
	 *
	 * @return bool true if success
	 */
	public function deleteSelf() {
		$db = new Database();
		$db->prepare("DELETE FROM ".$this->getTableName()." WHERE id = :id LIMIT 1");
		$db->bind(':id', $this->id, PDO::PARAM_INT);
		return $db->exec();
	}
}

?>
