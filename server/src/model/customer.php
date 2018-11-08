<?php

/**
 * Class for add, get and update product
 */
class Customer extends ModelParent
{
	/**
	 *
	 */

	function __construct() {
		$this->tableName = 'customer';
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
	 * Create new
	 *
	 * @param string $name Name
	 * @param string $customer_id Customer id
	 * @param string $phone Phone
	 * @param string $iban Iban
	 * @param string $address Address
	 * @param string $postal_code Postal code
	 * @param string $city City
	 *
	 * @return bool             	Returns true if successful
	 */
	public static function create($name, $customer_id, $phone, $iban, $address, $postal_code, $city) {
		$db = new Database();
		$db->prepare("INSERT INTO `product` (`id`, `customer_id`, `name`, `phone`, `iban`, `address`, `postal_code`, `city`) VALUES (null, :customer_id, :name, :phone, :iban, :address, :postal_code, :city)");
		$db->bind(':customer_id', $customer_id, PDO::PARAM_STR);
		$db->bind(':name', $name, PDO::PARAM_STR);
		$db->bind(':phone', $phone, PDO::PARAM_STR);
		$db->bind(':iban', $iban, PDO::PARAM_STR);
		$db->bind(':address', $address, PDO::PARAM_STR);
		$db->bind(':postal_code', $postal_code, PDO::PARAM_STR);
		$db->bind(':city', $city, PDO::PARAM_STR);
		return $db->exec();
	}

	/**
	 * Update self
	 *
	 * @return bool Return true is successful
	 */
	public function updateSelf() {
		parse_str(file_get_contents('php://input','r'), $data);

		$params = array();

		if (isset($data['customer_id'])) {
			$params['customer_id'] = "customer_id = :customer_id";
		}

		if (isset($data['name'])) {
			$params['name'] = "name = :name";
		}

		if (isset($data['phone'])) {
			$params['phone'] = "phone = :phone";
		}

		if (isset($data['iban'])) {
			$params['iban'] = "iban = :iban";
		}

		if (isset($data['address'])) {
			$params['address'] = "address = :address";
		}

		if (isset($data['postal_code'])) {
			$params['postal_code'] = "postal_code = :postal_code";
		}

		if (isset($data['city'])) {
			$params['city'] = "city = :city";
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
