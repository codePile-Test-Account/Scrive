<?php

/**
 * Scrive Configuration
 * 
 */
 
 /**
 * @since Scrive-Framework v0.1.0
 * 
 * @author Jason Alan Kennedy <https://github.com/Celtic-Parser>
 * @Link https://github.com/codePile/Scrive
 * @license http://opensource.org/licenses/GPL-3.0
 * Copyright (c) 2015 codePin.PBC
 * 
 */

   //////////////////////////////////////////////////////////////////////
  ///       --- YOU MAY OVERRIDE THE SETTINGS BELOW ---              ///
 ///  See: userdocs.scrive.io/wiki/display/SUD/Configuration+Setup  ///
//////////////////////////////////////////////////////////////////////

$config['site_title'] = '';	         // Site title
$config['base_url'] = '                // Override base URL (e.g. http://example.com)
$config['theme'] = 'celtic-parser'; 	// Set the theme (defaults to "default")
$config['date_format'] = 'jS M Y';		// Set the PHP date format
$config['pages_order_by'] = 'alpha';	// Order pages by "alpha" or "date"
$config['pages_order'] = 'desc';			// Order pages "asc" or "desc"
$config['excerpt_length'] = 50;			// The pages excerpt length (in # of words)
$config['locale'] = 'EN';					// Set the default local language

//	Exclude pages by it's title and/or folders by name from navigation header ----------------------->
$config['navigation']['hide_page'] = array(
	'a Title',
	'another Title'
);
$config['navigation']['hide_folder'] = array(
	'a folder',
	'another folder',
	'media'
);

//	Google Analytics -------------------------------------------------------------------------------->
$config['GAnalytics']['trackingID'] = '';	// The Google Analytics ID for your site "UA-5xxxxxxx-#"
$config['GAnalytics']['demoint'] = false;				// Demographics and Interest Reports: "true" or "false"
$config['GAnalytics']['linkatt'] = true;				//Enhanced link attribution: "true" or "false"

// Embed Disqus commenting on posts with {{ disqus_comments }} -------------------------------------->
$config['disqus_id'] = 'MYID';		// Add your Disqus ID

// The Leaflet map configurations ------------------------------------------------------------------->
$config['leaflet']['local'] = true;			// Must be set to true (default) if your site is served securly
$config['leaflet']['mapurl'] = 'events';	// Default is events
$config['leaflet']['geocoding'] = true;		// Enable the geocoding function
$config['leaflet']['maptemplate'] = '';		// Defaults to index
$config['leaflet']['maptitle'] = 'Events & Map';

//	Set security headers - Default setting should be enough ----------------------------------------->
//	More nfo at: https://securityheaders.com/
$config["security_headers"] = array(
	"X-Frame-Options" => "SAMEORIGIN",
	"X-XSS-Protection" => "1; mode=block",
	"X-Permitted-Cross-Domain-Policies" => "master-only",
	"X-Content-Type-Options" => "nosniff",
	"Content-Type" => "text/html; charset=utf-8",
	"Content-Security-Policy" => false,
	"Strict-Transport-Security" => false	// i.e. max-age=31536000; includeSubDomains
);

  ////////////////////////////////////////////////////////////////////////////////////////////////
 //	--- ADD ANY CUSTOM CONFIG SETTINGS HERE --- See: https://scrive.io/docs/custom-settings/  ///
////////////////////////////////////////////////////////////////////////////////////////////////

//$config['custom_setting'] = 'Hello'; 	// Can be accessed by {{ config.custom_setting }} in a theme

   ///////////////////////////////////////////////////////////////////////////////////////////////
  //// --- THESE ARE YOUR CACH SETTINGS --- You may want to tern then off durring develpment  ///
 ////  so you are not chasing your tail -- Also see: https://scrive.io/docs/cache-settings   ///
///////////////////////////////////////////////////////////////////////////////////////////////

// Cache Twig templates ------->
$config['twig_config'] = array(	// Twig settings
	// 'cache' => 'core/cache/twig/',	// Uncomment to enable Twig caching
	'autoescape' => false,				// Autoescape Twig vars
	'auto_reload' => true,				// Automatically recompile Twig templates whenever the source code changes
	'debug' => false					// Enable Twig debug
);

// Cache rendered HTML -------->
$config['cache_enabled'] = false; 	// Default is true- Why would you want anything else
$config['cache_dir'] = 'core/cache/html/';	// Uncomment to set the cache directory - ONLY IF YOU ARE NOT RUNNING ON GAE
$config['cache_time'] = '604800'; 	// 60*60*24*7, seven days (default)

?>