<?php
/**
 * Scrive.core.modules
 * 
 * Example hooks for creating modules
 * 
 * @pakage scrive
 * @subpakage .core.modules/scrive_module
 *
 * Original foundation by:
 * @author Gilbert Pellegrom
 * @link http://picocms.org
 * @license http://opensource.org/licenses/MIT
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

class Scrive_Module_XX {

	public function plugins_loaded() {

	}

	public function config_loaded(&$settings) {

	}

	public function request_url(&$url) {

	}

	public function before_load_content(&$file) {

	}

	public function after_load_content(&$file, &$content) {

	}

	public function before_404_load_content(&$file) {

	}

	public function after_404_load_content(&$file, &$content) {
		
	}
	
	public function before_read_file_meta(&$headers) {

	}

	public function file_meta(&$meta) {

	}

	public function before_parse_content(&$content) {

	}

	public function after_parse_content(&$content) {

	}

	public function get_page_data(&$data, $page_meta) {

	}

	public function get_pages(&$pages, &$current_page, &$prev_page, &$next_page) {

	}

	public function before_twig_register() {

	}

	public function before_render(&$twig_vars, &$twig, &$template) {

	}

	public function after_render(&$output) {

	}
} ?>
