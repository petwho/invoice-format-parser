#Invoice Format Parser

This repository contains the following items:

- `main.php`: This initial file will process command line argument and create a parser.
- `parser_factory.php`: A factory to create parser.
- `first_form_parser.php`: Parser's implementation which supports parsing the first format.
- `second_form_parser.php`: Parser's implemention which supports parsing the second format.
- `printer.php`: Print parsed result.
- `examples`: example invoice text files.

##Overview
Invoice format parser is a small parsing tool written in PHP and is used to parse invoice text.
There are two implementations which are included into the repository, each supports different invoice formats.


The first implementation supports parsing format which has no product code inside with each line from invoice contains product name, number of units, price and total cost. Here is an example of this format:

```
13-inch MacBook Air 256GB 1 1200 1200
VAIO Pro 13 Touch Ultrabook 2 1250 2500
Windows 8.1 Professional  1 199 199 
Windows 8.1 Professional  1 199 199
```

The second implementation supports parsing format which contains product code. Each product code is put into one
line and then followed by product name and price. Here is an example of this format:

```
13INCH-MBA-256
13-inch MacBook Air 256GB 1100

VAIO-P13-TU
VAIO Pro 13 Touch Ultrabook 1250
VAIO Pro 13 Touch Ultrabook 1250

WIN-81-PRO
Windows 8.1 Professional 199
```

Using this tool will help to generate reports with the same format which contains product name, number of units, price and total cost. Here is an example:

Name                          |Unit      |Price     |Total
------------------------------|----------|----------|-----
13-inch MacBook Air           |1         |1200      |1200
VAIO Pro 13 Touch             |2         |1250      |2500
Windows 8.1 Professional      |1         |199       |199
Windows 8.1 Professional      |1         |199       |199

##Usage

Download the repository to your local computer and unzip it. Make sure you have PHP installed on your machine.
This should work with any versions greater than 5.0. However, using latest version 5.5 is recommended.

In your computer, open up terminal emulator. Then navigate to the unzipped folder and run this command:

`$ php main.php examples/invoice1.txt`

##How It Works

The `main.php` init file reads invoice file path from command line arguments, read the first line from invoice file. The second invoice format contains the product code in the first line thus has no space in it while the first invoice format does contain spaces. The script in `main.php` uses this information  to determine which type of parser to create.

````php
// create parser
strpos($first_line, ' ') ?  ParserFactory::createParser($file_name, 1)
    : ParserFactory::createParser($file_name, 2);
```


The file `ParserFactory` class acts as a factory to build appropreate parser. Eeach parser has its own implmentation.
This repository contains two implementations `FirstFormParser` and `SecondFormParser`.


The parsing taks is done inside the parser. Finally, `Printer` class receives parsed result returned from each parser's implementation to print out the report.

This document was created by a member in [Học lập trình](http://www.hoclaptrinh.org).
