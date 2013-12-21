<?php

/**
 * Contains the Offers class
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

class Offers extends \ProfitPress\Components\BaseModel
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
    protected $offer_template_title;

    /**
     * @var string
     *
     */
    protected $offer_theme = 'bootstrap.min.css';

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
     * Returns the value of field offer_title
     *
     * @return integer
     */
    public function getOfferTitle()
    {
        return $this->offer_title;
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
     * Returns the value of field offer_data
     *
     * @return array
     */

    public function getOfferTheme()
    {
        return $this->offer_theme;
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

    public function getOfferLink($attribute_as_name = 'offer_id', $attributes = array())
    {

        $link = array('uri' => "offers/view/".$this->getOfferId(), 'text' => $this->$attribute_as_name);
        return \ProfitPress\Components\Tag::anchor(array_merge($attributes, $link));
    }

    public function getDateModifiedDiff()
    {
        if (empty($this->date_modified))
            return false;

        $now = new \DateTime();
        $mod = new \DateTime();
        $mod->setTimeStamp(strtotime($this->date_modified));

        $interval = $mod->diff($now);

        if ($interval->s > 0) {

            $diff  = $interval->s;
            $unit = ' second';
        }

        if ($interval->i > 0) {

            $diff  = $interval->i;
            $unit = ' minute';
        }

        if ($interval->h > 0) {

            $diff  = $interval->h;
            $unit = ' hour';
        }

        if ($interval->d > 0) {

            $diff  = $interval->d;
            $unit = ' day';
        }

        if ($interval->m > 0) {

            $diff  = $interval->m;
            $unit = ' month';
        }

        if ($interval->y > 0) {

            $diff  = $interval->y;
            $unit = ' year';

        }

        $s = ($diff > 1 || $diff == 0) ? 's' : '';

        return 'Modified ' . $diff . $unit . $s . ' ago';
    }
}