<?php
require_once('header_none.php');
$id = $_GET['id']; $fs = new GridFS();
//query the file object
$fs->id = $id; $object = $fs->get_one_file();
 //set content-type header, output in browser
header('Content-type: '.$object->file['filetype']);
echo $object->getBytes();
?>