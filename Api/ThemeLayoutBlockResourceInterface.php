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
 * Interface ThemeLayoutBlockResourceInterface
 * @package Dadolun\ThemeLayoutBlock\Api
 */
interface ThemeLayoutBlockResourceInterface
{
    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return mixed
     */
    public function save(\Magento\Framework\Model\AbstractModel $object);

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @param $value
     * @param null $field
     * @return mixed
     */
    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null);

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return mixed
     */
    public function delete(\Magento\Framework\Model\AbstractModel $object);
}
