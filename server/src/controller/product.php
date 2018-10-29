<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Controller for product table
 */
class ProductController
{

	/**
	 * Construct
	 *
	 * @param [type] $app
	 */
	function __construct($app) {

		$this->app = $app;

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
			$result = Product::create($_POST['name'], $_POST['price'], $_POST['product_id']);#
			return $result;
		});
	}

	/**
	 * Register "all" route
	 */
	private function registerAll() {
		$this->app->get('/product/all', function (Request $request, Response $response) {

			$response = $response->withHeader('Content-type', 'application/json');

			$result = Product::getAll();

			if (isset($result['error'])) {
				$response = $response->withJson($result, 500);
			} else {
				$response = $response->withJson($result, 200);
			}

			return $response;
		});
	}

	/**
	 * Register "single" route
	 */
	private function registerSingle() {
		$this->app->get('/product/{id}', function (Request $request, Response $response, array $args) {

			$response = $response->withHeader('Content-type', 'application/json');

			$product = new Product($args['id']);
			$result = $product->getSelf();

			if (isset($result['error'])) {
				$response = $response->withJson($result, 500);
			} else {
				$response = $response->withJson($result, 200);
			}

			return $response;
		});
	}

	/**
	 * Register "delete" route
	 */
	private function registerDelete() {
		$this->app->delete('/product/{id}', function (Request $request, Response $response, array $args) {
			$response = $response->withHeader('Content-type', 'application/json');

			$product = new Product($args['id']);
			$result = $product->deleteSelf();

			if (isset($result['error'])) {
				$response = $response->withJson($result, 500);
			} else {
				$response = $response->withJson($result, 200);
			}

			return $response;
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

}


?>
