<?php
/**
 * Helper to include core CSS located within ['core_css'] . "/assets/" dir
 * 
 * Usage: {{ coreCSS("FILENAME") }}
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

class Core_CSS_Helper {

	public function before_render(&$twig_vars, &$twig, &$template) {
		global $config;

		$css_core_url = $twig_vars['core_css'] . "/assets/";

		$function = new Twig_SimpleFunction('coreCSS', function ($css_file) use ($twig_vars, $css_core_url) {
			$css_url = $css_core_url . $css_file;
			$html = '<link rel="stylesheet" href="' . $css_url . '.css" type="text/css">';
			return $html;
		}, array('is_safe' => array('html')));

		$twig->addFunction($function);
	}

}