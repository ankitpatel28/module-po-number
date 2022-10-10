<?php
/**
 * @package   Ankitdev\PoNumber
 * @author    Ankitdev
 */

declare(strict_types=1);

namespace Ankitdev\PoNumber\Model;

use Magento\Quote\Model\QuoteIdMaskFactory;
use Ankitdev\PoNumber\Api\PoNumberGuestRepositoryInterface;
use Ankitdev\PoNumber\Api\PoNumberRepositoryInterface;
use Ankitdev\PoNumber\Api\Data\PoNumberInterface;

/**
 * Class PoNumberGuestRepository
 *
 * @category Model/Repository
 * @package  Ankitdev\PoNumber\Model
 */
class PoNumberGuestRepository implements PoNumberGuestRepositoryInterface
{
    /**
     * @var QuoteIdMaskFactory
     */
    protected $quoteIdMaskFactory;

    /**
     * @var PoNumberRepositoryInterface
     */
    protected $PoNumberRepository;

    /**
     * @param QuoteIdMaskFactory              $quoteIdMaskFactory
     * @param PoNumberRepositoryInterface $PoNumberRepository
     */
    public function __construct(
        QuoteIdMaskFactory $quoteIdMaskFactory,
        PoNumberRepositoryInterface $PoNumberRepository
    ) {
        $this->quoteIdMaskFactory     = $quoteIdMaskFactory;
        $this->PoNumberRepository = $PoNumberRepository;
    }

    /**
     * @param string                $cartId
     * @param PoNumberInterface $PoNumber
     * @return PoNumberInterface
     */
    public function savePoNumber(
        string $cartId,
        PoNumberInterface $PoNumber
    ): PoNumberInterface {
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        return $this->PoNumberRepository->savePoNumber((int)$quoteIdMask->getQuoteId(), $PoNumber);
    }
}
