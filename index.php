<?php

require_once 'imagine.phar';

require 'mosaique.php';

define('GD_LIBRARY', 'Gd');

$params = array(


	'source' => './images',

	'output' => 'thumbs/moz.jpg',

	'width'	=> 150,

	'height' => 150,

	'per_line' => 4,

	'filters' => array('jpg', 'jpeg', 'png')

	);
$mosaique = new Mosaique($params);

$mosaique->generate();









?>