<?php

namespace Mix\Database;

use Mix\Bean\BeanInjector;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class Dialer
 * @package Mix\Database
 */
class Dialer
{

    /**
     * 最大连接数
     * @var int
     */
    public $maxActive = 10;

    /**
     * 最多可空闲连接数
     * @var int
     */
    public $maxIdle = 5;

    /**
     * 事件调度器
     * @var EventDispatcherInterface
     */
    public $dispatcher;

    /**
     * AbstractConnection constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        BeanInjector::inject($this, $config);
    }

    /**
     * Dial
     * @param string $dsn
     * @param string $username
     * @param string $password
     * @param array $options
     * @return Database
     */
    public function dial(string $dsn, string $username, string $password, array $options = []): Database
    {
        $db             = new Database($dsn, $username, $password, $options);
        $db->maxActive  = $this->maxActive;
        $db->maxIdle    = $this->maxIdle;
        $db->dispatcher = $this->dispatcher;
        return $db;
    }

}
