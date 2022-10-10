<?php
/**
 * @package   Ankitdev\PoNumber
 * @author    Ankitdev
 */

declare(strict_types=1);

namespace Ankitdev\PoNumber\Api;

use Magento\Sales\Model\Order;
use Ankitdev\PoNumber\Api\Data\PoNumberInterface;

/**
 * Interface PoNumberRepositoryInterface
 *
 * @category Api/Interface
 * @package  Ankitdev\PoNumber\Api
 */
interface PoNumberRepositoryInterface
{
    /**
     * Save checkout Po number
     *
     * @param int                                                      $cartId       Cart id
     * @param \Ankitdev\PoNumber\Api\Data\PoNumberInterface $PoNumber Po number
     *
     * @return \Ankitdev\PoNumber\Api\Data\PoNumberInterface
     */
    public function savePoNumber(
        int $cartId,
        PoNumberInterface $PoNumber
    ): PoNumberInterface;

    /**
     * Get checkoug Po number
     *
     * @param Order $order Order
     *
     * @return PoNumberInterface
     */
    public function getPoNumber(Order $order) : PoNumberInterface;
}
