<?php
/**
 * Created by PhpStorm.
 * User: blaise
 * Date: 4/1/17
 * Time: 3:57 PM
 */

namespace App\CustomClasses\ShoppingCart;


class WeeklyBilling
{
    protected $cart;
    protected $delivery_fee;
    protected $discount;
    protected $number_of_items;
    protected $items_with_discount;
    protected $markup;
    protected $cost_of_weekly;
    protected $weekly_items;
    protected $fee_after;
    protected $weekly_profit;
    protected $discount_value;

    /**
     * @param ShoppingCart|null $cart For displaying business info, like prices, no need to pass a shopping cart
     * else pass the shopping cart to compute billing information
     */
    public function __construct(ShoppingCart $cart = null)
    {
        $this->cart = $cart;
        $this->delivery_fee = 3;
        $this->discount_value = .6;
        $this->number_of_items = $this->countWeeklyItems();
        $this->items_with_discount = $this->countItemsWithDiscount();
        $this->markup = 0.75;
        $this->weekly_items = $cart->getWeeklySpecialItems();
        $this->cost_of_weekly=$this->costOfWeekly();
        $this->fee_after = $this->fee();
        $this->weekly_profit = $this->profit();
        $this->discount;

    }

    public function countWeeklyItems()
    {
        return count($this->cart->getWeeklySpecialItems());
    }

    public function countItemsWithDiscount()
    {
        if ($this->number_of_items < 5 && $this->number_of_items > 1) {
            return $this->number_of_items - 1;
        } else if ($this->number_of_items >= 5) {
            return 3;
        } else {
            return 0;
        }
    }

    public function costOfWeekly()
    {
        $cost = 0;
        if (!empty($this->weekly_items)) {
            foreach ($this->weekly_items as $item) {
                $cost += $item->getPrice() + $this->markup;
            }
        }
        return $cost;
    }

    public function fee()
    {
        if (empty($this->weekly_items))
            return 0;
        else
            return $this->delivery_fee - ($this->countItemsWithDiscount() * $this->getDiscountValue());
    }

    /**
     * @return float
     */
    public function getDiscountValue()
    {
        return $this->discount_value;
    }

    public function profit()
    {
        if ($this->getNumberOfItems() == 0) {
            return 0;
        } else {
            return $this->getDeliveryFee() + ($this->getNumberOfItems() * $this->getDiscountValue());
        }
    }

    /**
     * @return array
     */
    public function getNumberOfItems()
    {
        return $this->number_of_items;
    }

    /**
     * @return int
     */
    public function getDeliveryFee()
    {
        return $this->delivery_fee;
    }

    /**
     * @return int
     */
    public function getCostOfWeekly()
    {
        return $this->cost_of_weekly;
    }

    /**
     * @return ShoppingCart|null
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @return int
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @return float
     */
    public function getMarkup()
    {
        return $this->markup;
    }

    /**
     * @return array
     */
    public function getWeeklyItems()
    {
        return $this->weekly_items;
    }

    /**
     * @return int
     */
    public function getFeeAfter()
    {
        return $this->fee_after;
    }

    /**
     * @return int
     */
    public function getWeeklyProfit()
    {
        return $this->weekly_profit;
    }

    public function discount()
    {
        return $this->getItemsWithDiscount() * $this->discount_value;
    }

    /**
     * @return array|int
     */
    public function getItemsWithDiscount()
    {
        return $this->items_with_discount;
    }
}