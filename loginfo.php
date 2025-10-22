<?php

require __DIR__ . '/vendor/autoload.php';
//require_once '/path/to/log4php/Logger.php'; // Adjust the path to your log4php installation

// Configure log4php using the XML file
Logger::configure(dirname(__FILE__).'/log4php.xml');

// Get a logger instance
$logger = Logger::getLogger('default-logger'); // Or Logger::getLogger('root') for the root logger

// Log messages
$logger->trace("-----This is a trace message.");
$logger->debug("-----This is a debug message.");
$logger->info("-----This is an info message.");
$logger->warn("-----This is a warning message.");
$logger->error("-----This is an error message.");
$logger->fatal("-----This is a fatal message.");

?>

