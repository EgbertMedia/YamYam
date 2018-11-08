<?php

/**
 * Class for add, get and update product
 */
class Product extends ModelParent
{
	/**
	 *
	 */

	function __construct() {
		$this->tableName = 'product';
	}

	/**
	 * Get name of table
	 *
	 * @return string Name of table in database
	 */
	protected function getTableName() {
		return $this->tableName;
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
		return $db->exec();
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
}


?>
