<?php
/**
 * @package   Ankitdev\PoNumber
 * @author    Ankitdev
 */

declare(strict_types=1);

namespace Ankitdev\PoNumber\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Ankitdev\PoNumber\Api\Data\PoNumberInterface;

/**
 * Class AddPoNumberToOrder
 *
 * @category Observer
 * @package  Ankitdev\PoNumber\Observer
 */
class AddPoNumberToOrder implements ObserverInterface
{
    /**
     * Execute observer method.
     *
     * @param Observer $observer Observer
     *
     * @return void
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();

        $order->setData(
            PoNumberInterface::CHECKOUT_PURCHASE_ORDER_NO,
            $quote->getData(PoNumberInterface::CHECKOUT_PURCHASE_ORDER_NO)
        );
    }
}
