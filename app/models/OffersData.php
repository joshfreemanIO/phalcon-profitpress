<?php


class OffersData extends \Phalcon\Mvc\Model 
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
