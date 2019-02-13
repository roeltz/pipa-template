<?php

require_once "app/environment.php";

use Pipa\Dispatch\ExpressionRouter;
use Pipa\Dispatch\ViewSelector;
use Pipa\HTTP\HTTPContext;
use Pipa\HTTP\View\PHPView;
use Pipa\HTTP\View\PartialsFilter;

HTTPContext::hook("http-error", "security", "json");

HTTPContext::get()->dispatch(
	new ExpressionRouter([
		'GET	/'=>'Main::index'
	]),
	new ViewSelector([
		'accept json'=>'Pipa\HTTP\View\JSONView',
		'option view-engine json'=>'Pipa\HTTP\View\JSONView',
		'default'=>new PHPView(new PartialsFilter())
	])
);
