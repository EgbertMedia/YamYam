<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Rest Controller parent class
 */
abstract class RestController
{

	/**
	 * Construct
	 */
	function __construct() {
		$this->tableName = $this->getTableName();
	}

	/**
	* Get table name
	*/
	abstract protected function getTableName();


	/**
	 * Register "delete" route
	 */
	protected function registerDelete() {
		$this->app->delete("/".$this->tableName."/{id}", function (Request $request, Response $response, array $args) {
			$tableName = explode('/', $request->getRequestTarget())[1];

			$response = $response->withHeader('Content-type', 'application/json');

			$ucstring = ucfirst($tableName);
			$item = new $ucstring($args['id']);
			$result = $item->deleteSelf();

			if (isset($result['error'])) {
				$response = $response->withJson($result, 500);
			} else {
				$response = $response->withJson($result, 200);
			}

			return $response;
		});
	}
}

?>
