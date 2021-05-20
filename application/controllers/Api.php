<?php
/**
 * @name IndexController
 * @desc 
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
 use Support\Response;
 use Support\Log;

class ApiController extends BaseController {

	/** 
     * 默认动作
     * Yaf支持直接把\Yaf\Request_Abstract::getParam()得到的同名参数作为Action的形参
     */
	public function indexAction() {
        $result = SampleModel::all();
        foreach ($result as $value) {
            //print_r($value);
        }
        Log::warning("test","warning",["warning"]);
		Response::success([]);
	}
}
