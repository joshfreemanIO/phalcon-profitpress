<?php

/**
 * Contains the Categories class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Posts\Models
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Posts\Models;

use Phalcon\Mvc\Model\Validator\PresenceOf,
    Phalcon\Mvc\Model\Validator\Uniqueness;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Posts\Models
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class Categories extends \ProfitPress\Components\BaseModel
{

    /**
     * @var integer
     *
     */
    public $category_id;

    /**
     * @var string
     *
     */
    public $name;


    public function validation()
    {

        $this->validate(new PresenceOf(
            array(
                'field' => 'name',
                'message' => 'Category name cannot be empty when adding a new category'
                )

            ));

        $this->validate(new Uniqueness(
            array(
                'field' => 'name',
                'message' => "\"$this->name\" already exists",
                )

            ));

        return $this->validationHasFailed() !== true;
    }

    public static function addFormElements(\ProfitPress\Posts\Forms\PostForm $form)
    {
        $categories = self::find();

        foreach ($categories as $category) {

            $name = "category[$category->name]";

            $check = new \Phalcon\Forms\Element\Check($name);
            $check->setLabel($category->name);
            $attributes = $check->prepareAttributes(array('value' => $category->category_id), true);
            $check->setAttributes($attributes);
            $form->add($check);
        }
    }
}
