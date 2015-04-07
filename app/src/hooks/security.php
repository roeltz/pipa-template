<?php

use Pipa\Dispatch\Dispatch;
use Pipa\Dispatch\Security;
use Pipa\Event\EventSource;

EventSource::expect('Pipa\Dispatch\Dispatch', 'init', function(Dispatch $dispatch){
	// Let's make some roles
	Security::attach($dispatch)
		// We have a client
		->role("client")
		// We have an user
		->role("user")
		// We have an admin, who's also a user
		->role("admin", "user");
});
