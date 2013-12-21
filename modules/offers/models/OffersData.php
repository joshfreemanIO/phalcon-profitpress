<?php

/**
 * Contains the OffersData class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Offers\Models
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Offers\Models;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Offers\Models
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class OffersData extends \ProfitPress\Components\BaseModel
{

    /**
     * @var integer
     *
     */
    protected $offer_data_id;

    /**
     * @var integer
     *
     */
    protected $offer_id;

    /**
     * @var string
     *
     */
    protected $offer_data_type;

    /**
     * @var string
     *
     */
    protected $offer_data_value;


    /**
     * Method to set the value of field offer_data_id
     *
     * @param integer $offer_data_id
     */
    public function setOfferDataId($offer_data_id)
    {
        $this->offer_data_id = $offer_data_id;
    }

    /**
     * Method to set the value of field offer_id
     *
     * @param integer $offer_id
     */
    public function setOfferId($offer_id)
    {
        $this->offer_id = $offer_id;
    }

    /**
     * Method to set the value of field offer_data_type
     *
     * @param string $offer_data_type
     */
    public function setOfferDataType($offer_data_type)
    {
        $this->offer_data_type = $offer_data_type;
    }

    /**
     * Method to set the value of field offer_data_value
     *
     * @param string $offer_data_value
     */
    public function setOfferDataValue($offer_data_value)
    {
        $this->offer_data_value = $offer_data_value;
    }


    /**
     * Returns the value of field offer_data_id
     *
     * @return integer
     */
    public function getOfferDataId()
    {
        return $this->offer_data_id;
    }

    /**
     * Returns the value of field offer_id
     *
     * @return integer
     */
    public function getOfferId()
    {
        return $this->offer_id;
    }

    /**
     * Returns the value of field offer_data_type
     *
     * @return string
     */
    public function getOfferDataType()
    {
        return $this->offer_data_type;
    }

    /**
     * Returns the value of field offer_data_value
     *
     * @return string
     */
    public function getOfferDataValue()
    {
        return $this->offer_data_value;
    }

    /**
     * Initializer method for model.
     */
    public function initialize()
    {
        $this->belongsTo("offer_id", "Offers", "offer_id");
    }


}
