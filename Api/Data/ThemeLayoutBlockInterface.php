<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */

namespace Dadolun\ThemeLayoutBlock\Api\Data;

/**
 * Interface ThemeLayoutBlockInterface
 * @package Dadolun\ThemeLayoutBlock\Api\Data
 */
interface ThemeLayoutBlockInterface
{
    const ID = 'row_id';

    const LAYOUT_HANDLE = 'layout_handle';

    const POSITION = 'position';

    const BLOCK_ID = 'block_id';

    /**
     * @return integer
     */
    public function getId();

    /**
     * @return string
     */
    public function getLayoutHandle();

    /**
     * @param $layoutHandle
     * @return ThemeLayoutBlockInterface
     */
    public function setLayoutHandle($layoutHandle);

    /**
     * @return string
     */
    public function getPosition();

    /**
     * @param $position
     * @return ThemeLayoutBlockInterface
     */
    public function setPosition($position);

    /**
     * @return string
     */
    public function getBlockId();

    /**
     * @param $blockId
     * @return ThemeLayoutBlockInterface
     */
    public function setBlockId($blockId);
}
