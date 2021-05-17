<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */

namespace Dadolun\ThemeLayoutBlock\Controller\Adminhtml\Block;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action;
use Dadolun\ThemeLayoutBlock\Api\ThemeLayoutBlockRepositoryInterface;
use Dadolun\ThemeLayoutBlock\Api\Data\ThemeLayoutBlockInterfaceFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Save
 * @package Dadolun\ThemeLayoutBlock\Controller\Adminhtml\Block
 */
class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Dadolun\ThemeLayoutBlock\Api\Data\ThemeLayoutBlockInterfaceFactory
     */
    private $themeLayoutBlockFactory;

    /**
     * @var \Dadolun\ThemeLayoutBlock\Api\ThemeLayoutBlockRepositoryInterface;
     */
    private $themeLayoutBlockRepository;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param ThemeLayoutBlockInterfaceFactory|null $themeLayoutBlockFactory
     * @param ThemeLayoutBlockRepositoryInterface|null $themeLayoutBlockRepository
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        ThemeLayoutBlockInterfaceFactory $themeLayoutBlockFactory,
        ThemeLayoutBlockRepositoryInterface $themeLayoutBlockRepository
    )
    {
        $this->dataPersistor = $dataPersistor;
        $this->themeLayoutBlockFactory = $themeLayoutBlockFactory;
        $this->themeLayoutBlockRepository = $themeLayoutBlockRepository;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        /** @var \Dadolun\ThemeLayoutBlock\Api\Data\ThemeLayoutBlockInterface $model */
        $themeLayoutBlock = $this->themeLayoutBlockFactory->create();

        if ($data) {
            if (isset($data['row_id']) && $data['row_id'] !== "") {
                try {
                    $themeLayoutBlock = $this->themeLayoutBlockRepository->getById($data['row_id']);
                    $data['row_id'] = $themeLayoutBlock->getId();
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This theme layout block no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                unset($data['row_id']);
            }
            $themeLayoutBlock->setData($data);
            try {
                $themeLayoutBlock = $this->themeLayoutBlockRepository->save($themeLayoutBlock);
                $this->messageManager->addSuccessMessage(__('You saved the theme layout block.'));
                return $resultRedirect->setPath(
                    '*/*/edit',
                    [
                        'row_id' => $themeLayoutBlock->getId(),
                        '_current' => true
                    ]
                );
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
            } catch (\Throwable $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the theme layout block.'));
            }

            $this->dataPersistor->set('themelayout_block', $data);
            return $resultRedirect->setPath('*/*/edit', ['row_id' => $this->getRequest()->getParam('row_id')]);
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
