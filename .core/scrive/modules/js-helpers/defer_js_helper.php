<?php
/**
 * Scrive.core.modules
 * 
 * Helper to defer JS loading located within ['theme_url'] . "/assets/js/" dir
 * Usage: {{ deferJS("FILENAME") }}
 * @link http://docs.scrive.io/theming/helpers#defer-js
 * @link http://docs.scrive.io/about/defering-js
 * 
 * @pakage scrive
 * @subpakage .core.modules/defer_js_helper
 */

/**
 * @since Scrive.CORE-Alpha
 * Based on Google's recommendation where needed <https://developers.google.com/speed/pagespeed/service/DeferJavaScript>
 * 
 * @author Jason Alan Kennedy <https://bitbucket.org/jasonalankennedy>
 * @Link https://bitbucket.org/team-scrive/scrive
 * @license http://opensource.org/licenses/GPL-3.0
 * Copyright (c) 2014-2015 Scrive.IO, LLC
 */

class Defer_Js_Helper {

	public function before_render(&$twig_vars, &$twig, &$template) {
		global $config;

		$js_base_url = $twig_vars['theme_url'] . "/assets/js/";

		$function = new Twig_SimpleFunction('deferJS', function ($js_file) use ($twig_vars, $js_base_url) {
			$js_url = $js_base_url . $js_file;
			$html = 	'<script type="text/javascript">
						function downloadJSAtOnload() {
							var element = document.createElement("script");
							element.src = "' . $js_url . '.js";
							document.body.appendChild(element);
						} if (window.addEventListener)
							window.addEventListener("load", downloadJSAtOnload, false);
							else if (window.attachEvent)
							window.attachEvent("onload", downloadJSAtOnload);
							else window.onload = downloadJSAtOnload;
						</script>';
			return $html;
		}, array('is_safe' => array('html')));

		$twig->addFunction($function);
	}

}