<?php

namespace ProfitPress\Components;

use \Phalcon\Forms\Form as Form,
    \Phalcon\Forms\Element\Hidden,
    \Phalcon\Forms\Element\Submit,
    \Phalcon\Validation\Validator\Identical;

class BaseForm extends Form
{
    public $formClass = 'form-horizontal';

    public $noLabel;

    public $elements;

    public function __construct()
    {

        $this->defaultFormUri();

        // $this->add($this->setCsrf());

        parent::__construct();


    }

    public function renderFullForm()
    {
        echo "<form action='/" . $this->getAction() . "' method='POST' class='$this->formClass' role='form'>";

        foreach ($this as $element) {
            $this->renderElement($element);

        }

        echo "</form>";
    }

    public function renderElement($element)
    {
        $messages = $this->getMessagesFor($element->getName());
            $val = $this->request->getPost($element->getName());

        if (count($messages)) {
            echo '<div class="form-group has-error well">';
        } else {
            echo '<div class="form-group">';
        }

        if (!in_array(get_class($element), $this->noLabel)) {
            $this->renderLabel($element, array('class' => 'control-label col-sm-3'),$messages);
        }

        if(get_class($element) === 'Phalcon\Forms\Element\Submit') {
            $element->setAttribute('class', 'btn btn-success btn-large btn-block');
            echo "<div class='col-sm-12'>";
        }
        else {
            $element->setAttribute('class', 'form-control');
            echo "<div class='col-sm-9'>";
        }

        echo $element;
        $this->buildMessages($messages);

        echo "</div></div>";
    }

    public function renderLabel($element, $attributesArray)
    {
        $attributes = '';

        if (!empty($attributesArray)) {
            foreach ($attributesArray as $attribute => $value) {
                $attributes .= " $attribute='$value'";
            }
        }

        echo "<label$attributes>".$element->getLabel()."</label>";
    }

    protected function defaultFormUri()
    {
        $this->setAction(ltrim($this->router->getRewriteUri(),'/'));
    }

    protected function setCsrf()
    {
        $csrf = new Hidden('csrf');

        $csrf->addValidator(
            new Identical(array(
                'value' => $this->security->getSessionToken(),
                'message' => 'CSRF validation failed'
            ))
        );

        return $csrf;
    }

    protected function buildMessages($messages)
    {
        if (count($messages) < 1)
            return false;

        echo '<dl class="dl-horizontal">';
        echo '<dt class="input-group input-group-large"><span class="input-group-addon input-group-addon "><span class="glyphicon glyphicon-warning-sign"></span></span></dt>';
        foreach ($messages as $message) {
            echo '<dd>';
            echo $message->getMessage();
            echo '</dd>';
        }
        echo '</dl>';
    }

}