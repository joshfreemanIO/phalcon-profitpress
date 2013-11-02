<?php

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Select,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Submit,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Identical,
    Phalcon\Validation\Validator\StringLength;

class OfferTemplateForm extends BaseForm
{

    public $noLabel = array(
        'Phalcon\Forms\Element\Hidden',
        'Phalcon\Forms\Element\Submit');

    public function initialize()
    {
        $name = new Text("name");
        $name->setLabel("Name");
        $name->addValidator(new PresenceOf(array('message' => 'Name Required')));

        $csrf = new Hidden('csrf', array(
            'value' => $this->security->getToken(),
            ));

        $csrf->addValidator(
            new Identical(array(
                    'value' => $this->security->getSessionToken(),
                    'message' => 'CSRF validation failed'
            ))
        );

        $submit = new Submit('Create New');

        $this->add($name);

        $this->add($submit);

        $this->add($csrf);
    }


}