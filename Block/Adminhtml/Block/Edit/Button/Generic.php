<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */

namespace Dadolun\ThemeLayoutBlock\Block\Adminhtml\Block\Edit\Button;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\UiComponent\Context;
use Magento\Backend\Block\Widget\Context as WidgetContext;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Dadolun\ThemeLayoutBlock\Api\ThemeLayoutBlockRepositoryInterface;

/**
 * Class Generic
 * @package Dadolun\ThemeLayoutBlock\Block\Adminhtml\Block\Edit\Button
 */
class Generic implements ButtonProviderInterface
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var WidgetContext
     */
    protected $widgetContext;

    /**
     * @var ThemeLayoutBlockRepositoryInterface
     */
    protected $themeLayoutBlockRepository;

    /**
     * Generic constructor.
     * @param Context $context
     * @param WidgetContext $widgetContext
     * @param ThemeLayoutBlockRepositoryInterface $themeLayoutBlockRepository
     */
    public function __construct(
        Context $context,
        WidgetContext $widgetContext,
        ThemeLayoutBlockRepositoryInterface $themeLayoutBlockRepository
    )
    {
        $this->context = $context;
        $this->widgetContext = $widgetContext;
        $this->themeLayoutBlockRepository = $themeLayoutBlockRepository;
    }

    /**
     * Return Theme Layout Block ID
     *
     * @return int|null
     */
    public function getBlockId()
    {
        if ($this->widgetContext->getRequest()->getParam('row_id')) {
            try {
                return $this->themeLayoutBlockRepository->getById(
                    $this->widgetContext->getRequest()->getParam('row_id')
                )->getId();
            } catch (NoSuchEntityException $e) {
            }
        }
        return null;
    }


    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrl($route, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function getButtonData()
    {
        return [];
    }
}
