<?php
require '../vendor/autoload.php';

use Controller\ItemController;

$index=new ItemController();
echo $index->index();

?>