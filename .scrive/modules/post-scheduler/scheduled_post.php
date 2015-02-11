<?php
/**
 * Scrive.core.modules
 * 
 * Exclude any futur post from pages listing
 * @link http://docs.scrive.io/about/schedule-posts
 * 
 * @pakage scrive
 * @subpakage .core.modules/scheduled_posts
 *
 * Original foundation by:
 * @author Sebastien Erard <http://z720.net/pico/scheduled-post>
 * @link https://github.com/z720/pico_scheduled_post/blob/master/Pico_Scheduled_Post.php
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