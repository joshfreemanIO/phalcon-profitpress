<?php

/**
 * Contains the SettingsForm class
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

use \ProfitPress\Site\Models\Settings as Settings;

use \Phalcon\Forms\Form,
    \Phalcon\Forms\Element\Text,
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
class SettingsForm extends \ProfitPress\Components\BaseForm
{

    public $template_id;

    public $noLabel = array(
        'Phalcon\Forms\Element\Hidden',
        'Phalcon\Forms\Element\Submit');

    public function __construct()
    {
        parent::__construct();
    }

    public function initialize()
    {

        $css = new Select('global_css', array(

        'amelia.bootstrap.min.css' => 'Amelia',
        'bootstrap.min.css' => 'Basic',
        'cerulean.bootstrap.min.css' => 'Cerulean',
        'cosmo.bootstrap.min.css' => 'Cosmo',
        'cyborg.bootstrap.min.css' => 'Cyborg',
        'flatly.bootstrap.min.css' => 'Flatly',
        'journal.bootstrap.min.css' => 'Journal',
        'readable.bootstrap.min.css' => 'Readable',
        'readable.bootstrap.min.css' => 'Readable',
        'simplex.bootstrap.min.css' => 'Simplex',
        'slate.bootstrap.min.css' => 'Slate',
        'spacelab.bootstrap.min.css' => 'Spacelab',
        'united.bootstrap.min.css' => 'United',
            ));



        $css->setLabel('Theme');
        $css->setAttribute('value' , $this->getCss());


        $this->add($css);
        $this->add(new Submit('Update Information'));

    }

    protected function setFormUri($template_id = 0)
    {
        $controller = $this->dispatcher->getControllerName();
        $action = $this->dispatcher-> getActionName();

        $this->setAction($controller . '/' . $action);
    }

    private function getSettings()
    {
        return \ProfitPress\Site\Models\Settings::getSetting('global_css');
    }

    private function buildForm()
    {
        $settings = Settings::getSettings();

        foreach ($settings as $setting_name => $setting_value) {

        }
    }

    private function getCSS()
    {
        return \ProfitPress\Site\Models\Settings::getSetting('global_css');
    }
}