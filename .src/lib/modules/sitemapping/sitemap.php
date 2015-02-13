<?php
/**
 * 
 * Generates an xml sitemap
 * @link TODO Help Docs
 *
 * Original foundation by:
 * @author Dave Kinsella
 * @link https://github.com/Techn0tic/Pico_Sitemap
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

class Sitemap {

	private $is_sitemap;

	public function __construct() {
		$this->is_sitemap = false;
	}

	public function request_url(&$url) {
		if($url == 'sitemap.xml') $this->is_sitemap = true;
	}

	public function get_pages(&$pages, &$current_page, &$prev_page, &$next_page) {
		if($this->is_sitemap) {
			header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
			header('Content-Type: application/xml; charset=UTF-8');
			$xml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
			foreach( $pages as $page ){
				$xml .= '<url><loc>'.$page['url'].'</loc></url>';
			}	
			$xml .= '</urlset>';
			header('Content-Type: text/xml');
			die($xml);
		}
	}
} ?>