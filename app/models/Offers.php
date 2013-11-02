<?php


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
     * Initializer method for model.
     */
    public function initialize()
    {
        $this->hasMany("offer_id", "OffersData", "offer_id");
    }

    public static function isValid($id)
    {
        $model = self::find($id);

        if (count($model) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
