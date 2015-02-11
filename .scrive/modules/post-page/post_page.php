<?php
/**
 * Scrive.core.modules
 * 
 * Determines the index file within the content/blog folder: {{ is_blog_start }}
 * Determines if a page is a blog page (a file within the content/blog folder): {{ is_blog_page }}
 * @link http://docs.scrive.io/post-page
 * 
 * @pakage scrive
 * @subpakage .core.modules/post_page
 *
 * Original foundation by:
 * @author mcbSolutions.at <dev@mcbsolutions.at>
 * @link https://github.com/mcbSolutions/Pico-Plugins/tree/master/mcb_Blog
 * @license http://opensource.org/licenses/MIT
 * Copyright (c) 2013 mcbSolutions.at
 */

/**
 * @since Scrive.CORE-Alpha
 * Modified class name and $twig_vars to reflect scrive usage needs
 * 
 * @author Jason Alan Kennedy <https://bitbucket.org/jasonalankennedy>
 * @Link https://bitbucket.org/team-scrive/scrive
 * @license http://opensource.org/licenses/GPL-3.0
 * Copyright (c) 2014-2015 Scrive.IO, LLC
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