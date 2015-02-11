<?php
/**
 * Scrive.core.modules
 * 
 * Helper to include core CSS located within ['core_css'] . "/assets/" dir
 * Usage: {{ coreCSS("FILENAME") }}
 * @link http://docs.scrive.io/theming/helpers#core-css
 * 
 * @pakage scrive
 * @subpakage .core.modules/core_css_helper
 */

/**
 * @since Scrive.CORE-Alpha
 * Based on the simple_css_helper
 * 
 * @author Jason Alan Kennedy <https://bitbucket.org/jasonalankennedy>
 * @Link https://bitbucket.org/team-scrive/scrive
 * @license http://opensource.org/licenses/GPL-3.0
 * Copyright (c) 2014-2015 Scrive.IO, LLC
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