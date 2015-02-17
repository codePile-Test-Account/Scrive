<?php
/**
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
 * @link TODO Help Docs
 *
 * Original foundation by:
 * @author neb
 * @link https://github.com/nebman/pico-redirect/blob/master/pico_redirect.php
 * @license http://opensource.org/licenses/MIT
 * Copyright (c) 2014 nebman
 
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