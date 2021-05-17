<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */

namespace Dadolun\ThemeLayoutBlock\Setup\Patch\Data;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Catalog\Api\Data\ProductAttributeInterface;

/**
 * Class AddProductPositionAttributes
 * @package Dadolun\ThemeLayoutBlock\Setup\Patch\Data
 */
class AddProductPositionAttributes implements DataPatchInterface
{
    /** @var ModuleDataSetupInterface */
    private $moduleDataSetup;

    /** @var EavSetupFactory */
    private $eavSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @return array|string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return array|string[]
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @return DataPatchInterface|void
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Zend_Validate_Exception
     */
    public function apply()
    {

        $this->moduleDataSetup->getConnection()->startSetup();

        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $positionAttributes = [
            'position_main_top' => [
                'order' => 70,
                'label' => 'CMS Block Main Top'
            ],
            'position_top_a' => [
                'order' => 71,
                'label' => 'CMS Block Top A'
            ],
            'position_top_b' => [
                'order' => 72,
                'label' => 'CMS Block Top B'
            ],
            'position_top_c' => [
                'order' => 73,
                'label' => 'CMS Block Top C'
            ],
            'position_main_bottom' => [
                'order' => 74,
                'label' => 'CMS Block Main Bottom'
            ],
            'position_bottom_a' => [
                'order' => 75,
                'label' => 'CMS Block Bottom A'
            ],
            'position_bottom_b' => [
                'order' => 76,
                'label' => 'CMS Block Bottom B'
            ],
            'position_bottom_c' => [
                'order' => 77,
                'label' => 'CMS Block Bottom C'
            ],
        ];

        foreach ($positionAttributes as $attributeCode => $data) {
            $eavSetup->addAttribute(
                ProductAttributeInterface::ENTITY_TYPE_CODE,
                $attributeCode,
                [
                    'type' => 'int',
                    'label' => $data['label'],
                    'input' => 'select',
                    'source' => \Magento\Catalog\Model\Category\Attribute\Source\Page::class,
                    'required' => false,
                    'sort_order' => $data['order'],
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'group' => 'Custom Design'
                ]
            );
        }

        $this->moduleDataSetup->getConnection()->endSetup();
    }
}
