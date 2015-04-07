<?php

use Pipa\Dispatch\Dispatch;
use Pipa\Dispatch\View;
use Pipa\Event\EventSource;
use Pipa\HTTP\View\JSONView;

EventSource::expect('Pipa\Dispatch\Dispatch', 'view-is-known', function(Dispatch $dispatch, View $view){
	if ($view instanceof JSONView) {
		Pipa\object_walk_recursive($dispatch->result->data, function(&$x){
			if ($x instanceof DateTime) {
				$x = $x->format("Y-m-d\TH:i:s\Z");
			}
		});
	}
});
