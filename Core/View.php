<?php

namespace Core;

class View
{
	/**
	 * @param string $view la vue a afficher.
	 * @param array $data data du controller a la vue.
	 * @return void
	 */
	public static function render($view, $data = [])
	{
		extract($data, EXTR_SKIP);
		$file = "../App/Views/base.phtml";

		if (is_readable($file))
		{
			require $file;
		}
		else
		{
			echo "$file not found";
		}
	}
}

