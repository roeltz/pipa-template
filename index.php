<?php

require_once 'app/environment.php';

use Pipa\Dispatch\ExpressionRouter;
use Pipa\Dispatch\ViewSelector;
use Pipa\HTTP\HTTPContext;
use Pipa\HTTP\View\PHPView;
use Pipa\HTTP\View\PartialsFilter;

HTTPContext::hook("http-error", "json");

HTTPContext::get()->dispatch(
	new ExpressionRouter(array(
		'GET /'=>'Main::index'
	)),
	new ViewSelector(array(
		'accept json'=>'Pipa\HTTP\View\JSONView',
		'option view-engine json'=>'Pipa\HTTP\View\JSONView',
		'default'=>new PHPView(new PartialsFilter())
	))
);
