<?php

namespace ProfitPress\Site\Forms;

use \Phalcon\Forms\Form,
    \Phalcon\Forms\Element\Text,
    \Phalcon\Forms\Element\Password,
    \Phalcon\Forms\Element\Submit,
    \Phalcon\Forms\Element\Select,
    \Phalcon\Validation\Validator\PresenceOf,
    \Phalcon\Forms\Element\Hidden,
    \Phalcon\Forms\Element\Date,
    \ProfitPress\Offers\Models\OfferTemplates as OfferTemplates;

class LoginForm extends \ProfitPress\Components\BaseForm
{

    public $template_id;

    public function initialize()
    {

        $email = new Text('email_address');
        $email->setLabel('Email');
        $this->add($email);

        $password = new Password('password');
        $password->setLabel('Password');

        $this->add($password);

        $this->add(new Submit('Login'));

    }
}