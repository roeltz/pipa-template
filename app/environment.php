<?php

use Pipa\Config\Config;
use Pipa\Dispatch\Context;

// Load app config, first dev, then fallback to production
Config::load(__DIR__."/config/app-dev.json", __DIR__."/config/app.json");

// Register default hookpath
Context::registerHookpath(__DIR__."/src/hooks");

// Register default hooks
Context::hook("data");
