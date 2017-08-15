<?php 
require './vendor/autoload.php';
use Greens\Check;

$check = new Check('xxxx','xxx');

$res = $check->checkUrl('http://mm.howkuai.com/wp-content/uploads/2017a/06/11/01.jpg');
echo '<pre>';print_r($res);

