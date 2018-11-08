<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Controller for product table
 */
class CustomerController extends RestController
{
	/**
	 * Name of table in database
	 *
	 * @var string
	 */
	protected $tableName = 'customer';

	/**
	 * Construct
	 *
	 * @param [type] $app
	 */
	function __construct($app) {
		$this->app = $app;

		parent::__construct($this->tableName);

		$this->registerNew();

		$this->registerUpdate();

		$this->registerAll();

		$this->registerSingle();

		$this->registerDelete();
	}

	/**
	 * Register "new" route
	 */
	private function registerNew() {
		$this->app->post('/customer', function (Request $request, Response $response) {

			$response = $response->withHeader('Content-type', 'application/json');
			$result = Customer::create($_POST['name'], $_POST['customer_id'], $_POST['phone'], $_POST['iban'], $_POST['address'], $_POST['postal_code'], $_POST['city']);
			return $result;
		});
	}

	/**
	 * Register "update" route
	 */
	private function registerUpdate() {
		$this->app->put('/customer/{id}', function (Request $request, Response $response, array $args) {

			$response = $response->withHeader('Content-type', 'application/json');

			$product = new Customer();
			return $product->updateSelf($args['id']);
		});
	}

	/**
	 * Get name of table
	 *
	 * @return string Name of table in database
	 */
	protected function getTableName() {
		return $this->tableName;
	}
}


?>
