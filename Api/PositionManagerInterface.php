<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */
namespace Dadolun\ThemeLayoutBlock\Api;

/**
 * Interface PositionManagerInterface
 * @package Dadolun\ThemeLayoutBlock\Api
 */
interface PositionManagerInterface
{

    /**
     * @param string $position
     * @param mixed $block
     * @return mixed
     */
    public function toHtml($position, $block);

}
