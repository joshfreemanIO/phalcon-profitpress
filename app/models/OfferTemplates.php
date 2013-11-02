<?php


class OfferTemplates extends \Phalcon\Mvc\Model
{


    /**
     * @var string
     *
     */
    protected $offer_template_type;

    /**
     * @var string
     *
     */
    protected $offer_template_name;

    /**
     * @var string
     *
     */
    protected $fields;


    /**
     * Method to set the value of field offer_template_type
     *
     * @param string $offer_template_type
     */
    public function setOfferTemplateType($offer_template_type)
    {
        $this->offer_template_type = $offer_template_type;
    }

    /**
     * Method to set the value of field offer_template_name
     *
     * @param string $offer_template_name
     */
    public function setOfferTemplateName($offer_template_name)
    {
        $this->offer_template_name = $offer_template_name;
    }

    /**
     * Method to set the value of field fields
     *
     * @param string $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
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
     * Returns the value of field offer_template_type
     *
     * @return string
     */
    public function getOfferTemplateType()
    {
        return $this->offer_template_type;
    }

    /**
     * Returns the value of field offer_template_name
     *
     * @return string
     */
    public function getOfferTemplateName()
    {
        return $this->offer_template_name;
    }

    /**
     * Returns the value of field fields
     *
     * @return string
     */
    public function getFields()
    {
        return $this->fields;
    }


    public static function isValid($template_id)
    {

        $integer_pattern = '/^\d+$/';

        if(!preg_match($integer_pattern, $template_id))
                return false;

        $model = self::find("offer_template_id = '$template_id'");

        if (count($model) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function serializeAndSetFields($fields) {

        $this->fields = serialize(array_keys($fields));
    }
}
