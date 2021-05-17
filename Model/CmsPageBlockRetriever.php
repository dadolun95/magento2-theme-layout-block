<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */

namespace Dadolun\ThemeLayoutBlock\Model;

use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;
use \Dadolun\ThemeLayoutBlock\Api\BlockRetrieverInterface;
use Magento\Cms\Model\Page;

/**
 * Class CmsPageBlockRetriever
 * @package Dadolun\ThemeLayoutBlock\Model
 */
class CmsPageBlockRetriever implements BlockRetrieverInterface
{

    /**
     * @var PageRepositoryInterface
     */
    protected $pageRepository;

    /**
     * @var BlockRepositoryInterface
     */
    protected $blockRepository;

    /**
     * @var MessageManagerInterface
     */
    protected $messageManager;

    /**
     * @var Page
     */
    protected $page;

    /**
     * CmsPageBlockRetriever constructor.
     * @param PageRepositoryInterface $pageRepository
     * @param BlockRepositoryInterface $blockRepository
     * @param MessageManagerInterface $messageManager
     * @param Page $page
     */
    public function __construct(
        PageRepositoryInterface $pageRepository,
        BlockRepositoryInterface $blockRepository,
        MessageManagerInterface $messageManager,
        Page $page
    )
    {
        $this->pageRepository = $pageRepository;
        $this->blockRepository = $blockRepository;
        $this->messageManager = $messageManager;
        $this->page = $page;
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
            $pageId = $block->getRequest()->getParam('page_id') ?? $block->getRequest()->getParam('id');
            if ($pageId === null) {
                $pageId = $this->page->noRoutePage()->getId();
            }
            $cmsPage = $this->pageRepository->getById($pageId);
            if ($cmsPage->getData($code)) {
                $cmsBlock = $this->blockRepository->getById($cmsPage->getData($code));
                return $cmsBlock->getContent();
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An error occurred loading the block on this position: ') . $code);
        }
        return '';
    }
}
