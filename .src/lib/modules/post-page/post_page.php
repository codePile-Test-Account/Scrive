<?php
/**
 * 
 * Determines the index file within the content/blog folder: {{ is_blog_start }}
 * Determines if a page is a blog page (a file within the content/blog folder): {{ is_blog_page }}
 * @link TODO Help Docs
 *
 * Original foundation by:
 * @author mcbSolutions.at <dev@mcbsolutions.at>
 * @link https://github.com/mcbSolutions/Pico-Plugins/tree/master/mcb_Blog
 * @license http://opensource.org/licenses/MIT
 * Copyright (c) 2013 mcbSolutions.at
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

class Post_Page {

	private $is_blog_start;
	private $is_blog_page;
	private $data;

	private function checkBlog($url, &$isStart, &$isPage) {
		$isStart = stristr($url, "blog") !== false;
		$isPage  = $isStart & stristr($url, "/") !== false;
		$isStart = $isStart & !$isPage;
	}

	public function request_url(&$url) {
		$this->checkBlog($url, $this->is_blog_start, $this->is_blog_page);
	}

	public function get_page_data(&$data, $page_meta) {
		$this->checkBlog($data['url'], $data['is_blog_start'], $data['is_blog_page']);
	}

	public function before_render(&$twig_vars, &$twig) {
		$twig_vars['is_blog_start'] = $this->is_blog_start;
		$twig_vars['is_blog_page' ] = $this->is_blog_page;
	}
} ?>