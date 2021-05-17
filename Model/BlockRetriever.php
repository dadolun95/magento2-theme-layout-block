<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */
namespace Dadolun\ThemeLayoutBlock\Model;

use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;
use \Dadolun\ThemeLayoutBlock\Api\ThemeLayoutBlockRepositoryInterface;
use \Dadolun\ThemeLayoutBlock\Api\BlockRetrieverInterface;
use \Magento\Store\Model\StoreManagerInterface;

/**
 * Class BlockRetriever
 * @package Dadolun\ThemeLayoutBlock\Model
 */
class BlockRetriever implements BlockRetrieverInterface
{
    /**
     * @var ThemeLayoutBlockRepositoryInterface
     */
    protected $themeLayoutBlockRepository;

    /**
     * @var BlockRepositoryInterface
     */
    protected $blockRepository;

    /**
     * @var MessageManagerInterface
     */
    protected $messageManager;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * BlockRetriever constructor.
     * @param ThemeLayoutBlockRepositoryInterface $themeLayoutBlockRepository
     * @param BlockRepositoryInterface $blockRepository
     * @param MessageManagerInterface $messageManager
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ThemeLayoutBlockRepositoryInterface $themeLayoutBlockRepository,
        BlockRepositoryInterface $blockRepository,
        MessageManagerInterface $messageManager,
        StoreManagerInterface $storeManager
    )
    {
        $this->themeLayoutBlockRepository = $themeLayoutBlockRepository;
        $this->blockRepository = $blockRepository;
        $this->messageManager = $messageManager;
        $this->storeManager = $storeManager;
    }


    /**
     * @param string $code
     * @param \Magento\Framework\View\Element\Template $block
     * @return mixed|string
     */
    public function getBlock($code, $block)
    {
        $blockContent = '';
        try {
            $layoutHandles = $block->getLayout()->getUpdate()->getHandles();
            foreach($layoutHandles as $layoutHandle) {
                $tmpBlockContent = $this->getBlockByLayoutHandle($code, $layoutHandle);
                if ($tmpBlockContent !== '') {
                    $blockContent = $tmpBlockContent;
                }
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()) . $code);
        }
        return $blockContent;
    }

    /**
     * @param $code
     * @param $layoutHandle
     * @return string|null
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function getBlockByLayoutHandle($code, $layoutHandle) {
        $themeLayoutBlocks = $this->themeLayoutBlockRepository->getByCodeAndLayoutHandle($code, $layoutHandle);
        $currentStoreId = $this->storeManager->getStore()->getId();
        foreach ($themeLayoutBlocks as $themeLayoutBlock) {
            if ($themeLayoutBlock->getId()) {
                $cmsBlock = $this->blockRepository->getById($themeLayoutBlock->getBlockId());
                foreach ($cmsBlock->getStores() as $storeId) {
                    if ((int)$storeId === (int)$currentStoreId || (int)$storeId === 0) {
                        return $cmsBlock->getContent();
                    }
                }
            }
        }
        return '';
    }
}
