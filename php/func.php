<?php
    //打印变量
    function show($var = null,$is_dump = false)
    {
        $func = $is_dump ? 'var_dump' : 'print_r';
        //null
        if(is_null($var))
        {
          echo "null";
        }
        //array,object
        elseif(is_array($var) || is_object($var))
        {
          echo "<pre>";
          $func($var);
          echo "</pre>";
        }
        //string,boolean,integer,float...
        else
        {
          $func($var);
        }
    }
?>
