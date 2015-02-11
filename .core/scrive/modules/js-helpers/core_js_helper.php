<?php
/**
 * Scrive.core.modules
 * 
 * Helper to include core JS located within ['core_js'] . "/assets/" dir
 * Usage: {{ js("FILENAME") }}
 * @link http://docs.scrive.io/theming/helpers#core-js
 * 
 * @pakage scrive
 * @subpakage .core.modules/core_js_helper
 */

/**
 * @since Scrive.CORE-Alpha
 * Based on the simple_js_helper
 * 
 * @author Jason Alan Kennedy <https://bitbucket.org/jasonalankennedy>
 * @Link https://bitbucket.org/team-scrive/scrive
 * @license http://opensource.org/licenses/GPL-3.0
 * Copyright (c) 2014-2015 Scrive.IO, LLC
 */

class Core_Js_Helper {

	public function before_render(&$twig_vars, &$twig, &$template) {
		global $config;

		$js_core_url = $twig_vars['core_js'] . "/assets/";

		$function = new Twig_SimpleFunction('coreJS', function ($js_file) use ($twig_vars, $js_core_url) {
			$js_url = $js_core_url . $js_file;
			$html = '<script src="' . $js_url . '.js"></script>';
			return $html;
		}, array('is_safe' => array('html')));

		$twig->addFunction($function);
	}

}