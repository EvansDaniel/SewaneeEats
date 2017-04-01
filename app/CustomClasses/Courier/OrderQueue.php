<?php

namespace App\CustomClasses\Courier;


use App\Models\CourierOrder;
use App\Models\Order;
use App\User;
use Auth;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class OrderQueue
{
    protected $courier;
    protected $courier_info;
    protected $orders_for_courier;
    protected $orders;

    public function __construct(User $courier)
    {
        if (!$courier->hasRole('courier')) {
            throw new InvalidArgumentException('The User type passed must have the role of courier');
        }
        $this->courier = $courier;
        $this->courier_info = new CourierInfo($this->courier);
        $this->courier_info->setIsDeliveringOrder(false);
        if (!empty($err_msg = $this->validateCourier())) {
            throw new InvalidArgumentException($err_msg);
        }
        // $this->orders and $this->orders_for_courier set in retrieveOrders()
        $this->retrieveOrders();
    }

    /**
     * Determines if the courier attempting to view the next order in the
     * queue is allowed to view/accept the order
     * Necessary b/c we are emailing the courier a link that takes them
     * to the next order, which can lead to stale links in the emails
     * so we need to check for this stuff
     * @return string|integer returns a string as a message to user on
     * failure and zero on success
     */
    public function validateCourier()
    {
        if (!Auth::user()->isOnShift()) {
            return "You are not on the current shift and 
                    therefore cannot view the orders queue";
        }
        // check that the courier isn't currently delivering an order
        $courier_info = $this->courier_info->getInfo();
        if ($courier_info->is_delivering_order) {
            return "You are currently delivering an order. Please finish that one first
                    before getting more";
        }
        return 0;
    }

    /**
     * Retrieves the orders that are currently
     * undelivered and not begin processed starting from oldest
     * to newest and only the orders that fit his/her courier type
     * who is trying to view retrieve the orders via the order queue
     */
    private function retrieveOrders()
    {
        // order oldest to newest and only undelivered and
        // not being processed orders
        $potential_orders = Order::pending()->
        orderBy('created_at', 'ASC')->get();
        $this->orders = $potential_orders;
        $orders = [];
        $courier_type = $this->courier_info->getCourierTypeCurrentShift();
        // get only orders for this courier type
        foreach ($potential_orders as $order) {
            if ($order->hasCourierType($courier_type)) {
                $orders[] = $order;
            }
        }
        $this->orders_for_courier = $orders;
    }

    /**
     * @return bool true if there are orders
     * that haven't been serviced and are not being serviced
     * (i.e. pending), false otherwise
     */
    public function hasOrders()
    {
        return $this->numberOfOrdersPending() > 0;
    }

    /**
     * @return int the number of orders that are pending
     * unqualified by the given courier (the overall total pending orders)
     */
    public function numberOfOrdersPending()
    {
        return count($this->orders);
    }

    /**
     * This method will be used to retrieve and assign the next
     * order in the queue to the given courier
     * @return Order|null the next order out of the queue
     * or null if the queue is empty
     */
    public function nextOrder()
    {
        if (!$this->hasOrdersForCourierType()) {
            return null;
        }
        return $this->orders_for_courier[0];
    }

    /**
     * @return bool true if there are orders
     * THAT CAN BE SERVICED BY THE GIVEN COURIER and
     * that haven't been serviced and are not being serviced
     * (i.e. pending), false otherwise
     */
    public function hasOrdersForCourierType()
    {
        return $this->numberOfOrdersPendingForCourier() > 0;
    }

    /**
     * @return int the number of orders that are pending
     * qualified by the given courier
     * (number of orders the given courier can service at this time)
     */
    public function numberOfOrdersPendingForCourier()
    {
        return count($this->orders_for_courier);
    }

    /**
     * @param Order $order the order to assign the the given courier
     */
    public function assignCourierToOrder(Order $order)
    {
        // TODO: create a new couriers orders entry and set the is_delivering_order bool for courier
        $courier_order = new CourierOrder;
        $courier_order->courier_id = $this->courier->id;
        $courier_order->order_id = $order->id;
        $courier_order->save();
    }

    /**
     * @return mixed retrieves all pending orders
     */
    public function getPendingOrders()
    {
        return $this->orders;
    }

    /**
     * @return mixed retrieves the pending orders that can be serviced
     * by the given courier
     */
    public function getPendingOrdersForCourier()
    {
        return $this->orders_for_courier;
    }

    /**
     * Sends an email to the manager of the current shift
     * in the event that one of the orders is not accepted
     * by a courier within some amount of time
     */
    public function orderNotServicedPromptly()
    {

    }

    /**
     * In the event that a courier is unable to fulfill an order
     * after accepting it, this method will be used to return the
     * order to the order queue, where it will be made a top priority
     * @param $order Order the order to be reinserted into the queue
     * at top priority
     */
    public function reinsertOrder(Order $order)
    {
        if ($order->is_delivered) {
            throw new InvalidArgumentException('The order given has been delivered already');
        }
        // check that the order is currently being delivered
        // if so, set it to not being delivered
        // TODO: check that the order is being delivered by the given courier before reinserting
        if ($order->is_being_delivered) {
            $order->is_being_delivered = false;
            $order->save();
            // TODO: send email to shift manager notifying them that an order was delayed\
            // TODO: An order can be reinserted by a courier servicing it, make him/her give a reason why they can no longer service it
        }
        // nothing to do if the order is not being delivered and isnt' delivered
    }
}