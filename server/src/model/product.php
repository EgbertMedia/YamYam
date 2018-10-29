<?php

/**
 * Class for add, get and update product
 */
class Product
{
	/**
	 * @param int $id Id of product
	 */

	function __construct($id) {
		$this->id = $id;
	}

	/**
	 * [create description]
	 *
	 * @param  string $name			Name of new product
	 * @param  string $price		Price of new product
	 * @param  string $product_id
	 *
	 * @return bool             	Returns true if successful
	 */
	public static function create($name, $price, $product_id = '') {
		$db = new Database();
		$db->prepare("INSERT INTO `product` (`id`, `product_id`, `name`, `price`) VALUES (null, :product_id, :name, :price)");
		$db->bind(':product_id', $product_id, PDO::PARAM_STR);
		$db->bind(':name', $name, PDO::PARAM_STR);
		$db->bind(':price', $price, PDO::PARAM_STR);
		echo "string";
		return $db->exec();
	}

	/**
	 * [getAll description]
	 *
	 * @return array Return array of all products
	 */
	public static function getAll() {
		$db = new Database();
		$db->prepare("SELECT * FROM product");
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
		$db->prepare("SELECT * FROM product WHERE id = :id");
		$db->bind(':id', $this->id, PDO::PARAM_INT);
		$db->exec();
		return $db->getSingle();
	}

	/**
	 * [updateSelf description]
	 *
	 * @return [type] [description]
	 */
	public function updateSelf() {
		parse_str(file_get_contents('php://input','r'), $data);

		$params = array();

		if (isset($data['product_id'])) {
			$params['product_id'] = "product_id = :product_id";
		}

		if (isset($data['name'])) {
			$params['name'] = "name = :name";
		}

		if (isset($data['price'])) {
			$params['price'] = "price = :price";
		}

		$db = new Database();
		
		$db->prepare("UPDATE product SET ".implode(', ', $params)." WHERE id = :id LIMIT 1");

		$db->bind(':id', $this->id, PDO::PARAM_INT);

		foreach ($params as $key => $value) {
			$db->bind($key, $data[$key], PDO::PARAM_STR);
		}

		return $db->exec();
	}

	/**
	 * [deleteSelf description]
	 *
	 * @return [type] [description]
	 */
	public function deleteSelf() {
		$db = new Database();
		$db->prepare("DELETE FROM product WHERE id = :id LIMIT 1");
		$db->bind(':id', $this->id, PDO::PARAM_INT);
		return $db->exec();
	}
}


?>
