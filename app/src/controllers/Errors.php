<?php

use Pipa\Dispatch\Result;
use Pipa\Dispatch\Exception\RoutingException;

/*
 * This is the default controller for errors.
 *
 * You can (and should) modify it in any way you want, but remember that the
 * default console-error and http-error hooks (located in /app/src/hooks)
 * depend on the Errors::view method to work.
 *
 * One bad change or forgetful renaming, and you might get a recursive error.
 */
class Errors {

	function view(Exception $exception) {

		if ($exception instanceof RoutingException) {
			$statusCode = 404;
			$message = "Not Found";
		} else {
			$statusCode = 500;
			$message = $exception->getMessage();
		}

		return new Result(
			array(
				'error'=>true,
				'message'=>$message
			),
			array(
				'view'=>'error',
				'http-status-code'=>$statusCode,
				'exception'=>$exception
			)
		);
	}
}
