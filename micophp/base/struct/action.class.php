<?php
require(APP_SMARTY_PATH . "Smarty.class.php");
	class Action extends Smarty {
		/**
		 * 构造方法，用于初使化Smarty对象中的成员属性
		 *
		 */
		function __construct(){
			$this->template_dir=APP_VIEW_PATH;  //模板目录
			$this->compile_dir=APP_PATH."runtime/";    //里的文件是自动生成的，合成的文件
			$this->cache_dir=APP_PATH."runtime/cache/";  //设置缓存的目录
			$this->left_delimiter="{{";   //模板文件中使用的“左”分隔符号
			$this->right_delimiter="}}";   //模板文件中使用的“右”分隔符号        /
			parent::__construct(); 
		}


	}




?>
