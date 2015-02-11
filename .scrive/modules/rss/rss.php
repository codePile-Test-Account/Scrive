<?php
/**
 * Scrive.core.modules
 * 
 * RSS Feed module
 * @link http://docs.scrive.io/about/rss-feeds
 *
 * @pakage scrive
 * @subpakage .core.modules/rss
 * 
 * Original foundation by:
 * @author Gilbert Pellegrom
 * @link http://pico.dev7studios.com
 * @license http://opensource.org/licenses/MIT
 * Copyright (c) 2013 Dev7studios
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

class Rss {

	private $is_feed;
	private $plugin_path;
	
	public function __construct() {
		$this->is_feed = false;
		$this->plugin_path = dirname(__FILE__);
	}
	
	public function request_url(&$url) {
		// Are we looking for /feed?
		if($url == 'feed') $this->is_feed = true;
	}
	
	public function get_pages(&$pages, &$current_page, &$prev_page, &$next_page) {
		// Limit feed to latest 10 posts
		if($this->is_feed) $pages = array_slice($pages, 0, 10);
	}
	
	public function before_render(&$twig_vars, &$twig) {
		if($this->is_feed){
			header($_SERVER['SERVER_PROTOCOL'].' 200 OK'); // Override 404 header
			header("Content-Type: application/rss+xml; charset=UTF-8");
			$loader = new Twig_Loader_Filesystem($this->plugin_path);
			$twig_rss = new Twig_Environment($loader, $twig_vars['config']['twig_config']);
			echo $twig_rss->render('rss.html', $twig_vars); // Render rss.html
			exit; // Don't continue to render template
		}
	}
} ?>