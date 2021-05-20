<?php
/**
 * @name Bootstrap
 * @desc 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:\Yaf\Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
 use Illuminate\Database\Capsule\Manager as Capsule;
class Bootstrap extends \Yaf\Bootstrap_Abstract {

    public function _initConfig() {
		//把配置保存起来
		$arrConfig = \Yaf\Application::app()->getConfig();
		\Yaf\Registry::set('config', $arrConfig);
	}

	public function _initAutoload(){
		require_once APPLICATION_PATH."/vendor/autoload.php";
	}

	public function _initFunction(){
		Yaf\Loader::import("support/Function.php");
	}

	public function _initEnvironment(Yaf\Dispatcher $dispatcher)
    {
        date_default_timezone_set('UTC');

        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        $showErrors = 1;

        /* 检测调试 */
        if (isset($_GET['debug']) && $_GET['debug'] == 1) {
            $showErrors = 1;
        }

        if ($showErrors) {
            define('APP_DEBUG', true);
            ini_set('display_errors', 'On');
        } else {
            define('APP_DEBUG', false);
            ini_set('display_errors', 'Off');
        }

       
    }

	public function _initPlugin(\Yaf\Dispatcher $dispatcher) {
		//注册一个插件
		$objSamplePlugin = new SamplePlugin();
		$dispatcher->registerPlugin($objSamplePlugin);
	}

	public function _initDatabase(){
		$config = Yaf\Registry::get('config')->toArray();
        $capsule = new Capsule();
		$connctionConfig = $config['mysql'];
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => $connctionConfig['host'],
            'port' => intval($connctionConfig['port']),
            'database' => $connctionConfig['database'],
            'username' => $connctionConfig['user'],
            'password' => $connctionConfig['password'],
            'charset' => $connctionConfig['charset'],
            'prefix' => $connctionConfig['prefix'],
        ], 'default');

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
	}

	public function _initRoute(\Yaf\Dispatcher $dispatcher) {
		//在这里注册自己的路由协议,默认使用简单路由
	}
	
	public function _initView(\Yaf\Dispatcher $dispatcher) {
		//在这里注册自己的view控制器，例如smarty,firekylin
		/* 禁用视图 */
		$dispatcher->disableView();
	}
}
