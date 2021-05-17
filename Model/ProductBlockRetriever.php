<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */
namespace Dadolun\ThemeLayoutBlock\Model;

use \Dadolun\ThemeLayoutBlock\Api\BlockRetrieverInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;

/**
 * Class ProductBlockRetriever
 * @package Dadolun\ThemeLayoutBlock\Model
 */
class ProductBlockRetriever implements BlockRetrieverInterface
{

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var BlockRepositoryInterface
     */
    protected $blockRepository;

    /**
     * @var MessageManagerInterface
     */
    protected $messageManager;

    /**
     * CategoryBlockRetriever constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param BlockRepositoryInterface $blockRepository
     * @param MessageManagerInterface $messageManager
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        BlockRepositoryInterface $blockRepository,
        MessageManagerInterface $messageManager
    )
    {
        $this->productRepository = $productRepository;
        $this->blockRepository = $blockRepository;
        $this->messageManager = $messageManager;
    }

    /**
     * @param string $code
     * @param mixed $block
     * @return mixed|string|null
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getBlock($code, $block)
    {
        try {
            /**
             * @var \Magento\Catalog\Block\Product\View $block
             */
            $productId = $block->getProduct()->getId();
            $product = $this->productRepository->getById($productId);
            if ($product->getData($code)) {
                $cmsBlock = $this->blockRepository->getById($product->getData($code));
                return $cmsBlock->getContent();
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An error occurred loading the block on this position: ') . $code);
        }
        return '';
    }
}
