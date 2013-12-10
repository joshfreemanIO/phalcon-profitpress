<?php

namespace ProfitPress\Posts\Models;

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