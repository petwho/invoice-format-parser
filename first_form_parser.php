<?php
require_once 'printer.php';

class FirstFormParser {
	private $fileName;

	public function __construct($fileName) {
		$this->fileName = $fileName;
	}

	public function parse() {
		$handle = fopen($this->fileName, 'r');
		while (($line = fgets($handle)) !== false) {
			$words = explode(' ', $line);
			$printer = Printer::singleInit();
			$printer->printify($words);
		}
		fclose($handle);
	}
}

