# Sort colors
*ver 0.9*  
PHP function that sorts array of RGB colors.

What to do:  
- DRY code
- check if sorted arrays exist

### What you need
Array of RGB colors with structure:  
`array(
	[0] => array (
		r => 3, 
		g => 5, 
		b => 8
	), 
	[1] => array (
		r => 13, 
		g => 21, 
		b => 34
	), `
etc. 

If you have another structure, you need to modify my code. 

### How to use
`<?php
include 'rb-sort-colors.php';
RBsortColors($unsortedArray, 'colorClass');
?>`
