<?php
namespace Support;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

class Log
{
    const LOG_CHANNEL_NAME = 'daily';

    /**
     * @param string $category
     * @param string $level
     * @return Logger|bool
     */
    public static function makeLogger(string $category, string $level)
    {
        $logger = new Logger(self::LOG_CHANNEL_NAME);

        $project = \Yaf\Registry::get("project");
        $date = date("Y-m-d");
        if (!$project) {
            $project = "system";
        }

        $path = APPLICATION_PATH . "/logs/{$project}/{$category}-{$date}.log";

        try {
            $handler = new StreamHandler($path);

            $dateFormat = "Y-m-d H:i:s";
            $ip = getIp() ?? "127.0.0.1";
            $time = time();
            $traceId = \Yaf\Registry::get("traceId") ?? "undefined";

            $output = "%datetime% %level_name% {$project} {$category} {$traceId} {$ip} {$time} | %message% | %context% \n";
            $formatter = new LineFormatter($output, $dateFormat);
            $handler->setFormatter($formatter);

            $logger->pushHandler($handler);
            return $logger;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * alert日志
     *
     * @param  string $message
     * @param  array $context
     * @return void
     */
    public static function alert(string $message, array $context = [])
    {
        return self::makeLogger("alert", "alert")->alert($message, $context);
    }

    /**
     * error日志
     * @param string $category
     * @param string $message
     * @param array $context
     * @return mixed
     */
    public static function error(string $category, string $message, array $context = [])
    {
        return self::makeLogger($category, "error")->error($message, $context);
    }

    /**
     * warning日志
     * @param string $category
     * @param string $message
     * @param array $context
     * @return mixed
     */
    public static function warning(string $category, string $message, array $context = [])
    {
        return self::makeLogger($category, "warning")->warning($message, $context);
    }

    /**
     * info日志
     * @param string $category
     * @param array $context
     * @return mixed
     */
    public static function info(string $category, array $context = [])
    {
        return self::makeLogger($category, "info")->info("-", $context);
    }


    /**
     * debug日志
     * @param string $category
     * @param array $context
     * @return mixed
     */
     public static function debug(string $category, array $context = [])
     {
         return self::makeLogger($category, "debug")->info("-", $context);
     }
}
