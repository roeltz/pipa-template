<?php

use Pipa\Dispatch\Dispatch;
use Pipa\Dispatch\Localization;
use Pipa\Dispatch\Session;
use Pipa\Event\EventSource;
use Pipa\Locale\MoResource;
use Pipa\HTTP\Locale\HeaderLocaleExtractor;
use Pipa\HTTP\Locale\SessionLocaleExtractor;
use Pipa\HTTP\Locale\URILocaleExtractor;

EventSource::expect('Pipa\Dispatch\Dispatch', 'init', function(Dispatch $dispatch){
	Localization::attach($dispatch)
		// Set accepted locale codes
		->accept("en", "es", "fr")
		// Extract locale from user object in session
		->extractor(new SessionLocaleExtractor(function(Session $session){
			$user = $session->getPrincipal();
			//return $user->language;
		}))
		// Extract locale from Accept-Language header
		->extractor(new HeaderLocaleExtractor())
		// Extract locale from subdomain (or path, if MODE_PATH is provided)
		->extractor(new URILocaleExtractor(URILocaleExtractor::MODE_SUBDOMAIN))
		// Add gettext resource file
		->resource("app/src/lang/{locale}.mo")
	;
});
