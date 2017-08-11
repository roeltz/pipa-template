<?php

use Pipa\Dispatch\Dispatch;
use Pipa\Dispatch\Exception\RoutingException;
use Pipa\Event\EventSource;

EventSource::expect('Pipa\Dispatch\Dispatch', 'error', function(Dispatch $dispatch){
	if ($dispatch->exception instanceof RoutingException) {
		echo "Invalid command";
	} else {
		throw $dispatch->exception;
	}
});
