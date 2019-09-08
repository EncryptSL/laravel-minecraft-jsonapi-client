<?php


namespace Kangoo13\Minecraft\JsonApi\Models;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Item
 *
 * @package   Kangoo13\Minecraft\JsonApi\Models
 * @author    Aurélien SCHILTZ <aurelienschiltz@gmail.com>
 * @copyright 2016-2019 Kangoo13
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class Item
{
    /**
     * @Serializer\Type("integer")
     * @var int
     */
    protected $amount;

    /**
     * @Serializer\Type("integer")
     * @var int
     */
    protected $durability;

    /**
     * @Serializer\Type("integer")
     * @Serializer\SerializedName("dataValue")
     * @var int
     */
    protected $dataValue;

    /**
     * @Serializer\Type("integer")
     * @var int
     */
    protected $type;

    /**
     * @Serializer\Type("array")
     * @var array
     */
    protected $enchantments;

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     *
     * @return Item
     */
    public function setAmount(int $amount) : Item
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return int
     */
    public function getDurability()
    {
        return $this->durability;
    }

    /**
     * @param int $durability
     *
     * @return Item
     */
    public function setDurability(int $durability) : Item
    {
        $this->durability = $durability;

        return $this;
    }

    /**
     * @return int
     */
    public function getDataValue()
    {
        return $this->dataValue;
    }

    /**
     * @param int $dataValue
     *
     * @return Item
     */
    public function setDataValue(int $dataValue) : Item
    {
        $this->dataValue = $dataValue;

        return $this;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     *
     * @return Item
     */
    public function setType(int $type) : Item
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return array
     */
    public function getEnchantments() : array
    {
        return $this->enchantments;
    }

    /**
     * @param array $enchantments
     *
     * @return Item
     */
    public function setEnchantments(array $enchantments) : Item
    {
        $this->enchantments = $enchantments;

        return $this;
    }
}
