<?php
/**
 * @package   Ankitdev\PoNumber
 * @author    Ankitdev
 */

declare(strict_types=1);

namespace Ankitdev\PoNumber\Plugin\Block\Adminhtml;

use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Block\Adminhtml\Order\View\Info;
use Ankitdev\PoNumber\Api\PoNumberRepositoryInterface;

/**
 * Class PoNumberRepository
 *
 * @category Adminhtml/Plugin
 * @package  Ankitdev\PoNumber\Plugin
 */
class PoNumber
{
    /**
     * PoNumberRepositoryInterface
     *
     * @var PoNumberRepositoryInterface
     */
    protected $PoNumberRepository;

    /**
     * PoNumber constructor.
     *
     * @param PoNumberRepositoryInterface $PoNumberRepository Repository Interface
     */
    public function __construct(PoNumberRepositoryInterface $PoNumberRepository)
    {
        $this->PoNumberRepository = $PoNumberRepository;
    }

    /**
     * Modify after to html.
     *
     * @param Info   $subject Info
     * @param string $result  Result
     *
     * @return string
     * @throws LocalizedException
     */
    public function afterToHtml(Info $subject, $result) {
        $block = $subject->getLayout()->getBlock('order_po_number');
        if ($block !== false) {
            $block->setOrderPoNumber(
                $this->PoNumberRepository->getPoNumber($subject->getOrder())
            );
            $result = $result . $block->toHtml();
        }

        return $result;
    }
}
