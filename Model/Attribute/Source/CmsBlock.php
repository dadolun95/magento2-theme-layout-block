<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */

namespace Dadolun\ThemeLayoutBlock\Model\Attribute\Source;

use Magento\Cms\Model\ResourceModel\Block\CollectionFactory as CmsBlockCollectionFactory;

/**
 * Class CmsBlock
 * @package Dadolun\ThemeLayoutBlock\Model\Attribute\Source
 */
class CmsBlock implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var CmsBlockCollectionFactory
     */
    protected $cmsBlockCollectionFactory;

    /**
     * Constructor
     *
     * @param CmsBlockCollectionFactory $cmsBlockCollectionFactory
     */
    public function __construct(CmsBlockCollectionFactory $cmsBlockCollectionFactory)
    {
        $this->cmsBlockCollectionFactory = $cmsBlockCollectionFactory;
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        return $this->cmsBlockCollectionFactory->create()->toOptionArray();
    }
}
