<?php
/**
 * 
 * Exclude any futur post from pages listing
 * @link TODO Help Docs
 *
 * Original foundation by:
 * @author Sebastien Erard <http://z720.net/pico/scheduled-post>
 * @link https://github.com/z720/pico_scheduled_post/blob/master/Pico_Scheduled_Post.php
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

class Scheduled_Post {

	protected $now;

	public function get_pages(&$pages, &$current_page, &$prev_page, &$next_page) {
		$this->now = time();
		$pages = array_filter($pages, array($this, 'isPublished'));
	}

	protected function isPublished($page) {
		if(isset($page['date']) && (strtotime($page['date']) - $this->now) > 0) {
			return false;
		}
		return true;
	}
}