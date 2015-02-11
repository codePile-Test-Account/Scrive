<?php
/**
 * Scrive.core.modules
 * 
 * Helper to include custom CSS located within the active [theme_url] . "/assets/css/" dir
 * Usage: {{ css("FILENAME") }}
 * @link http://docs.scrive.io/theming/helpers#theme-css
 * 
 * @pakage scrive
 * @subpakage .core.modules/simple_css_helper
 */

/**
 * @since Scrive.CORE-Alpha
 * Modified class name, linkage and $twig_vars to reflect scrive usage needs
 * 
 * @author Jason Alan Kennedy <https://bitbucket.org/jasonalankennedy>
 * @Link https://bitbucket.org/team-scrive/scrive
 * @license http://opensource.org/licenses/GPL-3.0
 * Copyright (c) 2014-2015 Scrive.IO, LLC
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