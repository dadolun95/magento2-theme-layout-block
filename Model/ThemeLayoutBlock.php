<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */

namespace Dadolun\ThemeLayoutBlock\Model;

use Magento\Framework\Model\AbstractModel;
use Dadolun\ThemeLayoutBlock\Api\ThemeLayoutBlockResourceInterface;
use Dadolun\ThemeLayoutBlock\Api\Data\ThemeLayoutBlockInterface;

/**
 * Class ThemeLayoutBlock
 * @package Dadolun\ThemeLayoutBlock\Model
 */
class ThemeLayoutBlock extends AbstractModel implements ThemeLayoutBlockInterface
{

    const ENTITY = 'theme_layout_block';

    /**
     * @var array
     */
    protected $interfaceAttributes = [
        ThemeLayoutBlockInterface::ID,
        ThemeLayoutBlockInterface::LAYOUT_HANDLE,
        ThemeLayoutBlockInterface::POSITION,
        ThemeLayoutBlockInterface::BLOCK_ID
    ];

    protected function _construct()
    {
        $this->_init(ThemeLayoutBlockResourceInterface::class);
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @return string
     */
    public function getLayoutHandle()
    {
        return $this->getData(self::LAYOUT_HANDLE);
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->getData(self::POSITION);
    }

    /**
     * @return integer
     */
    public function getBlockId()
    {
        return $this->getData(self::BLOCK_ID);
    }

    /**
     * @param $layoutHandle
     * @return ThemeLayoutBlock
     */
    public function setLayoutHandle($layoutHandle)
    {
        return $this->setData(self::LAYOUT_HANDLE, $layoutHandle);
    }

    /**
     * @param $position
     * @return ThemeLayoutBlock
     */
    public function setPosition($position)
    {
        return $this->setData(self::POSITION, $position);
    }

    /**
     * @param $blockId
     * @return ThemeLayoutBlock
     */
    public function setBlockId($blockId)
    {
        return $this->setData(self::BLOCK_ID, $blockId);
    }
}
