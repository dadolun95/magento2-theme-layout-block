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
use Magento\Backend\App\Action;
use Dadolun\ThemeLayoutBlock\Api\ThemeLayoutBlockRepositoryInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Delete
 * @package Dadolun\ThemeLayoutBlock\Controller\Adminhtml\Block
 */
class Delete extends \Magento\Backend\App\Action implements HttpGetActionInterface
{

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Dadolun\ThemeLayoutBlock\Api\ThemeLayoutBlockRepositoryInterface;
     */
    private $themeLayoutBlockRepository;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param ThemeLayoutBlockRepositoryInterface|null $themeLayoutBlockRepository
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        ThemeLayoutBlockRepositoryInterface $themeLayoutBlockRepository
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->themeLayoutBlockRepository = $themeLayoutBlockRepository;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if (isset($data['row_id'])) {
            try {
                $themeLayoutBlock = $this->themeLayoutBlockRepository->getById($data['row_id']);
                $this->themeLayoutBlockRepository->delete($themeLayoutBlock);
                $this->dataPersistor->clear('themelayout_block');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage(__('This theme layout block no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            return $resultRedirect->setPath('*/*/');
        }
        return $resultRedirect->setPath('*/*/');
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
