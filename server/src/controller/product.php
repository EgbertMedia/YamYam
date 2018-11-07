<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Controller for product table
 */
class ProductController extends RestController
{
	/**
	 * Name of table in database
	 *
	 * @var string
	 */
	protected $tableName = 'product';

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
		$this->app->post('/product', function (Request $request, Response $response) {

			$response = $response->withHeader('Content-type', 'application/json');
			$result = Product::create($_POST['name'], $_POST['price'], $_POST['product_id']);
			return $result;
		});
	}

	/**
	 * Register "update" route
	 */
	private function registerUpdate() {
		$this->app->put('/product/{id}', function (Request $request, Response $response, array $args) {

			$response = $response->withHeader('Content-type', 'application/json');

			$product = new Product($args['id']);
			return $product->updateSelf();
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
