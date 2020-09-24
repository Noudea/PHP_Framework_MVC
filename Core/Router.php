<?php

namespace Core;

class Router
{
	/**
	 * Array des routes
	 * @var array
	 */
	protected $routes;

	/**
	 * Paramètres des routes existantes
	 * @var array
	 */
	protected $params;
	// protected $params = ['controller' => null, 'action' => null];

	/**
	 * @param string $route url de la route a ajouter
	 * @param array $params Paramètres de la route, controller,action
	 * @return void
	 */

	/**
	 * Récupère les paramètres associés.
	 * @return array
	 */
	public function getParams()
	{
		return $this->params;
	}

	/**
	 * @return array
	 *  Return toute les routes de l'array $routes.
	 */
	public function getRoutes()
	{
		return $this->routes;
	}

	/**
	 * @param string $route l'URL de la route
	 * @param array $params paramètres de la route (controller,actions)
	 * @return void
	 *  Ajoute des routes a l'array des routes
	 */
	public function add($route, $params = [])
	{
		// Convert the route to a regular expression: escape forward slashes
		$route = preg_replace('/\//', '\\/', $route);

		// Convert variables e.g. {controller}
		$route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

		// Convert variables with custom regular expressions e.g. {id:\d+}
		$route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

		// Add start and end delimiters, and case insensitive flag
		$route = '/^' . $route . '$/i';

		$this->routes[$route] = $params;
	}

	/**
	 * @param string $url l'URL de la route
	 * @return boolean vrai si ca match, faux sinon
	 * Match ma route avec les routes de l'array route. Si un route existe, match les paramètres associés
	 */
	public function match($url)
	{
		foreach ($this->routes as $route => $params)
		{
			if (preg_match($route, $url, $matches))
			{
				foreach ($matches as $key => $match)
				{
					if (is_string($key))
					{
						$params[$key] = $match;
					}
				}

				$this->params = $params;
				return true;
			}
		}

		return false;
	}

	/**
	 * Dispatch les routes et lance l'action index dans les controlleurs
	 * @param string $url L'URL de la route
	 * @return void
	 */
	public function dispatch($url)
	{
		$url = $this->removeQueryStringVariables($url);
		
		if ($this->match($url))
		{
			$controller = $this->params['controller'];
			$controller = $this->convertToStudlyCaps($controller);
			$controller = $this->getNamespace() . $controller;

			if (class_exists($controller))
			{
				$controller_object = new $controller();

				if (!isset($this->params['action']))
				{
					$this->params['action'] = 'index';
					$action = $this->params['action'] = 'index';
				}else 
				{
					$action = $this->params['action'];
					$action = $this->convertToCamelCase($action);
				}
				if (is_callable([$controller_object, $action]))
				{
					$controller_object->$action();

				}
				else
				{
					View::render('Error/index.phtml', []);
				}
			}
			else
			{
				View::render('Error/index.phtml', []);
			}
		}
		else
		{
			View::render('Error/index.phtml', []);
		}
	}

	/**
	 * enleve les query string de l'url
	 */
	protected function removeQueryStringVariables($url)
	{
		if ($url != '') {
			$parts = explode('&', $url, 2);

			if (strpos($parts[0], '=') === false) {
				$url = $parts[0];
			} else {
				$url = '';
			}
		}

		return $url;
	}

	/**
	 * @param string $string la string a convertir 
	 * @return string la string convertie en StudlyCaps
	 */
	protected function convertToStudlyCaps($string)
	{
		return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
	}

	/**
	 * @param string $string la string a convertir
	 * @return string la string convertie en CamelCase
	 */
	protected function convertToCamelCase($string)
	{
		return lcfirst($this->convertToStudlyCaps($string));
	}

	/**
	 * return le nom du namespace
	 * @return string
	 */
	protected function getNameSpace()
	{
		$namespace = 'App\Controllers\\';

		if (array_key_exists('namespace', $this->params))
		{
			$namespace .= $this->params['namespace'] . '\\';
		}
		// var_dump($namespace);
		return $namespace;
	}

}
