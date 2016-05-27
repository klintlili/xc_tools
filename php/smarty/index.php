<?php
    include_once 'template.class.php';

    $baseDir = str_replace('\\','/',dirname(__FILE__));
    $temp = new template($baseDir,$baseDir);

    $temp->assign('pagetitle','山寨smarty');
    $temp->assign('test','陈旭');

    $temp->getSourceTemplate('index');
    $temp->compileTemplate();
    $temp->display();
?>
