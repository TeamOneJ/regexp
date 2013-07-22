RegExp
======

RegExp wrapper for PHP.

*Copyright 2013 Dan Horrigan - Released under the MIT License*

### Why use this?

Some reasons to use this over the `preg_*` functions:

- Allows for easy RegExp re-use.
- Matches are encapsulated allowing access to the RegExp from which it came.
- When using `PREG_OFFSET_CAPTURE`, it is included in the `Match` object for easy access.
- More to come...

### Usage

``` php
<?php include 'vendor/autoload.php';

use DanDoesCode\RegExp\RE;

$match = RE::match('/"(?<name>[^"]*)"/', 'My name is "Dan".');

echo $match['name']; // Outputs: Dan
```
