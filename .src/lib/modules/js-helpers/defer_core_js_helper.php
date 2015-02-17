<?php
/**
 * 
 * Helper to defer JS core file loading
 * Usage: {{ deferJSCore("FILENAME") }}
 * @link TODO Help docs
 * @link TODO Blog
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

class Defer_Core_Js_Helper {

	public function before_render(&$twig_vars, &$twig, &$template) {
		global $config;

		$js_base_url = $twig_vars['core_js'] . "/assets/";

		$function = new Twig_SimpleFunction('deferCoreJS', function ($js_file) use ($twig_vars, $js_base_url) {
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