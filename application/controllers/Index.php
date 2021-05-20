<?php
/**
 * @name IndexController
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
 use Support\Response;
class IndexController extends BaseController {
    /**
     * 默认初始化方法，如果不需要，可以删除掉这个方法
     * 如果这个方法被定义，那么在Controller被构造以后，Yaf会调用这个方法
     */
    public function init() {
		
	}

	/** 
     * 默认动作
     * Yaf支持直接把\Yaf\Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/yaf_skeleton/index/index/index/name/hello 的时候, 你就会发现不同
     */
	public function indexAction() {
		//1. fetch query
		//$get = $this->getRequest()->getQuery("get", "default value");

		//2. fetch model
		
		//3. assign
		//$this->getView()->assign("content", $model->selectSample());
		//$this->getView()->assign("name", $name);
		Response::success();
	}
}
