<?php
/**
 * 
 * Helper to include core JS located within ['core_js'] . "/assets/" dir
 * Usage: {{ js("FILENAME") }}
 * @link TODO Help Docs
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