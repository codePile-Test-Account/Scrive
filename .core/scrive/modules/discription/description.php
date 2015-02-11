<?php
/**
 * Scrive.core.modules
 * 
 * Adds discription mete for OpenGraph
 * @link http://docs.scrive.io/Opengraph
 * 
 * @pakage scrive
 * @subpakage .core.modules/discription
 */

/**
 * @since Scrive.CORE-Alpha
 * @author Jason Alan Kennedy <https://bitbucket.org/jasonalankennedy>
 * @Link https://bitbucket.org/team-scrive/scrive
 * @license http://opensource.org/licenses/GPL-3.0
 * Copyright (c) 2014-2015 Scrive.IO, LLC
 */

class Description {
	public function get_page_data(&$data, $page_meta) {
		$data['description'] = $page_meta['description'];
	}
} ?>