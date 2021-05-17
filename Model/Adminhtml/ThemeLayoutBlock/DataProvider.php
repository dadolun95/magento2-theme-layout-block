<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */

namespace Dadolun\ThemeLayoutBlock\Model\Adminhtml\ThemeLayoutBlock;

use Dadolun\ThemeLayoutBlock\Model\ResourceModel\ThemeLayoutBlock\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 * @package Dadolun\ThemeLayoutBlock\Model\Adminhtml\ThemeLayoutBlock
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Dadolun\ThemeLayoutBlock\Model\ResourceModel\ThemeLayoutBlock\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array|null
     */
    protected $loadedData;

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $contactCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $contactCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    )
    {
        $this->dataPersistor = $dataPersistor;
        $this->collection = $contactCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        $items = $this->collection->getItems();
        $this->loadedData = array();
        foreach ($items as $block) {
            $this->loadedData[$block->getId()] = $block->getData();
        }
        $data = $this->dataPersistor->get('themelayout_block');
        if (!empty($data)) {
            $themeLayoutBlock = $this->collection->getNewEmptyItem();
            $themeLayoutBlock->setData($data);
            $this->loadedData[$themeLayoutBlock->getId()] = $themeLayoutBlock->getData();
            $this->dataPersistor->clear('themelayout_block');
        }
        return $this->loadedData;

    }
}
