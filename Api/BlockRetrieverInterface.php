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
 * Interface BlockRetrieverInterface
 * @package Dadolun\ThemeLayoutBlock\Api
 */
interface BlockRetrieverInterface
{

    /**
     * @param string $code
     * @param integer $entityId
     * @return mixed
     */
    public function getBlock($code, $entityId);

}
