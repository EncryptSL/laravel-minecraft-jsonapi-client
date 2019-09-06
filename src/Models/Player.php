<?php


namespace Kangoo13\Minecraft\JsonApi\Models;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation;

/**
 * Class Player
 *
 * @package   Kangoo13\Minecraft\JsonApi\Models
 * @author    Aurélien SCHILTZ <aurelienschiltz@gmail.com>
 * @copyright 2016-2019 Kangoo13
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class Player
{
    /**
     * @Serializer\Type("boolean")
     * @var bool
     */
    protected $op;

    /**
     * @Serializer\Type("string")
     * @var string
     */
    protected $ip;

    /**
     * @Serializer\Type("array<Kangoo13\Minecraft\JsonApi\Models\Enderchest>")
     * @var Enderchest[]
     */
    protected $enderchest;

    /**
     * @return bool
     */
    public function isOp()
    {
        return $this->op;
    }

    /**
     * @param bool $op
     *
     * @return Player
     */
    public function setOp(bool $op) : Player
    {
        $this->op = $op;

        return $this;
    }

    /**
     * @return Enderchest[]
     */
    public function getEnderchest() : array
    {
        return $this->enderchest;
    }

    /**
     * @param Enderchest[] $enderchest
     *
     * @return Player
     */
    public function setEnderchest(array $enderchest) : Player
    {
        $this->enderchest = $enderchest;

        return $this;
    }

    /**
     * @return string
     */
    public function getIp() : string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     *
     * @return Player
     */
    public function setIp(string $ip) : Player
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Is Player Connected?
     *
     * @return bool
     */
    public function isConnected() : bool {
        return !$this->getIp() === 'offline';
    }
}
