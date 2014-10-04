<?php
require_once 'printer.php';

class SecondFormParser {
	private $fileName;
	private $list_records = array();
	private $current_product_code;

	public function __construct($fileName) {
		$this->fileName = $fileName;
	}

	public function parse() {
		$handle = fopen($this->fileName, 'r');
		// read line by line
		while (($line = fgets($handle)) !== false) {
			$printer = Printer::singleInit();
			// ignore whitespace, tab and linefeed
			if (!trim($line)) {
				continue;
			}
			// check if current line contains product code or record of product
			if (strpos(trim($line), ' ')) {
				$words = explode(' ', $line);
				if (!array_key_exists($this->current_product_code, $this->list_records)) {
					// add product code as an index to array if it does not exist
					$this->list_records[$this->current_product_code] = array('words' => $words, 'unit' => 1);
				} else {
					// increase number of units if it does
					$this->list_records[$this->current_product_code]['unit']++;
				}
			} else {
				$this->current_product_code = trim($line);
			}
		}
		// reformat record to print
		foreach ($this->list_records as $key => $value) {
			$words = $value['words'];
			$price = rtrim($words[count($words) - 1], "\n");
			// repace price by unit
			$words[count($words) - 1] = $value['unit'];
			// add price
			array_push($words, $price);
			// add total
			array_push($words, ($value['unit'] * $words[count($words) - 1]) . "\n");
			$this->list_records[$key] = $words;
			$printer->printify($words);
		}
	}
}

