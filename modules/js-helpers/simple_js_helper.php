<?php
/**
 * 
 * Helper to include custom JS locatd within the active [theme_url] . "/assets/js/" dir
 * Usage: {{ js("FILENAME") }}
 * @link TODO Help Docs
 * 
 * Original foundation by:
 * @author Christian Schmidt <http://superbilk.com>
 * @link https://github.com/superbilk/Pico-js-helper
 * @license http://opensource.org/licenses/MIT
 * 
 */

 /**
 * @since Scrive-Framework v0.1.0
 * 
 * @author Jason Alan Kennedy <https://github.com/Celtic-Parser>
 * @Link https://github.com/codePile/Scrive-Framework
 * @license http://opensource.org/licenses/GPL-3.0
 * Copyright (c) 2015 codePin.PBC
 * 
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