<?php

use Pipa\Data\ConnectionManager;
use Pipa\Data\Restrictions;
use Pipa\Config\Config;
use Pipa\Registry\Registry;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// It's better to write just "R" instead of "Pipa\Data\Restrictions"
Restrictions::createAlias();

Registry::setSingleton("dataLogger", function(){
	$config = Config::get("data.logger");
	$logger = new Logger("data", $config['level']);
	$logger->pushHandler(new StreamHandler($config['path']));
	return $logger;
});

ConnectionManager::set("default", function(){
	$config = Config::get("data.sources.default");
	$dataSource = new Pipa\Data\Source\MySQL\MySQLDataSource($config['db'], $config['host'], $config['user'], $config['password'], $config['options']);
	$dataSource->setLogger(Registry::dataLogger());
	return $dataSource;
});
