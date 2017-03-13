<?php

namespace App\CustomClasses\ShoppingCart;


use App\Models\EventItem;
use App\Models\MenuItem;

/**
 * Class CartItem Client interface for items in the shopping cart
 * @package App\CustomClasses
 */
class CartItem
{
    protected $item;
    protected $extras;
    protected $si;
    protected $item_type;
    protected $cart_item_id;

    public function __construct($item_id, $item_type)
    {
        $this->item_type = $item_type;
        if ($item_type == ItemType::EVENT_ITEM) {
            $this->item = EventItem::find($item_id);
        } else if ($item_type == ItemType::RESTAURANT_ITEM) {
            $this->item = MenuItem::find($item_id);
        }
    }

    public function getCartItemId()
    {
        return $this->cart_item_id;
    }

    public function setCartItemId($cart_id)
    {
        $this->cart_item_id = $cart_id;
    }

    public function itemType()
    {
        return $this->item_type;
    }

    public function getPrice()
    {
        return $this->item->getPrice();
    }

    public function getSellerEntity()
    {
        return $this->item->getSellerEntity();
    }

    public function setInstructions($si)
    {
        $this->si = $si;
    }

    public function setExtras($extras)
    {
        $this->extras = $extras;
    }

    public function itemExtras()
    {
        return $this->item->extras();
    }

    public function orderExtras()
    {
        return $this->extras;
    }

    public function special_instructions()
    {
        return $this->si;
    }


}