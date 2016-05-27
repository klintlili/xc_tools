xc_tools
========

- php：提高开发效率，方便debug的函数和类。

php
--------

### func.php

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

### smarty

山寨smarty，模板替换

- 获取模板源文件
- 编译模板（正则替换）：前端后端代码集成
- 输出给用户
