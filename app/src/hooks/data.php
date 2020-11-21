<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pipa\Config\Config;
use Pipa\Data\ConnectionManager;
use Pipa\Data\Restrictions;
use Pipa\Data\Source\MySQL\MySQLDataSource;
use Pipa\Registry\Registry;

// It's better to write just "R" instead of "Pipa\Data\Restrictions"
Restrictions::createAlias();

Registry::setSingleton("dataLogger", function(){
	$config = Config::get("data.logger");
	$logger = new Logger("data");
	$logger->pushHandler(new StreamHandler($config["path"], $config["level"]));
	return $logger;
});

ConnectionManager::set("default", function(){
	$config = Config::get("data.sources.default");
	$dataSource = new MySQLDataSource($config["db"], $config["host"], $config["user"], $config["password"], $config["options"]);
	$dataSource->setLogger(Registry::dataLogger());
	return $dataSource;
});
