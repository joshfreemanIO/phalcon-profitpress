<?php

/**
 * Contains the OffersForm class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Offers\Forms
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Offers\Forms;

use \Phalcon\Forms\Form,
    \Phalcon\Forms\Element\Text,
    \Phalcon\Forms\Element\Submit,
    \Phalcon\Validation\Validator\PresenceOf,
    \Phalcon\Forms\Element\Hidden,
    \Phalcon\Forms\Element\Date,
    \ProfitPress\Offers\Models\OfferTemplates as OfferTemplates;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Offers\Forms
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class OffersForm extends \ProfitPress\Components\BaseForm
{

    public $template_id;

    public $noLabel = array(
        'Phalcon\Forms\Element\Hidden',
        'Phalcon\Forms\Element\Submit');

    public function __construct($template_id)
    {
        $offer_template = OfferTemplates::findFirst($template_id);

        $fields = unserialize($offer_template->getFields());

        foreach ($fields as $value) {

            $id = "$value";
            $name = ucwords(str_ireplace('_', ' ', $value));

            $field =  new Text($id, array("id" => $id));

            $field->setLabel($name);

            $field->addValidator(new PresenceOf(array(
                "message" => "$name Required",
                )));

            $this->add($field);
        }

        $this->template_id = $template_id;

        parent::__construct();

        $this->setFormUri($template_id);


    }

    public function initialize()
    {

        $date = new Date('date_expires');
        $date->setLabel('Date Expires');

        $permalink = new Text('permalink');
        $permalink->setLabel('Permanent Link');
        $permalink->addValidator(new PresenceOf(array(
            "message" => "Permanent Link Required",
            )));

        $template_id = new Hidden('template_id',array("value" => $this->template_id));

        $submit = new Submit('Create New');

        $this->add($date);
        $this->add($template_id);
        $this->add($permalink);
        $this->add($submit);

        // $this->formClass = 'offers-create';

    }

    protected function setFormUri($template_id = 0)
    {
        $controller = $this->dispatcher->getControllerName();
        $action = $this->dispatcher-> getActionName();

        $this->setAction($controller . '/' . $action . '/' . $template_id);
    }


}