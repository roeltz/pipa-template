<?php

use Pipa\Config\Config;
use Pipa\Dispatch\Context;

require_once __DIR__.'/vendor/autoload.php';

// Load app config, first dev, then fallback to production
Config::load(__DIR__.'/config/app-dev', __DIR__.'/config/app');

// Register default hookpath
Context::registerHookpath(__DIR__.'/src/hooks');

// Register default hooks
Context::hook("data");
