<?php
require_once('views/View');

class Router
{
	private $_ctrl;
	private $_view;

	public function routeReq()
	{
		try
		{
			spl_autoload_register(function($class){require_once('models/'.$class.'.php');});
			$url = '';
			if (isset($_GET['url']))
			{
				$url = explode('/', filter_var($_GET['url']), FILTER_SANITIZE_URL);
				$controller = ucfirst(strtolower($url[0]));
				$controllerClass = "Controller".$controller;
				$controllerFile = "controllers/".$controllerClass.".php";

				if (file_exists($controllerFile))
				{
					require_once($controllerFile);
					$this->_ctrl = new $controllerClass($url);
				}
				else
					throw new Exception('Page not found');
			}
			else
			{
				require_once('controllers/ControllerHomepage.php');
				$this->_ctrl = new ControllerHomepage($url);
			}
		}
		catch (Exception $e)
		{
			$error_Msg = $e->getMessage();
			$this->_view = new View('Error');
			$this->_view->generate(array('errorMsg' => $errorMsg));
		}
	}
}
?>

<!-- user will always be on index.php -->
<!-- splt_autoload_register load classes required -->
<!-- controller is included according to user action -->
<!-- we explode the url on /, then apply a filter to secure what happen -->
<!-- if the page requested by user in url exist we require the file of the correspondig class -->
<!-- if there is no url, we load the default page -->
<!-- if there is an exception we redirect to the default view -->