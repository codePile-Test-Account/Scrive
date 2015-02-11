<?php
/**
 * Scrive.core.modules
 * 
 * Adds navigation functionality
 * @link http://docs.scrive.io/configuration#navigation
 * @link http://docs.scrive.io/navigation
 * 
 * @pakage scrive
 * @subpakage .core.modules/navigation
 *
 * Original foundation by:
 * @author Ahmet Topal <http://ahmet-topal.com>
 * @link https://github.com/ahmet2106/pico-navigation
 * @license http://opensource.org/licenses/MIT
 */

/**
 * @since Scrive.CORE-Alpha
 * Modified class name, function name(s), linkage and conf settings to reflect scrive usage needs
 * @author Jason Alan Kennedy <https://bitbucket.org/jasonalankennedy>
 * @Link https://bitbucket.org/team-scrive/scrive
 * @license http://opensource.org/licenses/GPL-3.0
 * Copyright (c) 2014-2015 Scrive.IO, LLC
 */

class Navigation {	

	private $settings = array();
	private $navigation = array();

	public function before_read_file_meta(&$headers) {
		//$headers["order"] = "Order";
		$headers['status'] = 'Status';
		$headers['type'] = 'Type';
	}

	public function get_pages(&$pages, &$current_page, &$prev_page, &$next_page) {

		$navigation = array();

		foreach ($pages as $page) {
			if (!$this->at_exclude($page)) {
				$_split = explode('/', substr($page['url'], strlen($this->settings['base_url'])+1));
				$navigation = array_merge_recursive($navigation, $this->at_recursive($_split, $page, $current_page));
			}
		}

		array_multisort($navigation);
		$this->navigation = $navigation;
	}
	
	public function get_page_data(&$data, $page_meta) {
		$data['status'] = isset($page_meta['status']) ? $page_meta['status'] : '';
		$data['type'] = isset($page_meta['type']) ? $page_meta['type'] : '';
	}

	public function config_loaded(&$settings) {
		$this->settings = $settings;

		// default classes
		if (!isset($this->settings['navigation']['class'])) { $this->settings['navigation']['class'] = 'nav'; }
		if (!isset($this->settings['navigation']['class_li'])) { $this->settings['navigation']['class_li'] = 'li-item'; }
		if (!isset($this->settings['navigation']['class_a'])) { $this->settings['navigation']['class_a'] = 'a-item'; }

		// default excludes
		$this->settings['navigation'] = array_merge_recursive(
			array('single' => array(), 'folder' => array()),
			isset($this->settings['navigation']) ? $this->settings['navigation'] : array()
		);
	}

	public function before_render(&$twig_vars, &$twig) {
		$twig_vars['navigation']['menu'] = $this->build_navigation($this->navigation, true);
	}

	private function build_navigation($navigation = array(), $start = false) {
		$class = $start ? $this->settings['navigation']['class'] : '';
		$class_li = $this->settings['navigation']['class_li'];
		$class_a = $this->settings['navigation']['class_a'];
		$child = '';
		$ul = $start ? '<ul class="%s">%s</ul>' : '<ul>%s</ul>';

		if (isset($navigation['_child'])) {
			$_child = $navigation['_child'];
			array_multisort($_child);

			foreach ($_child as $c) {
				$child .= $this->build_navigation($c);
			}

			$child = $start ? sprintf($ul, $class, $child) : sprintf($ul, $child);
		}

		$li = isset($navigation['title'])
			? sprintf(
				'<li class="%1$s %5$s"><a href="%2$s" class="%1$s %6$s" title="%3$s">%3$s</a>%4$s</li>',
				$navigation['class'],
				$navigation['url'],
				$navigation['title'],
				$child,
				$class_li,
				$class_a
			)
			: $child;

		return $li;
	}

	private function at_exclude($page) {
		
		$exclude = $this->settings['navigation'];
		$url = substr($page['url'], strlen($this->settings['base_url'])+1);
		$url = (substr($url, -1) == '/') ? $url : $url.'/';

		foreach ($exclude['hide_page'] as $p) {

			$p = (substr($p, -1*strlen('index')) == 'index') ? substr($p, 0, -1*strlen('index')) : $p;
			$p = (substr($p, -1) == '/') ? $p : $p.'/';
			
			if ($url == $p) {
				return true;
			}
		}

		foreach ($exclude['hide_folder'] as $f) {

			$f = (substr($f, -1) == '/') ? $f : $f.'/';
			$is_index = ($f == '' || $f == '/') ? true : false;

			if (substr($url, 0, strlen($f)) == $f || $is_index) {
				return true;
			}
		}

		$pt = $page['type'];
		$ps = $page['status'];

		$home = ($pt == "home");
		$post = ($pt == "post");
		$event = ($pt == "event");
		$hide = ($pt == "hide");
		
		$draft = ($ps == "draft");
		$review = ($ps == "review");
		
		$type = $home || $post || $event || $hide;
		$status = $draft || $review;
	
		if ( $type || $status ) {
			return true;
		};

		return false;
	}

	private function at_recursive($split = array(), $page = array(), $current_page = array()) {
		$activeClass = (isset($this->settings['navigation']['activeClass'])) ? $this->settings['navigation']['activeClass'] : 'is-active';
		if (count($split) == 1) {			
			$is_index = ($split[0] == '') ? true : false;
			$ret = array(
				'title'			=> $page['title'],
				'url'			=> $page['url'],
				'class'			=> ($page['url'] == $current_page['url']) ? $activeClass : ''
			);

			$split0 = ($split[0] == '') ? '_index' : $split[0];
			return array('_child' => array($split0 => $ret));
			return $is_index ? $ret : array('_child' => array($split[0] => $ret));
		} else {
			if ($split[1] == '') {
				array_pop($split);
				return $this->at_recursive($split, $page, $current_page);
			}
			$first = array_shift($split);
			return array('_child' => array($first => $this->at_recursive($split, $page, $current_page)));
		}
	}
} ?>