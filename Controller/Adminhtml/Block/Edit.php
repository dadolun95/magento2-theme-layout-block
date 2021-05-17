<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */
namespace Dadolun\ThemeLayoutBlock\Controller\Adminhtml\Block;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Dadolun\ThemeLayoutBlock\Api\ThemeLayoutBlockRepositoryInterface;
use Dadolun\ThemeLayoutBlock\Api\Data\ThemeLayoutBlockInterfaceFactory;
use Magento\Framework\App\ObjectManager;

/**
 *  Edit product
 */
class Edit extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    /**
     * Array of actions which can be processed without secret key validation
     *
     * @var array
     */
    protected $_publicActions = ['edit'];

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var ThemeLayoutBlockRepositoryInterface
     */
    protected $themeLayoutBlockRepository;

    /**
     * @var ThemeLayoutBlockInterfaceFactory
     */
    protected $themeLayoutBlockInterfaceFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * Edit constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param ThemeLayoutBlockRepositoryInterface $themeLayoutBlockRepository
     * @param ThemeLayoutBlockInterfaceFactory $themeLayoutBlockInterfaceFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Store\Model\StoreManagerInterface|null $storeManager
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        ThemeLayoutBlockRepositoryInterface $themeLayoutBlockRepository,
        ThemeLayoutBlockInterfaceFactory $themeLayoutBlockInterfaceFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Store\Model\StoreManagerInterface $storeManager = null
    ) {
        parent::__construct($context);
        $this->registry = $registry;
        $this->resultPageFactory = $resultPageFactory;
        $this->storeManager = $storeManager ?: ObjectManager::getInstance()
            ->get(\Magento\Store\Model\StoreManagerInterface::class);
        $this->themeLayoutBlockRepository = $themeLayoutBlockRepository;
        $this->themeLayoutBlockInterfaceFactory = $themeLayoutBlockInterfaceFactory;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $themeLayoutBlockId = (int) $this->getRequest()->getParam('row_id');
        if ($themeLayoutBlockId) {
            try {
                $themeLayoutBlock = $this->themeLayoutBlockRepository->getById($themeLayoutBlockId);
                $this->registry->register('themelayout_block', $themeLayoutBlock);
            } catch (\Exception $e) {
                $resultRedirect = $this->resultRedirectFactory->create();
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('themelayout/block/');
            }

            if ($themeLayoutBlockId && !$themeLayoutBlock->getId() || $themeLayoutBlockId == 0) {
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                $this->messageManager->addErrorMessage(__('This theme layout block doesn\'t exist.'));
                return $resultRedirect->setPath('themelayout/block/');
            }
        } else {
            $themeLayoutBlock = $this->themeLayoutBlockInterfaceFactory->create();
            $this->registry->register('themelayout_block', $themeLayoutBlock);
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->addHandle('themelayout_block_edit');
        $resultPage->setActiveMenu('Dadolun_ThemeLayoutBlock::theme_layout_block');
        $resultPage->getConfig()->getTitle()->prepend(__('Theme Layout Block'));

        return $resultPage;
    }

    /**
     * Theme access rights checking
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dadolun_ThemeLayoutBlock::theme_layout_block');
    }
}
