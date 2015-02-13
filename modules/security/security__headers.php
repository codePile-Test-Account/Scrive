<?php
/**
 * 
 * For handling security headers
 * @link TODO Blog
 * @link TODO Help Docs
 *
 * Original foundation by:
 * @author Ben Plum <http://benplum.com>
 * @link https://github.com/benplum/Nano-Headers
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
 
class Security__Headers {   // double underscore to move up in hook queue!

	private $settings = array(
		"X-Frame-Options" => "SAMEORIGIN",
		"X-XSS-Protection" => "1; mode=block",
		"X-Permitted-Cross-Domain-Policies" => "master-only",
		"X-Content-Type-Options" => "nosniff",
		"Content-Security-Policy" => false, //
		"Strict-Transport-Security" => false, // max-age=15768000
		"Content-Type" => "text/html; charset=utf-8"
	);

	public function config_loaded(&$settings) {
		if (isset($settings["security_headers"])) {
			$s = $settings["security_headers"];

			foreach ($s as $key => $val) {
				$this->settings[$key]  = $val;
			}
		}
	}

	public function request_url(&$url) {
		header_remove("Server");
		header_remove("server");
		header_remove("X-Powered-By");

		$is_resource = (strpos($url, ".js") > -1 || strpos($url, ".css") > -1);

		if (!$is_resource) {
			foreach ($this->settings as $key => $val) {
				if ($val !== false) {
					if ($key === "Content-Security-Policy") {
						// so many policies...
						header("X-WebKit-CSP: " . $val);
						header("X-Content-Security-Policy: " . $val);
						header("Content-Security-Policy: " . $val);
					} else {
						header($key . ": " . $val);
					}
				}
			}
		}
	}
} ?>