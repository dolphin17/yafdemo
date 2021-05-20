<?php
/**
 * @name ErrorController
 * @desc 错误控制器, 在发生未捕获的异常时刻被调用
 * @see http://www.php.net/manual/en/yaf-dispatcher.catchexception.php
 */
use Support\Response;

class ErrorController extends \Yaf\Controller_Abstract {

    //从2.1开始, errorAction支持直接通过参数获取异常
    public function errorAction($exception) {
        //1. assign to view engine
        //$this->getView()->assign("exception", $exception);
        /* error occurs */
        $exception = $this->getRequest()->getException();
        try {
            throw $exception;
        } catch (\Yaf\Exception\LoadFailed $e) {
            //加载失败
            Response::fail("route error");
        } catch (\Yaf\Exception $e) {
            //其他错误
            Response::fail($e->getMesssage());
        }catch (\Exception $e) {
            //非Yaf捕获到的错误
            Response::fail("unknow error");
        }
    }
}
