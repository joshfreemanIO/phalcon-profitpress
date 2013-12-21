<?php

/**
 * Contains the BaseForm class
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
    \Phalcon\Forms\Element\Hidden,
    \Phalcon\Forms\Element\Submit,
    \Phalcon\Validation\Validator\Identical;


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
class BaseForm extends \ProfitPress\Components\BaseForm
{
    public $formClass = '';

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
        echo "<form action='/" . $this->getAction() . "' method='POST' class='$this->formClass'>";
        foreach ($this as $element) {
            $this->renderElement($element);

        }
        echo "</form>";
    }

    public function renderElement($element)
    {
        if (!in_array(get_class($element), $this->noLabel)) {
            echo $element->label();
        }

        $messages = $this->getMessagesFor($element->getName());

        if (count($messages)) {
            echo '<div class="messages">';
            foreach ($messages as $message) {
                echo $this->flash->error($message);
            }
            echo '</div>';
        }

            echo $element;
    }

    protected function defaultFormUri()
    {
        $controller = $this->dispatcher->getControllerName();
        $action = $this->dispatcher-> getActionName();

        $this->setAction($controller . '/' . $action);
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

}