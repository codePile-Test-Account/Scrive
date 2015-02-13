<?php
/**
 * 
 * Adds discription mete for OpenGraph
 * @link TODO Helpdocs
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

class Description {
	public function get_page_data(&$data, $page_meta) {
		$data['description'] = $page_meta['description'];
	}
} ?>