<?php
/**
 * @package   Ankitdev\PoNumber
 * @author    Ankitdev
 */

declare(strict_types=1);

namespace Ankitdev\PoNumber\Api\Data;

/**
 * Interface PoNumberInterface
 *
 * @category Api/Data/Interface
 * @package  Ankitdev\PoNumber\Api\Data
 */
interface PoNumberInterface
{
    const CHECKOUT_PURCHASE_ORDER_NO = 'checkout_purchase_order_no';

    /**
     * Get checkout purchase order number
     *
     * @return string|null
     */
    public function getCheckoutPurchaseOrderNo();

    /**
     * Set checkout purchase order number
     *
     * @param string|null $checkoutPurchaseOrderNo Purchase order number
     *
     * @return PoNumberInterface
     */
    public function setCheckoutPurchaseOrderNo(string $checkoutPurchaseOrderNo = null);
}
