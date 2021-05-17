<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */
namespace Dadolun\ThemeLayoutBlock\Model\ResourceModel;

use Dadolun\ThemeLayoutBlock\Api\ThemeLayoutBlockResourceInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class ThemeLayoutBlock
 * @package Dadolun\ThemeLayoutBlock\Model\ResourceModel
 */
class ThemeLayoutBlock extends AbstractDb implements ThemeLayoutBlockResourceInterface {

    protected function _construct() {
        $this->_init('theme_layout_block', 'row_id');
    }
}
