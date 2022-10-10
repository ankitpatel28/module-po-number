<?php
/**
 * @package   Ankitdev\PoNumber
 * @author    Ankitdev
 */

declare(strict_types=1);

namespace Ankitdev\PoNumber\Block\Order;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use Magento\Sales\Model\Order;
use Ankitdev\PoNumber\Api\Data\PoNumberInterface;
use Ankitdev\PoNumber\Api\PoNumberRepositoryInterface;

/**
 * Class PoNumber
 *
 * @category Block/Order
 * @package  Ankitdev\PoNumber\Block
 */
class PoNumber extends Template
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $coreRegistry = null;

    /**
     * PoNumberRepositoryInterface
     *
     * @var PoNumberRepositoryInterface
     */
    protected $PoNumberRepository;

    /**
     * PoNumber constructor.
     *
     * @param Context                         $context                Context
     * @param Registry                        $registry               Registry
     * @param PoNumberRepositoryInterface $PoNumberRepository PoNumberRepositoryInterface
     * @param array                           $data                   Data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        PoNumberRepositoryInterface $PoNumberRepository,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        $this->PoNumberRepository = $PoNumberRepository;
        $this->_isScopePrivate = true;
        $this->_template = 'order/view/po_number.phtml';
        parent::__construct($context, $data);
    }

    /**
     * Get current order
     *
     * @return Order
     */
    public function getOrder() : Order
    {
        return $this->coreRegistry->registry('current_order');
    }

    /**
     * Get checkout Po number
     *
     * @param Order $order Order
     *
     * @return PoNumberInterface
     */
    public function getPoNumber(Order $order)
    {
        return $this->PoNumberRepository->getPoNumber($order);
    }
}
