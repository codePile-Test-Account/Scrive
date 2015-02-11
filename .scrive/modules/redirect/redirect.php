<?php
/**
 * Scrive.core.modules
 * 
 * Determines the index file within the content/blog folder: {{ is_blog_start }}
 * Determines if a page is a blog page (a file within the content/blog folder): {{ is_blog_page }}
 * 
 * Usage: include a header named "Redirect" in your markdown files to redirect users
 *  /*
 *	Title: Test Redirect to Homepage
 *	Redirect: /
 *  */
 /*
 * @link http://docs.scrive.io/about/redirects
 * 
 * @pakage scrive
 * @subpakage .core.modules/redirect
 *
 * Original foundation by:
 * @author neb
 * @link https://github.com/nebman/pico-redirect/blob/master/pico_redirect.php
 * @license http://opensource.org/licenses/MIT
 * Copyright (c) 2014 nebman
 */

/**
 * @since Scrive.CORE-Alpha
 * Modified class name to reflect scrive usage needs
 * 
 * @author Jason Alan Kennedy <https://bitbucket.org/jasonalankennedy>
 * @Link https://bitbucket.org/team-scrive/scrive
 * @license http://opensource.org/licenses/GPL-3.0
 * Copyright (c) 2014-2015 Scrive.IO, LLC
 */

class Redirect {

	public function before_read_file_meta(&$headers) {
		$headers['redirect'] = 'Redirect';
	}

	public function file_meta(&$meta) {
		if ($meta['redirect']) {
			header('Location: ' . $meta['redirect']);
		}
	}
}?>