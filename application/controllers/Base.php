<?php
class BaseController extends \Yaf\Controller_Abstract {

    protected $request = [];
    /**
     * 默认初始化方法，如果不需要，可以删除掉这个方法
     * 如果这个方法被定义，那么在Controller被构造以后，Yaf会调用这个方法
     */
    public function init() {
		$this->initRequest();
        $this->checkValidateSign();
	}

    public function initRequest(){
        if ($this->getRequest()->isGet()){
            $this->request = $this->getRequest()->getQuery();
        }else{
            $this->request = file_get_contents("php://input");
        }
    }

    //验证签名
    public function checkValidateSign(){

    }
}