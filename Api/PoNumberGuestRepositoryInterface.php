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
 * Interface PoNumberGuestRepositoryInterface
 *
 * @category Api/Interface
 * @package  Ankitdev\PoNumber\Api
 */
interface PoNumberGuestRepositoryInterface
{
    /**
     * Save checkout Po number
     *
     * @param string                                                   $cartId       Guest Cart id
     * @param \Ankitdev\PoNumber\Api\Data\PoNumberInterface $PoNumber Po number
     *
     * @return \Ankitdev\PoNumber\Api\Data\PoNumberInterface
     */
    public function savePoNumber(
        string $cartId,
        PoNumberInterface $PoNumber
    ): PoNumberInterface;
}
