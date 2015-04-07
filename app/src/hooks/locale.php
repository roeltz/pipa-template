<?php

use Pipa\Dispatch\Dispatch;
use Pipa\Dispatch\Localization;
use Pipa\Event\EventSource;
use Pipa\Locale\MoResource;
use Pipa\HTTP\Locale\HeaderLocaleExtractor;
use Pipa\HTTP\Locale\URILocaleExtractor;

EventSource::expect('Pipa\Dispatch\Dispatch', 'init', function(Dispatch $dispatch){
	Localization::attach($dispatch)
		// Set accepted locale codes
		->accept("es")
		// Extract locale from Accept-Language header
		->extractor(new HeaderLocaleExtractor())
		// Extract locale from subdomain (or path, if MODE_PATH is provided)
		->extractor(new URILocaleExtractor(URILocaleExtractor::MODE_SUBDOMAIN))
	;
});
