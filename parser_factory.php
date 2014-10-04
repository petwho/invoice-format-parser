<?php
include 'first_form_parser.php';
include 'second_form_parser.php';

abstract class ParserFactory {
	public static function createParser($fileName, $type) {
		$parser = ($type == 1) ? new FirstFormParser($fileName)
				: new SecondFormParser($fileName);
		$parser->parse();
	}
}

