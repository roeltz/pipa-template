<?php

use Pipa\Dispatch\Dispatch;
use Pipa\Dispatch\Security;
use Pipa\Event\EventSource;

EventSource::expect(Dispatch::class, "init", function(Dispatch $dispatch){
	// Let's make some roles
	Security::attach($dispatch)
		// We have an user
		->role("user")
		// We have an admin, who's also a user
		->role("admin", "user")
	;
});
