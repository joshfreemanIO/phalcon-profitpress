<?php

/**
 * Contains the OfferTemplateForm class
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
    \Phalcon\Forms\Element\Select,
    \Phalcon\Forms\Element\Check,
    \Phalcon\Forms\Element\Submit,
    \Phalcon\Validation\Validator\PresenceOf,
    \Phalcon\Validation\Validator\StringLength,
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

        $warning_text = new Check("template_options[warning_text]", array("value" => 1, 'id' => 'template_options[warning_text]', 'checked' => 'checked'));
        $warning_text->setLabel("Warning Text");

        $header = new Check("template_options[header]", array("value" => 1, 'id' => 'template_options[header]', 'checked' => 'checked'));
        $header->setLabel("Header");

        $main_text = new Check("template_options[main_text]", array("value" => 1, 'id' => 'template_options[main_text]'));
        $main_text->setLabel("Main Text");

        $secondary_text = new Check("template_options[secondary_text]", array("value" => 1, 'id' => 'template_options[secondary_text]'));
        $secondary_text->setLabel("Secondary Text");

        $image = new Check("template_options[image]", array("value" => 1, 'id' => 'template_options[image'));
        $image->setLabel("Image");

        $video_box = new Check("template_options[video_box]", array("value" => 1, 'id' => 'template_options[video_box'));
        $video_box->setLabel("Video Box");

        $submit = new Submit('Create New');

        $this->add($name);
        $this->add($type);
        $this->add($warning_text);
        $this->add($header);
        $this->add($main_text);
        $this->add($secondary_text);
        $this->add($video_box);
        $this->add($image);
        $this->add($submit);

        $this->formClass = 'offer-templates';

    }


}