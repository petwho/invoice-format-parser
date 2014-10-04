<?php
include 'parser_factory.php';

// get file's name from command line
$file_name = $argv[1];

// read first line from text input
$file = fopen($file_name, 'r');
$first_line = fgets($file);

// create parser
strpos($first_line, ' ') ?	ParserFactory::createParser($file_name, 1)
	: ParserFactory::createParser($file_name, 2);

// close file pointer
fclose($file);

