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
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;

/**
 * Class CategoryBlockRetriever
 * @package Dadolun\ThemeLayoutBlock\Model
 */
class CategoryBlockRetriever implements BlockRetrieverInterface
{

    /**
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepository;

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
     * @param CategoryRepositoryInterface $categoryRepository
     * @param BlockRepositoryInterface $blockRepository
     * @param MessageManagerInterface $messageManager
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        BlockRepositoryInterface $blockRepository,
        MessageManagerInterface $messageManager
    )
    {
        $this->categoryRepository = $categoryRepository;
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
             * @var \Magento\Catalog\Block\Category\View $block
             */
            $categoryId = $block->getCurrentCategory()->getId();
            $category = $this->categoryRepository->get($categoryId);
            if ($category->getData($code)) {
                $cmsBlock = $this->blockRepository->getById($category->getData($code));
                return $cmsBlock->getContent();
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An error occurred loading the block on this position: ') . $code);
        }
        return '';
    }
}
