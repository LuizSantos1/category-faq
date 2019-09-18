<?php
/**
 * Question Collection
 *
 * @category   Prestafy
 * @package    Prestafy_Faq
 * @author     Andresa Martins <contact@andresa.dev>
 * @copyright  Copyright (c) 2019 Prestafy eCommerce Solutions (https://www.prestafy.com.br)
 * @license    http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */
namespace Prestafy\Faq\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Prestafy\Faq\Model\Question;
use Prestafy\Faq\Model\ResourceModel\Category;
use Prestafy\Faq\Model\ResourceModel\Question as QuestionResource;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    public function _construct()
    {
        $this->_init(
            Question::class,
            QuestionResource::class
        );
    }

    /**
     * Initialize Select Object
     *
     * @return $this|AbstractCollection|void
     */
    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()->joinLeft(
            ['categories' => $this->getTable(Category::TABLE_NAME)],
            'main_table.category_id = categories.id',
            ['name', 'id']
        )->columns(
            [
                'categoryname' => 'categories.name',
                'id'           => 'main_table.id',
                'created_at'   => 'main_table.created_at',
                'updated_at'   => 'main_table.updated_at',
                'status'       => 'main_table.status'
            ]
        );

        return $this;
    }
}