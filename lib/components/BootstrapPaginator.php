<?php

/**
 * Contains the BootstrapPaginator class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Components
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

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