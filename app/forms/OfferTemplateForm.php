<?php

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Select,
    Phalcon\Forms\Element\Check,
    Phalcon\Forms\Element\Submit,
    Phalcon\Validation\Validator\PresenceOf,
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

        $type = new Select('type', array("video" => "video", "picture" => "picture" ));
        $type->setLabel('Type of Offer');

        $warning_text = new Check("template_options[warning_text]", array("value" => 1));
        $warning_text->setLabel("Warning Text");

        $header = new Check("template_options[header]", array("value" => 1));
        $header->setLabel("Header");

        $main_text = new Check("template_options[main_text]", array("value" => 1));
        $main_text->setLabel("Main Text");

        $video_box = new Check("template_options[video_box]", array("value" => 1));
        $video_box->setLabel("Video Box");

        $submit = new Submit('Create New');

        $this->add($name);
        $this->add($type);
        $this->add($warning_text);
        $this->add($header);
        $this->add($main_text);
        $this->add($video_box);
        $this->add($submit);

    }


}