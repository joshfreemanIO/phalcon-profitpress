<?php

/**
 * Contains the LoginForm class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Site\Forms
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

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


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Site\Forms
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class LoginForm extends \ProfitPress\Components\BaseForm
{

    public $template_id;

    public function initialize()
    {

        $email = new Text('email_address');
        $email->setLabel('Email');
        // $email->add
        $this->add($email);

        $password = new Password('password');
        $password->setLabel('Password');
        $this->add($password);

        $submit = new Submit('Login');

        $this->add($submit);

    }
}