<?php

namespace ProfitPress\Account\Forms;

use \Phalcon\Forms\Element\Text,
    \Phalcon\Forms\Element\Submit,
    \Phalcon\Forms\Element\Select,
    \Phalcon\Forms\Element\Hidden,
    \Phalcon\Forms\Element\Date,
    \ProfitPress\Offers\Models\OfferTemplates as OfferTemplates;

Use \Phalcon\Validation\Validator\PresenceOf,
    \Phalcon\Validation\Validator\Email,
    \Phalcon\Validation\Validator\Regex,
    \Phalcon\Validation\Validator\InclusionIn,
    \Phalcon\Validation\Validator\StringLength;

class AccountForm extends \ProfitPress\Components\BaseForm
{

    public $template_id;

    public $noLabel = array(
        'Phalcon\Forms\Element\Hidden',
        'Phalcon\Forms\Element\Submit');

    public function initialize()
    {
        /**
         * Subdomain
         */
        $subdomain = new Text('subdomain');
        $subdomain->setLabel('Subdomain');
        $subdomain->addValidator(new PresenceOf(array(
            'message' => 'Subdomain Required',
            )));
        $subdomain->addValidator( new StringLength(array(
            'max' => 120,
            'min' => 3,
            'messageMaximum' => 'Your subdomain must contain no more than 120 characters',
            'messageMinimum' => 'Your subdomain must contain at least 3 characters'
            )));

        $this->add($subdomain);

        /**
         * Tier Level
         */
        $tiers = \ProfitPress\Account\Models\TierLevels::getTiersArray();

        $tier_level = new Select('tier_level_id', $tiers);
        $tier_level->setLabel ('Tier Level');
        $tier_level->addValidator(new InclusionIn(array(
           'message' => 'Please choose a valid tier level',
           'domain' => array_keys($tiers),
            )));

        $this->add($tier_level);

        /**
         * Email
         */
        $email = new Text('email_address');
        $email->setLabel('Email Address');
        $email->addValidator(new PresenceOf(array(
            "message" => "Email Address Required",
            )));
        $email->addValidator(new Email(array(
            "message" => "Invalid Email Address",
            )));

        $this->add($email);


        $submit = new Submit('Create New');
        $this->add($submit);

    }

    protected function setFormUri($template_id = 0)
    {
        $controller = $this->dispatcher->getControllerName();
        $action = $this->dispatcher-> getActionName();

        $this->setAction($controller . '/' . $action . '/' . $template_id);
    }
}