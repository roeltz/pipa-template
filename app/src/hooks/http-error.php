<?php

use Pipa\Config\Config;
use Pipa\Dispatch\Dispatch;
use Pipa\Dispatch\Exception\SecurityException;
use Pipa\Event\EventSource;
use Pipa\Error\ErrorHandler;
use Pipa\Error\LoggerErrorDisplay;
use Pipa\Registry\Registry;
use Monolog\Logger;
use Monolog\Handler\ChromePHPHandler;

// Go install Chrome Logger
Registry::setSingleton("httpLogger", function(){
	$logger = new Logger("http");
	$logger->pushHandler(new ChromePHPHandler);
	ErrorHandler::addDisplay(new LoggerErrorDisplay($logger));
	return $logger;	
});

EventSource::expect('Pipa\Dispatch\Dispatch', 'error', function(Dispatch $dispatch){

	if (Config::get("http.logger"))
		Registry::httpLogger()->error(get_class($dispatch->exception).": ".$dispatch->exception->getMessage());
	
	if ($dispatch->exception instanceof SecurityException) {
		// If you want this to work, make sure you have the "security" hook enabled
		// and a real Main::login (or whatever) controller method
		$dispatch->sub("Main::login", array('exception'=>$dispatch->exception))->run();
	} else {
		$dispatch->sub("Errors::view", array('exception'=>$dispatch->exception))->run();
	}
});