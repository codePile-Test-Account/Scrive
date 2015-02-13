<?php
/**
 * Helper to include custom CSS located within the active [theme_url] . "/assets/css/" dir
 * Usage: {{ css("FILENAME") }}
 * @link TODO Help docs
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

class Simple_CSS_Helper {

	public function before_render(&$twig_vars, &$twig, &$template) {
		global $config;

		$css_base_url = $twig_vars['theme_url'] . "/assets/css/";

		$function = new Twig_SimpleFunction('css', function ($css_file) use ($twig_vars, $css_base_url) {
			$css_url = $css_base_url . $css_file;
			$html = '<link rel="stylesheet" href="' . $css_url . '.css" type="text/css">';
			return $html;
		}, array('is_safe' => array('html')));

		$twig->addFunction($function);
	}

}