<?php
/**
 * @package   Ankitdev\PoNumber
 * @author    Ankitdev
 */

declare(strict_types=1);

namespace Ankitdev\PoNumber\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Ankitdev\PoNumber\Api\Data\PoNumberInterface;

/**
 * Class PoNumber
 *
 * @category Model/Data
 * @package  Ankitdev\PoNumber\Model\Data
 */
class PoNumber extends AbstractExtensibleObject implements PoNumberInterface
{

    /**
     * Get checkout purchase order number
     *
     * @return string|null
     */
    public function getCheckoutPurchaseOrderNo()
    {
        return $this->_get(self::CHECKOUT_PURCHASE_ORDER_NO);
    }

    /**
     * Set checkout purchase order number
     *
     * @param string|null $checkoutPurchaseOrderNo Purchase order number
     *
     * @return PoNumberInterface
     */
    public function setCheckoutPurchaseOrderNo(string $checkoutPurchaseOrderNo = null)
    {
        return $this->setData(self::CHECKOUT_PURCHASE_ORDER_NO, $checkoutPurchaseOrderNo);
    }
}
