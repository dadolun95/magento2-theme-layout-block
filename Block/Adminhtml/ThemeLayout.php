<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */
namespace Dadolun\ThemeLayoutBlock\Block\Adminhtml;

/**
 * Class ThemeLayout
 * @package Dadolun\ThemeLayoutBlock\Block\Adminhtml
 */
class ThemeLayout extends \Magento\Backend\Block\Widget\Container
{
    /**
     * Prepare button and grid
     *
     * @return \Magento\Catalog\Block\Adminhtml\Product
     */
    protected function _prepareLayout()
    {
        $addButtonProps = [
            'id' => 'add_new_custom_block',
            'label' => __('Add New Custom Block'),
            'class' => 'primary',
            'button_class' => '',
            'onclick' => "setLocation('" . $this->_getThemeLayoutCreateUrl() . "')",
            'class_name' => \Magento\Backend\Block\Widget\Button::class
        ];
        $this->buttonList->add('add_new', $addButtonProps);

        return parent::_prepareLayout();
    }

    /**
     * @param string $type
     * @return string
     */
    protected function _getThemeLayoutCreateUrl()
    {
        return $this->getUrl(
            'themelayout/block/new'
        );
    }
}
