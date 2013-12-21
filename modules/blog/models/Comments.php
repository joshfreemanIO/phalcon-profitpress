<?php

/**
 * Contains the Comments class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Blog\Models
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Blog\Models;

/**
 * Validators
 */
use Phalcon\Mvc\Model\Validator\Regex,
    Phalcon\Mvc\Model\Validator\Inclusionin,
    Phalcon\Mvc\Model\Validator\Uniqueness;

class Comments extends \ProfitPress\Components\BaseModel
{

    protected $comment_id;
    protected $post_id;
    protected $content;

    public function validation()
    {

        $this->validate(new Inclusionin(array(
            'field' => 'tier_level_id',
            'domain' => array_keys(\ProfitPress\Account\Models\TierLevels::getTiersArray()),
            'message' => 'Please choose a valid tier level',
            )));

        $this->validate(new Uniqueness(array(
            'field' => 'subdomain',
            'message' => 'This domain is already taken'
            )));

        return $this->validationHasFailed() != true;
    }

    public static function getCommentById($comment_id)
    {
        $condition = 'comment_id = :comment_id:';
        $bind = array('comment_id' => $comment_id);

        return self::findFirst(array($condition, 'bind' => $bind));
    }

    public function beforeValidateOnCreate()
    {
        $this->set('date_created', $this->createCurrentTimeStamp());
    }
}