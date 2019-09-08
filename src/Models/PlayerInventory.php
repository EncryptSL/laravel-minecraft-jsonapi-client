<?php


namespace Kangoo13\Minecraft\JsonApi\Models;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class PlayerInventory
 *
 * @package   Kangoo13\Minecraft\JsonApi\Models
 * @author    Aurélien SCHILTZ <aurelienschiltz@gmail.com>
 * @copyright 2016-2019 Kangoo13
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class PlayerInventory
{
    /**
     * @Serializer\Type("array<Kangoo13\Minecraft\JsonApi\Models\Item>")
     * @Serializer\SerializedName("inventory")
     * @var Item[]
     */
    protected $items;

    /**
     * @return Item[]
     */
    public function getItems() : array
    {
        return $this->items;
    }

    /**
     * @param Item[] $items
     *
     * @return PlayerInventory
     */
    public function setItems(array $items) : PlayerInventory
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Is there a free slot in player inventory?
     *
     * @return bool
     */
    public function isFreeSlot()
    {
        foreach ($this->items as $item) {
            if ($item->getAmount() === null) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the number of free slots in the player inventory.
     *
     * @return int
     */
    public function getFreeSlots()
    {
        $freeSlots = 0;

        foreach ($this->items as $item) {
            if ($item->getAmount() === null) {
                $freeSlots ++;
            }
        }

        return $freeSlots;
    }
}
