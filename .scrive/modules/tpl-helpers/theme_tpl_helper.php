<?php
/**
 * Scrive.core.modules
 * 
 * Dynamic content system for pico template that allows you to include
 * html /.md files specfically created for use in a theme.
 * @link http://docs.scrive.io/theming/templates
 *
 * @pakage scrive
 * @subpakage .core.modules/tpl-helpers/theme_tpl_helper
 * 
 * Original foundation by:
 * @author Shawn Sandy <shawnsandy04@gmail.com>
 * @link https://github.com/shawnsandy/pico_tpl
 * @license http://opensource.org/licenses/MIT
 */

/**
 * @since Scrive.CORE-Alpha
 * Modified class name and linkage to reflect scrive usage needs
 * 
 * @author Jason Alan Kennedy <https://bitbucket.org/jasonalankennedy>
 * @Link https://bitbucket.org/team-scrive/scrive
 * @license http://opensource.org/licenses/GPL-3.0
 * Copyright (c) 2014-2015 Scrive.IO, LLC
 */

class Theme_TPL_Helper {

	private $tpl_name,
			$theme = '',
			$tpl_array = array(
				'breadcrumbs',
				'content',
				'cover',
				'css',
				'footer',
				'head',
				'header',
				'loadMask',
				'sidebar'
	);

	public function before_load_content(&$file) {
		$this->tpl_name = basename($file, '.md');
	}

	public function config_loaded(&$settings) {

		if (isset($settings['tpl_array']))
			$this->tpl_array = $settings['tpl_array'];

		if (isset($settings['theme']))
			$this->theme = THEMES_DIR . $settings['theme'];

	}

	public function file_meta(&$meta) {

		$config = $meta;
		if (isset($config['slug'])):
			$this->tpl_name = strtolower($config['slug']);
		endif;
	}

	public function before_render(&$twig_vars, &$twig) {

		// theme/tpl/file
		$twig_vars['tpl'] = $this->get_tpl_part();

		// theme/tpl/views/file
		$views = $this->get_views();
		$twig_vars['views'] = $views;

		// theme/content/file
		$theme = $this->get_theme_content();
		$twig_vars['theme'] = $theme;
		//var_dump($twig_vars['theme']);
	}

	private function get_tpl_part() {

		foreach ($this->tpl_array as $value) {

			$pattern = array('/ /', '/_/');
			$name = preg_replace($pattern, '_', $value);
			$tpl[$name] = 'tpl/' . $value . '.html';
			$page_tpl = $this->theme . '/tpl/' . $this->tpl_name . '-' . $value . '.html';
			
			if (file_exists($page_tpl))
				$tpl[$name] = '/tpl/' . $this->tpl_name . '-' . $value . '.html';
		}
		return $tpl;
	}

	private function get_theme_content() {
		$content = $this->get_files($this->theme . '/content', '.md');
		$content_data = array();

		if (empty($content))
			return;

		foreach ($content as $key) {
			$file = $this->theme . '/content/' . $key . '.md';
			$pattern = array('/ /', '/-/');
			$title = preg_replace($pattern, '_', strtolower($key));
			$data = file_get_contents($file);
			$content_data[$title] = \Michelf\MarkdownExtra::defaultTransform($data);
		}
		return $content_data;
	}

	private function get_views() {

		$view_dir = $this->theme . '/tpl/views';
		$views = $this->get_files($view_dir);

		if (empty($views))
			return;
			
		$pattern = array('/ /', '/-/');
		
		foreach ($views as $key) {
			$name = preg_replace($pattern, '_', $key);
			$view[$name] = 'tpl/views/' . $key . '.html';
			
			if (file_exists($this->theme . '/tpl/' . $this->tpl_name . '-' . $key . '.html'))
				$view[$name] = 'tpl/views/' . $this->tpl_name . '-' . $key . '.html';
		}

		if (!isset($view))
			return array(0);

		return $view;
	}

	// scrive.php lib
	private function get_files($directory, $ext = '.html') {

		if (!is_dir($directory))
			return false;

		$array_items = array();

		if ($handle = opendir($directory)) {
			while (false !== ($file = readdir($handle))) {

				$file = $directory . "/" . $file;
				if (!$ext || strstr($file, $ext))
				$array_items[] = basename($file, $ext);
			}
			closedir($handle);
		}
		return $array_items;
	}
} ?>