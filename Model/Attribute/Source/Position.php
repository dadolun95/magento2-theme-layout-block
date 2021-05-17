<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */

namespace Dadolun\ThemeLayoutBlock\Model\Attribute\Source;

/**
 * Class Position
 * @package Dadolun\ThemeLayoutBlock\Model\Attribute\Source
 */
class Position implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => 'position_main_top',
                'label' => __('Main Top'),
            ],
            [
                'value' => 'position_top_a',
                'label' => __('Top A'),
            ],
            [
                'value' => 'position_top_b',
                'label' => __('Top B'),
            ],
            [
                'value' => 'position_top_c',
                'label' => __('Top C'),
            ],
            [
                'value' => 'position_main_bottom',
                'label' => __('Main Bottom'),
            ],
            [
                'value' => 'position_bottom_a',
                'label' => __('Bottom A'),
            ],
            [
                'value' => 'position_bottom_b',
                'label' => __('Bottom B'),
            ],
            [
                'value' => 'position_bottom_c',
                'label' => __('Bottom C'),
            ]
        ];
    }
}
