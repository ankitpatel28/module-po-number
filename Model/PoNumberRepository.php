<?php
/**
 * @package   Ankitdev\PoNumber
 * @author    Ankitdev
 */

declare(strict_types=1);

namespace Ankitdev\PoNumber\Model;

use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Sales\Model\Order;
use Ankitdev\PoNumber\Api\PoNumberRepositoryInterface;
use Ankitdev\PoNumber\Api\Data\PoNumberInterface;

/**
 * Class PoNumberRepository
 *
 * @category Model/Repository
 * @package  Ankitdev\PoNumber\Model
 */
class PoNumberRepository implements PoNumberRepositoryInterface
{
    /**
     * Quote repository.
     *
     * @var CartRepositoryInterface
     */
    protected $cartRepository;

    /**
     * ScopeConfigInterface
     *
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * PoNumberInterface
     *
     * @var PoNumberInterface
     */
    protected $PoNumber;

    /**
     * PoNumberRepository constructor.
     *
     * @param CartRepositoryInterface $cartRepository CartRepositoryInterface
     * @param ScopeConfigInterface    $scopeConfig    ScopeConfigInterface
     * @param PoNumberInterface   $PoNumber   PoNumberInterface
     */
    public function __construct(
        CartRepositoryInterface $cartRepository,
        ScopeConfigInterface $scopeConfig,
        PoNumberInterface $PoNumber
    ) {
        $this->cartRepository = $cartRepository;
        $this->scopeConfig    = $scopeConfig;
        $this->PoNumber   = $PoNumber;
    }
    /**
     * Save checkout Po number
     *
     * @param int                                                      $cartId       Cart id
     * @param \Ankitdev\PoNumber\Api\Data\PoNumberInterface $PoNumber Po number
     *
     * @return \Ankitdev\PoNumber\Api\Data\PoNumberInterface
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function savePoNumber(
        int $cartId,
        PoNumberInterface $PoNumber
    ): PoNumberInterface {
        $cart = $this->cartRepository->getActive($cartId);
        if (!$cart->getItemsCount()) {
            throw new NoSuchEntityException(__('Cart %1 is empty', $cartId));
        }

        try {
            $cart->setData(
                PoNumberInterface::CHECKOUT_PURCHASE_ORDER_NO,
                $PoNumber->getCheckoutPurchaseOrderNo()
            );

            $this->cartRepository->save($cart);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Custom order data could not be saved!'));
        }

        return $PoNumber;
    }

    /**
     * Get checkout Po number by given order id
     *
     * @param Order $order Order
     *
     * @return PoNumberInterface
     * @throws NoSuchEntityException
     */
    public function getPoNumber(Order $order): PoNumberInterface
    {
        if (!$order->getId()) {
            throw new NoSuchEntityException(__('Order %1 does not exist', $order));
        }

        $this->PoNumber->setCheckoutPurchaseOrderNo(
            $order->getData(PoNumberInterface::CHECKOUT_PURCHASE_ORDER_NO)
        );

        return $this->PoNumber;
    }
}
