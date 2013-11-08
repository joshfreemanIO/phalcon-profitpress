<?php

namespace ProfitPress\Offers\Models;

class Offers extends \Phalcon\Mvc\Model
{

    /**
     * @var integer
     *
     */
    protected $offer_id;

    /**
     * @var integer
     *
     */
    protected $offer_template_id;

    /**
     * @var string
     *
     */
    protected $date_created;

    /**
     * @var string
     *
     */
    protected $date_expires;

    /**
     * @var string
     *
     */
    protected $offer_data;

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
     * Method to set the value of field offer_template_id
     *
     * @param integer $offer_template_id
     */
    public function setOfferTemplateId($offer_template_id)
    {
        $this->offer_template_id = $offer_template_id;
    }

    /**
     * Method to set the value of field date_created
     *
     * @param string $date_created
     */
    public function setDateCreated($date_created)
    {
        $this->date_created = $date_created;
    }

    /**
     * Method to set the value of field date_expires
     *
     * @param string $date_expires
     */
    public function setDateExpires($date_expires)
    {
        $this->date_expires = $date_expires;
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
     * Returns the value of field offer_template_id
     *
     * @return integer
     */
    public function getOfferTemplateId()
    {
        return $this->offer_template_id;
    }

    /**
     * Returns the value of field date_created
     *
     * @return string
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * Returns the value of field date_expires
     *
     * @return string
     */
    public function getDateExpires()
    {
        return $this->date_expires;
    }

    /**
     * Returns the value of field offer_data
     *
     * @return array
     */

    public function getOfferData()
    {
        return unserialize($this->offer_data);
    }

    /**
     * Initializer method for model.
     */
    public function initialize()
    {
        $this->hasMany("offer_id", "OffersData", "offer_id");
    }

    public static function isValid($offer_id)
    {

        $integer_pattern = '/^\d+$/';

        if(!preg_match($integer_pattern, $offer_id))
            return false;

        $model = self::findFirst("offer_id = '$offer_id'");

        if (count($model) > 0) {
            return $model;
        } else {
            return false;
        }
    }

    public function serializeAndSetFields($template_id,$data)
    {
        $offer_template = OfferTemplates::findFirst($template_id);

        $fields = unserialize($offer_template->getFields());

        $data_to_store = array();

        foreach ($fields as $field) {

            $data_to_store[$field] = $data[$field];
        }

        $this->offer_data = serialize($data_to_store);
    }


}
