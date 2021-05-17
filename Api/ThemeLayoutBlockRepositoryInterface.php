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
 * Interface ThemeLayoutBlockRepositoryInterface
 * @package Dadolun\ThemeLayoutBlock\Api
 */
interface ThemeLayoutBlockRepositoryInterface
{
    /**
     * @param \Magento\Framework\Model\AbstractModel $themeLayoutBlock
     * @return \Dadolun\ThemeLayoutBlock\Api\Data\ThemeLayoutBlockInterface|null
     */
    public function save(\Magento\Framework\Model\AbstractModel $themeLayoutBlock);

    /**
     * @param $themeLayoutBlockId
     * @return \Dadolun\ThemeLayoutBlock\Api\Data\ThemeLayoutBlockInterface|null
     */
    public function getById($themeLayoutBlockId);

    /**
     * @param $code
     * @param $layoutHandle
     * @return \Dadolun\ThemeLayoutBlock\Api\Data\ThemeLayoutBlockInterface|null
     */
    public function getByCodeAndLayoutHandle($code, $layoutHandle);

    /**
     * @param \Magento\Framework\Model\AbstractModel $themeLayoutBlock
     * @return void
     */
    public function delete(\Magento\Framework\Model\AbstractModel $themeLayoutBlock);
}
