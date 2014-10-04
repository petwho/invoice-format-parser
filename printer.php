<?php
class Printer {
	static private $singleton;
	static private $linenum = 0;

	static private function printHeadline() {
		print str_pad('Name', 30);
		print str_pad('Unit', 10);
		print str_pad('Price', 10);
		print "Total\n";
		print str_pad('-', 30, '-');
		print str_pad('-', 10, '-');
		print str_pad('-', 10, '-');
		print str_pad('-', 5, '-')."\n";
	}

	public static function singleInit() {
		if (!self::$singleton) {
			print self::printHeadline();
			self::$singleton = new Printer();
		}
		self::$linenum++;
		return self::$singleton;
	}

	public function printify($words) {
		$length = count($words);
		$str = '';
		if ($words == array("\n")) {
			print "\n";
		} elseif ($length > 4) {
			for ($i = 0; $i < $length - 4; $i++) {
				$str .= $words[$i] . ' ';
			}
			print str_pad($str, 30); 
			print str_pad(rtrim($words[$length - 3], "\n"), 10); 
			print str_pad($words[$length - 2], 10); 
			print str_pad($words[$length - 1], 10) . "\n";
		} else {
			echo "\033[31m>>> Error: Malformat record on line " . self::$linenum . ". Exit!\n\033[37m";
			exit(0);
		}
	}

}

