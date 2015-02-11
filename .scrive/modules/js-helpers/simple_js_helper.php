<?php
/**
 * Scrive.core.modules
 * 
 * Helper to include custom JS locatd within the active [theme_url] . "/assets/js/" dir
 * Usage: {{ js("FILENAME") }}
 * @link http://docs.scrive.io/theming/helpers#js
 * 
 * @pakage scrive
 * @subpakage .core.modules/simple_js_helper
 * 
 * Original foundation by:
 * @author Christian Schmidt <http://superbilk.com>
 * @link https://github.com/superbilk/Pico-js-helper
 * @license http://opensource.org/licenses/MIT
 */

/**
 * @since Scrive.CORE-Alpha
 * Modified class name, and $twig_vars to reflect scrive usage needs
 * 
 * @author Jason Alan Kennedy <https://bitbucket.org/jasonalankennedy>
 * @Link https://bitbucket.org/team-scrive/scrive
 * @license http://opensource.org/licenses/GPL-3.0
 * Copyright (c) 2014-2015 Scrive.IO, LLC
 */

class Simple_Js_Helper {

	public function before_render(&$twig_vars, &$twig, &$template) {
		global $config;

		$js_base_url = $twig_vars['theme_url'] . "/assets/js/";

		$function = new Twig_SimpleFunction('js', function ($js_file) use ($twig_vars, $js_base_url) {
			$js_url = $js_base_url . $js_file;
			$html = '<script src="' . $js_url . '.js"></script>';
			return $html;
		}, array('is_safe' => array('html')));

		$twig->addFunction($function);
	}

}