<?php
    class template
    {
        //1.私有成员属性
        private $templateDir;//模板目录
        private $compileDir;//编译后文件存储目录
        private $leftTag = '{#';//替换模板的左标记
        private $rightTag = '#}';//右标记
        private $currentTemp = '';//存储当前替换的模板
        private $outputHtml;//源文件的HTML代码
        private $varPool = array();//变量池

        //2.构造函数
        public function __construct($templateDir,$compileDir,$leftTag = null,$rightTag = null)
        {
            $this->templateDir = $templateDir;
            $this->compileDir = $compileDir;
            if(!empty($leftTag)) $this->leftTag = $leftTag;
            if(!empty($rightTag)) $this->rightTag = $rightTag;
        }

        //3.写入和获取变量数据
        public function assign($tag,$var)
        {
            $this->varPool[$tag] = $var;
        }

        public function getVar($tag)
        {
            return $this->varPool[$tag];
        }

        //4.获取模板源文件
        public function getSourceTemplate($templateName,$ext = '.html')
        {
            $this->currentTemp = $templateName;
            $sourceFilename = $this->templateDir.'/'.$this->currentTemp.$ext;//模板完整路径
            $this->outputHtml = file_get_contents($sourceFilename);
        }

        //5.模板编译
        public function compileTemplate($templateName = null,$ext = '.html')
        {
            $templateName = empty($templateName) ? $this->currentTemp : $templateName;
            //正则表达式：/\{#\$(\w+)#\}/
            $pattern = '/'.preg_quote($this->leftTag);
            $pattern .= ' *\$([a-zA-Z_]\w*) *';
            $pattern .= preg_quote($this->rightTag).'/';
            $this->outputHtml = preg_replace($pattern,'<?php echo $this->getVar(\'$1\'); ?>',$this->outputHtml);//编译

            $compiledFilename = $this->compileDir.'/'.md5($templateName).$ext;//存储编译后文件的路径
            file_put_contents($compiledFilename,$this->outputHtml);//编译后的文件
        }

        //6.显示模板
        public function display($templateName = null,$ext = '.html')
        {
            $templateName = empty($templateName) ? $this->currentTemp : $templateName;
            include_once $this->compileDir.'/'.md5($templateName).$ext;
        }
    }
?>
