<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */
namespace Dadolun\ThemeLayoutBlock\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use \Dadolun\ThemeLayoutBlock\Api\Data\ThemeLayoutBlockInterface;
use \Dadolun\ThemeLayoutBlock\Api\ThemeLayoutBlockRepositoryInterface;
use \Dadolun\ThemeLayoutBlock\Api\ThemeLayoutBlockResourceInterface;
use \Dadolun\ThemeLayoutBlock\Model\ResourceModel\ThemeLayoutBlock\CollectionFactory as ThemeLayoutBlockCollectionFactory;

/**
 * Class ThemeLayoutBlockRepository
 * @package Dadolun\ThemeLayoutBlock\Model
 */
class ThemeLayoutBlockRepository implements ThemeLayoutBlockRepositoryInterface {

    /**
     * @var \Dadolun\ThemeLayoutBlock\Api\Data\ThemeLayoutBlockInterfaceFactory|ThemeLayoutBlockInterfaceFactory
     */
    protected $themeLayoutBlockFactory;

    /**
     * @var ThemeLayoutBlockCollectionFactory
     */
    protected $themeLayoutBlockCollectionFactory;

    /**
     * @var ThemeLayoutBlockResourceInterface
     */
    protected $themeLayoutBlockResource;

    /**
     * ThemeLayoutBlockRepository constructor.
     * @param \Dadolun\ThemeLayoutBlock\Api\Data\ThemeLayoutBlockInterfaceFactory $themeLayoutBlockFactory
     * @param ThemeLayoutBlockCollectionFactory $themeLayoutBlockCollectionFactory
     * @param ThemeLayoutBlockResourceInterface $themeLayoutBlockResource
     */
    public function __construct(
        \Dadolun\ThemeLayoutBlock\Api\Data\ThemeLayoutBlockInterfaceFactory $themeLayoutBlockFactory,
        ThemeLayoutBlockCollectionFactory $themeLayoutBlockCollectionFactory,
        ThemeLayoutBlockResourceInterface $themeLayoutBlockResource
    ){
        $this->themeLayoutBlockFactory = $themeLayoutBlockFactory;
        $this->themeLayoutBlockCollectionFactory = $themeLayoutBlockCollectionFactory;
        $this->themeLayoutBlockResource = $themeLayoutBlockResource;
    }

    /**
     * @param $themeLayoutBlockId
     * @return \Dadolun\ThemeLayoutBlock\Api\Data\ThemeLayoutBlockInterface|ResourceModel\ThemeLayoutBlock\Collection|null
     * @throws NoSuchEntityException
     */
    public function getById($themeLayoutBlockId)
    {
        $themeLayoutBlock = $this->themeLayoutBlockFactory->create();
        $themeLayoutBlock->load($themeLayoutBlockId);
        if (!$themeLayoutBlock->getId()) {
            throw new NoSuchEntityException(
                __("The layout block that was requested doesn't exist. Verify the id and try again.")
            );
        }
        return $themeLayoutBlock;
    }

    /**
     * @param string $code
     * @param string $layoutHandle
     * @return \Magento\Framework\DataObject|ThemeLayoutBlockInterface[]|null
     */
    public function getByCodeAndLayoutHandle($code, $layoutHandle)
    {
        /**
         * @var \Dadolun\ThemeLayoutBlock\Model\ResourceModel\ThemeLayoutBlock\Collection $themeLayoutBlockCollection
         */
        $themeLayoutBlockCollection = $this->themeLayoutBlockCollectionFactory->create();
        return $themeLayoutBlockCollection
            ->addFieldToFilter('position', $code)
            ->addFieldToFilter('layout_handle', $layoutHandle)
            ->getItems();
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $themeLayoutBlock
     * @return \Magento\Framework\Model\AbstractModel|ThemeLayoutBlockInterface|null
     * @throws CouldNotSaveException
     */
    public function save(\Magento\Framework\Model\AbstractModel $themeLayoutBlock)
    {
        try {
            $this->themeLayoutBlockResource->save($themeLayoutBlock);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __($e->getMessage()),
                $e
            );
        }
        return $themeLayoutBlock;
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $themeLayoutBlock
     * @throws \Magento\Framework\Exception\StateException
     */
    public function delete(\Magento\Framework\Model\AbstractModel $themeLayoutBlock)
    {
        try {
            $this->themeLayoutBlockResource->delete($themeLayoutBlock);
        }  catch (\Exception $e) {
            throw new \Magento\Framework\Exception\StateException(
                __('The "%1" layout block couldn\'t be removed.', $themeLayoutBlock->getId()),
                $e
            );
        }
    }
}
