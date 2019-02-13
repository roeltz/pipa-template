<?php

use Pipa\Dispatch\Dispatch;
use Pipa\Dispatch\View;
use Pipa\Event\EventSource;
use Pipa\HTTP\View\JSONView;

function prepareJSON(&$data) {
	\Pipa\object_remove_recursion($data);
	\Pipa\object_walk_recursive($data, function(&$x){
		if ($x instanceof DateTime) {
			$x = $x->format("Y-m-d\TH:i:s\Z");
		} elseif (is_string($x)) {
			$x = preg_replace('/\r/', '', $x);
		}
	});
	return $data;
}

EventSource::expect('Pipa\Dispatch\Dispatch', 'view-is-known', function(Dispatch $dispatch, View $view){
	if ($view instanceof JSONView) {
		prepareJSON($dispatch->result->data);
	}
});
