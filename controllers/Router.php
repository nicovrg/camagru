<?php

class Router
{
	private $_ctrl;
	private $_view;

	public function routeReq()
	{
		try
		{
			spl_autoload_register(function($class){require_once('models/'.$class.'.php');});
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
				{
					throw new Exception('Page not found');
				}
			}
			else
			{
				require_once('controllers/ControllerAcceuil.php');
				$this->_ctrl = new $controllerAcceuil($url);
			}
		}
		catch (Exception $exception)
		{
			$error_Msg = $e->getMessage();
			require_once('views/viewError.php');
		}
	}
}
?>