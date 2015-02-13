<?php
/**
 * 
 * Adds breadcrumbs for navigation and search engine detection
 * @link http://docs.scrive.io/breadcrumbs
 *
 * Original foundation by:
 * @author nebman
 * @link https://github.com/nebman/pico-breadcrumbs
 * Copyright (c) 2014 nebman
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
 
class Breadcrumbs {

	private $breadcrumbs = array();
	private $page_names = array();
	private $settings = array();

	public function config_loaded(&$settings) {
		$this->settings = $settings;
	}

	public function request_url(&$url) {
		$this->breadcrumbs = explode('/', $url);
	}

	public function before_read_file_meta(&$headers) {
		$headers['author_url'] = 'Author_URL';
	}

	public function get_pages(&$pages, &$current_page, &$prev_page, &$next_page) {
		foreach( $pages as $page ) {
			$this->page_names[$page['url']] = $page['title'];
		}
	}

	public function before_render(&$twig_vars, &$twig, &$template) {
		$breadcrumbs = array();
		$url = $this->settings['base_url'];

		foreach ($this->breadcrumbs as $crumb) {
			$url = $url . '/' . $crumb;
			$name = isset($this->page_names[$url]) ?  $this->page_names[$url] : (isset($this->page_names[$url.'/']) ? $this->page_names[$url.'/'] : $crumb);
			$breadcrumbs[] = array('url' => $url, 'name' => $name);
		}

		$twig_vars['breadcrumbs'] = $breadcrumbs;
	}
} ?>