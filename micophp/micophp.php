<?php




	header("Content-Type:text/html;charset=utf-8");  //设置系统的输出字符为utf-8
	date_default_timezone_set("PRC");    		 //设置时区（中国）


/*
*定义框架模块变量
*
*/


	define("APP_CONTROLLER", dirname(APP_PATH) . '/');
	define("APP_RUNTIME_PATH", APP_PATH . "/runtime");
	define("APP_MODEL_PATH", APP_PATH . "/model");
	define("APP_VIEW_PATH", APP_PATH . "/view");
	define("APP_CONTROLLER_PATH", APP_PATH . "/controller");
	define("APP_SMARTY_PATH", MICOPHP_PATH . "/base/smarty/libs/");




/*
*
*加载文件夹内的所有函数
*/

	$include_path=get_include_path();
	
	$include_path.= PATH_SEPARATOR . MICOPHP_PATH . "/base/struct/";
	$include_path.= PATH_SEPARATOR . APP_CONTROLLER_PATH;
	$include_path.= PATH_SEPARATOR . APP_SMARTY_PATH;
	set_include_path($include_path);


	//自动加载类 	
	function __autoload($className){
		if($className=="memcache"){        //如果是系统的Memcache类则不包含
			return;
		}else if($className=="Smarty"){    //如果类名是Smarty类，则直接包含
			include "Smarty.class.php";
		}else{                             //如果是其他类，将类名转为小写
			include strtolower($className).".class.php";
		}	
		
	}



/*
*控制器url解析
*
*/
	Prourl::parseUrl();
	new Action;

	//控制器类所在的路径
	$srccontrolerfile=APP_PATH."controller/".strtolower($_GET["m"]).".class.php";


	if (file_exists($srccontrolerfile)) {
		# 判断文件是否存在
		$className=ucfirst($_GET["m"]);
		$controller = new $className();
		$method=$_GET["a"];
		if(method_exists($controller, $method)){
				$controller->$method();
		}
		else
		{
			echo("<font color='red'>对不起 " . APP_PATH . "controller目录下创建文件名为".strtolower($_GET["m"]).".class.php的文件，声明类名".ucfirst($_GET["m"]). '类中的' . $_GET['a'] . "方法不存在<font>");
		}

	}
	else{
		echo("<font color='red'>对不起!你访问的模块不存在,应该在".APP_PATH."controller目录下创建文件名为".strtolower($_GET["m"]).".class.php的文件，声明一个类名为".ucfirst($_GET["m"])."的类！</font>");
		
	}

?>