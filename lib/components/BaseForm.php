<?php

/**
 * Contains the BaseForm class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Components
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Components;

use ProfitPress\Components\Tag;

use \Phalcon\Forms\Form,
    \Phalcon\Forms\Element\Hidden,
    \Phalcon\Forms\Element\Submit,
    \Phalcon\Validation\Validator\Identical;

abstract class BaseForm extends Form
{
    public $form_attributes = array('class' => 'form-horizontal','role' => 'form','method' => 'POST');

    public $form_group_attributes = array('class' => 'form-group');

    public $label_attributes = array('class' => 'control-label col-sm-2');

    public $element_wrapper_attributes = array('class' => 'col-sm-10');

    public $element_attributes = array('class' => 'form-control');

    public $elements;

    public function __construct($entity = null, $options = null)
    {
        $this->defaultFormUri();

        // $this->add($this->setCsrf());

        parent::__construct($entity, $options);

    }

    public function renderFullForm()
    {
        $this->renderFormStart();

        foreach ($this as $element) {
            $this->renderFormGroup($element);
        }

        $this->renderFormEnd();
    }

    public function renderFormStart()
    {
        $form_attributes = $this->form_attributes;

        $form_attributes['action'] =  $this->getAction();

        echo Tag::tagHtml('form', $form_attributes);
    }

    public function renderFormGroup($element)
    {

        if (gettype($element) === 'string')
            $element = $this->get($element);

        $form_group_attributes = $this->form_group_attributes;

        if ($element->getUserOption('form_group_attributes') !== null)
            $form_group_attributes = $this->modifyAttributes($form_group_attributes,$element->getUserOption('form_group_attributes'));

        $messages = $this->getMessagesFor($element->getName());

        if (count($messages))
            $form_group_attributes['class'] .= ' form-group has-error well';

        echo Tag::tagHtml('div', $form_group_attributes);
        $this->renderLabel($element);
        $this->renderElement($element);
        $this->buildMessages($messages);
        echo Tag::tagHtmlClose('div');
    }

    public function renderLabel($element)
    {
        if ($element->getUserOption('no_label') === true)
            return false;

        $label_attributes = $this->label_attributes;

        if ($element->getUserOption('label_attributes') !== null)
            $label_attributes = $this->modifyAttributes($label_attributes,$element->getUserOption('label_attributes'));

        $label_attributes['for'] = $element->getName();

        echo Tag::tagHtml('label', $label_attributes);
        echo $element->getLabel();
        echo Tag::tagHtmlClose('label');
    }

    public function renderElement($element)
    {
        $element_wrapper_attributes = $this->element_wrapper_attributes;

        if ($element->getUserOption('element_wrapper_attributes') !== null)
            $element_wrapper_attributes = $this->modifyAttributes($element_wrapper_attributes,$element->getUserOption('element_wrapper_attributes'));

        $element_attributes = $this->modifyAttributes($this->element_attributes, $element->getAttributes());

        if ($element->getUserOption('element_attributes') !== null)
            $element_attributes = $this->modifyAttributes($element_attributes,$element->getUserOption('element_attributes'));

        $element->setAttributes($element_attributes);

        if ($element->getUserOption('no_element_wrapper') === true) {
            echo $element;
            return true;
        }
        echo Tag::tagHtml('div', $element_wrapper_attributes);
        echo $element;
        echo Tag::tagHtmlClose('div');
    }

    public function renderFormEnd()
    {
        echo Tag::tagHtmlClose('form');
    }

    protected function modifyAttributes($attributes, $attributes_to_append)
    {

        foreach ($attributes_to_append as $attribute => $value) {

            if (preg_match('/.*(?=\-append$)/', $attribute, $match)) {
                $attributes[$match[0]] .= ' ' . $value;
            } else {
                $attributes[$attribute] = $value;
            }
        }

        return $attributes;
    }

    protected function defaultFormUri()
    {
        $this->setAction(ltrim($this->router->getRewriteUri()));
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

        $html = '';

        $html .= Tag::tagHtml('dl', array('class' => 'dl-horizontal'));
            $html .= Tag::tagHtml('dt', array('class' => 'input-group input-group-large'));
                $html .= Tag::tagHtml('span', array('class' => 'input-group-addon input-group-addon'));
                    $html .= Tag::tagHtml('span', array('class' => 'glyphicon glyphicon-warning-sign'));
                    $html .= Tag::tagHtmlClose('span');
                $html .= Tag::tagHtmlClose('span');
            $html .= Tag::tagHtmlClose('dt');

        foreach ($messages as $message) {
            $html .= Tag::tagHtml('dd');
                $html .= $message->getMessage();
            $html .= Tag::tagHtmlClose('dd');
        }

        $html .= Tag::tagHtmlClose('dl');

        echo $html;
    }

    public function renderCheckbox($element)
    {
        $div_attributes = array('class' => 'checkbox', 'data-checkbox-name' => $element->getName());

        $html  = Tag::tagHtml('div', $div_attributes);
            $html .= Tag::tagHtml('label');
                $html .= $element;
                $html .= $element->getLabel();
            $html .= Tag::tagHtmlClose('label');
        $html .= '</div>';

        echo $html;
    }
}