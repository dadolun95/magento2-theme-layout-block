<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */
namespace Dadolun\ThemeLayoutBlock\Model\ResourceModel\ThemeLayoutBlock;

use Dadolun\ThemeLayoutBlock\Model\ResourceModel\ThemeLayoutBlock as ThemeLayoutBlockResource;
use Dadolun\ThemeLayoutBlock\Model\ThemeLayoutBlock;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Dadolun\ThemeLayoutBlock\Model\ResourceModel\ThemeLayoutBlock
 */
class Collection extends AbstractCollection {

    protected function _construct() {
        $this->_init(
            ThemeLayoutBlock::class,
            ThemeLayoutBlockResource::class
        );
    }
}
