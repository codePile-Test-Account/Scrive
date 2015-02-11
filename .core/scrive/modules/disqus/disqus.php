<?php
/**
 * Scrive.core.modules
 * 
 * Adds Disqus commenting to pages <https://disqus.com/>
 * @link http://docs.scrive.io/configuration#disqus
 * 
 * @pakage scrive
 * @subpakage .core.modules/discription
 *
 * Original foundation by:
 * @author Philipp Schmitt <philipp@schmitt.co> 
 * @license http://opensource.org/licenses/GPL-3.0
 * @link https://github.com/pschmitt/pico_disqus
 * @link http://pico.dev7studios.com/
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

class Disqus {
	public function config_loaded(&$settings) {
		if (isset($settings['disqus_id'])) {
			$this->disqus_id = $settings['disqus_id'];
		}
	}
	
	public function before_render(&$twig_vars, &$twig) {
		if (!empty($this->disqus_id)) {
			$twig_vars['disqus_comments'] = '
			<div id="disqus_thread"></div>
			<script type="text/javascript">
				var disqus_shortname = \''. $this->disqus_id .'\';

				(function() {
					var dsq = document.createElement(\'script\'); dsq.type = \'text/javascript\'; dsq.async = true;
					dsq.src = \'//\' + disqus_shortname + \'.disqus.com/embed.js\';
					(document.getElementsByTagName(\'head\')[0] || document.getElementsByTagName(\'body\')[0]).appendChild(dsq);
				})();
			</script>
			<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
			<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
			';
		}
	}
} ?>