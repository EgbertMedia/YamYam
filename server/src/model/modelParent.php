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
	public function getAll() {
		$db = new Database();
		$db->prepare("SELECT * FROM ".$this->getTableName());
		$db->exec();
		return $db->getAll();
	}

	/**
	 * [getSelf description]
	 *
	 * @param int $id Id of item to get
	 *
	 * @return array Return array with data
	 */
	public function getSelf($id) {
		$db = new Database();
		$db->prepare("SELECT * FROM ".$this->getTableName()." WHERE id = :id");
		$db->bind(':id', $id, PDO::PARAM_INT);
		$db->exec();
		return $db->getSingle();
	}

	/**
	 * [deleteSelf description]
	 *
	 * @param int $id Id of item to delete
	 *
	 * @return bool true if success
	 */
	public function deleteSelf($id) {
		$db = new Database();
		$db->prepare("DELETE FROM ".$this->getTableName()." WHERE id = :id LIMIT 1");
		$db->bind(':id', $id, PDO::PARAM_INT);
		return $db->exec();
	}
}

?>
