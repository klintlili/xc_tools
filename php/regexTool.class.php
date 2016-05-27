<?php
    //测试示例
    // include_once 'func.php';
    // include_once 'regexTool.class.php';
    // $regexTool = new regexTool();
    // // $regexTool->toggleReturnType();
    // $regexTool->setFixMode('U');//懒惰模式
    // $res = $regexTool->isEmail('541817418@qq.com');
    // show($res,true);

    class regexTool
    {
        //存储一些常见的正则表达式验证，如：邮箱，手机号，IP地址，URL地址，QQ号等
        private $validate = array(
            'require'   =>  '/.+/',
            'email'     =>  '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',
            'url'       =>  '/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/',
            'currency'  =>  '/^\d+(\.\d+)?$/',
            'number'    =>  '/^\d+$/',
            'zip'       =>  '/^\d{6}$/',
            'integer'   =>  '/^[-\+]?\d+$/',
            'double'    =>  '/^[-\+]?\d+(\.\d+)?$/',
            'english'   =>  '/^[A-Za-z]+$/',
            'qq'		=>	'/^\d{5,11}$/',
            'mobile'	=>	'/^1(3|4|5|7|8)\d{9}$/',
        );
        //返回匹配结果的属性
        private $returnMatchResult = false;
        //修正模式
        private $fixMode = null;
        //匹配结果
        private $matches = array();
        //验证结果
        private $isMatch = false;

        //构造函数初始化匹配结果和修正模式
        public function __construct($returnMatchResult = null,$fixMode = null)
        {
            $this->returnMatchResult = $returnMatchResult;
            $this->fixMode = $fixMode;
        }

        //核心匹配方法
        private function regex($pattern,$subject)
        {
            //检测$pattern是否为内置正则表达式
            if(array_key_exists(strtolower($pattern),$this->validate))
            {
                $pattern = $this->validate[$pattern].$this->fixMode;
            }
            $this->returnMatchResult ?
                preg_match_all($pattern,$subject,$this->matches) :
                    $this->isMatch = preg_match($pattern,$subject) === 1;
            return $this->getRegexResult();
        }

        //获取匹配结果
        private function getRegexResult()
        {
            if($this->returnMatchResult)
            {
                return $this->matches;
            }
            else
            {
                return $this->isMatch;
            }
        }

        //切换返回值为匹配结果还是是否匹配成功（布尔值）、
        public function toggleReturnType($bool = null)
        {
            if(empty($bool))
            {
                $this->returnMatchResult = !$this->returnMatchResult;
            }
            else
            {
                $this->returnMatchResult = is_bool($bool) ? $bool : (bool)$bool;
            }
        }

        //设置修正模式
        public function setFixMode($fixMode)
        {
            $this->fixMode = $fixMode;
        }


    	public function noEmpty($str) {
    		return $this->regex('require', $str);
    	}

    	public function isEmail($email) {
    		return $this->regex('email', $email);
    	}

    	public function isMobile($mobile) {
    		return $this->regex('mobile', $mobile);
    	}

    	public function check($pattern, $subject) {
    		return $this->regex($pattern, $subject);
    	}

    	//......

    }
?>
