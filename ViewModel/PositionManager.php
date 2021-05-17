<?php
/**
 * Dadolun ThemeLayoutBlock
 *
 * @package   Dadolun_ThemeLayoutBlock
 * @author    Dadolun
 * @copyright Copyright (c) 2021 dadolun@gmail.com (https://github.com/dadolun95)
 */

namespace Dadolun\ThemeLayoutBlock\ViewModel;

use \Dadolun\ThemeLayoutBlock\Api\PositionManagerInterface;
use \Dadolun\ThemeLayoutBlock\Api\BlockRetrieverInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;


/**
 * Class PositionManager
 */
class PositionManager implements PositionManagerInterface, ArgumentInterface
{
    /**
     * @var BlockRetrieverInterface
     */
    protected $retriever;

    /**
     * PositionManager constructor.
     * @param BlockRetrieverInterface $retriever
     */
    public function __construct(BlockRetrieverInterface $retriever)
    {
        $this->retriever = $retriever;
    }

    /**
     * @param string $position
     * @param mixed $block
     * @return mixed
     */
    public function toHtml($position, $block)
    {
        return $this->retriever->getBlock($position, $block);
    }
}
