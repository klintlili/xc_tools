xc_tools
========

自己开发的一些有助于日常开发的小函数小工具等

php
--------

说明：php工具

文件：

### func.php

提高开发效率，方便debug的函数

- show(string var,boolean is_dump)

调试函数，打印php变量，is_dump为true使用var_dump，未传参或false使用print_r

### regexTool.class.php

正则表达式检验类

使用示例：
```
<?php
    //测试示例
    include_once 'func.php';
    include_once 'regexTool.class.php';
    $regexTool = new regexTool();
    // $regexTool->toggleReturnType();
    $regexTool->setFixMode('U');//懒惰模式
    $res = $regexTool->isEmail('541817418@qq.com');
    show($res,true);
```
