<?php

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Select,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Submit,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Identical,
    Phalcon\Validation\Validator\StringLength;

class BaseForm extends Form
{

    public $noLabel;

    public function initialize()
    {

    }

    public function renderFullForm()
    {
        foreach ($this as $element) {
            $this->renderElement($element);

        }
    }

    public function renderElement($element)
    {
        if (!in_array(get_class($element), $this->noLabel)) {
            echo $element->label();
        }

        $messages = $this->getMessagesFor($element->getName());

        if (count($messages)) {
            //Print each element
            echo '<div class="messages">';
            foreach ($messages as $message) {
                echo $this->flash->error($message);
            }
            echo '</div>';
        }

            echo $element;
    }

    public function getBaseRoute()
    {
                /** @var $router \Phalcon\Mvc\Router */
        $router = require APPLICATION_PATH.'/routes/default.php';
        $router->handle($url);
        $router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);

        /** @var $matched \Phalcon\Mvc\Router\Route */
        $matched = $router->getMatchedRoute();
        $paths = $matched->getPaths();

        return $paths['controller'];
    }

}