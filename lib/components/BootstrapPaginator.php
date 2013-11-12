<?php

namespace ProfitPress\Components;

class BootstrapPaginator extends \Phalcon\Paginator\Adapter\Model implements \Phalcon\Paginator\AdapterInterface
{

    /**
     * Adapter constructor
     *
     * @param array $config
     */
    public function __construct($config)
    {
        parent::__construct($config);
    }

    /**
     * Set the current page number
     *
     * @param int $page
     */
    public function setCurrentPage($page)
    {
        parent::setCurrentPage($page);
    }

    /**
     * Returns a slice of the resultset to show in the pagination
     *
     * @return stdClass
     */
    public function getPaginate()
    {
       return parent::getPaginate();
    }
}