<?php

/**
 * Contains the Posts class
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

use ProfitPress\Components\Tag as Tag;

use Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;

class Posts extends \ProfitPress\Components\BaseModel
{

    /**
     * @var integer
     *
     */
    protected $post_id;

    /**
     * @var string
     *
     */
    protected $title;

    /**
     * @var string
     *
     */
    protected $content;

    /**
     * @var string
     *
     */
    public $excerpt;

    /**
     * @var string
     *
     */
    protected $permalink;

    /**
     * @var string
     *
     */
    protected $date_created;

    /**
     * @var string
     *
     */
    protected $date_modified;

    /**
     * @var string
     *
     */
    protected $date_expires;

    /**
     * @var string
     *
     */
    protected $date_published;

    /**
     * @var string
     *
     */
    protected $post_type = 'blog';

    /**
     * Template For Post
     * @var string
     */
    protected $template;

    /**
     * 
     * @var string
     */
    protected $theme;

    /**
     * @var integer
     *
     */
    protected $author_user_id;

    /**
     * @var integer
     *
     */
    protected $allow_comments = 1;

    /**
     * @var integer
     *
     */
    protected $authorize_comments = 0;


    /**
     * @var  array
     */
    private $valid_post_types = array('blog', 'offers');

    /**
     * Initializer method for model.
     */
    public function initialize()
    {
        $this->belongsTo("author_users_id", "\ProfitPress\Posts\Models\Users", "id");
        $this->belongsTo("categories_id", "\ProfitPress\Posts\Models\Categories", "id");
    }

    public function getUsers()
    {
        return $this->getRelated('ProfitPress\Posts\Models\Users');
    }

    public function getCategories()
    {
        return $this->getRelated('ProfitPress\Posts\Models\Categories');
    }

    public function getPostLink($attribute_as_name = 'id', $attributes = array())
    {

        $link = array('uri' => "blog/posts/show/".$this->id, 'text' => $this->$attribute_as_name);
        return \ProfitPress\Components\Tag::anchor(array_merge($attributes, $link));
    }

    public function getDateModifiedDiff()
    {
        if (empty($this->date_modified))
            return false;

        $now = new \DateTime();
        $mod = new \DateTime();
        $mod->setTimeStamp(strtotime($this->date_modified));

        $interval = $mod->diff($now);

        if ($interval->s > 0) {

            $diff  = $interval->s;
            $unit = ' second';
        }

        if ($interval->i > 0) {

            $diff  = $interval->i;
            $unit = ' minute';
        }

        if ($interval->h > 0) {

            $diff  = $interval->h;
            $unit = ' hour';
        }

        if ($interval->d > 0) {

            $diff  = $interval->d;
            $unit = ' day';
        }

        if ($interval->m > 0) {

            $diff  = $interval->m;
            $unit = ' month';
        }

        if ($interval->y > 0) {

            $diff  = $interval->y;
            $unit = ' year';

        }

        $s = ($diff > 1 || $diff == 0) ? 's' : '';

        return 'Modified ' . $diff . $unit . $s . ' ago';
    }

    public function getNotices()
    {
        $notices = '';

        if ($this->published != 1)
            $notices .= '<span class="label label-warning">Unpublished</span>';

        return $notices;
    }

    public function countComments()
    {
        return '<span class="badge">0 Comments</span>';
    }

    public function beforeValidationOnCreate()
    {
        $this->set('date_created', $this->createCurrentTimeStamp());
        $this->set('date_modified', $this->get('date_created'));
    }

    public function beforeValidationOnUpdate()
    {
        $this->set('date_modified', $this->createCurrentTimeStamp());
    }

    public function validation()
    {
        $this->validate(new InclusionIn(
            array(
                'field' => 'post_type',
                'domain' => $this->valid_post_types,
                )

            ));

        $this->validate(new Uniqueness(array(
            'field' => 'permalink',
            )));

        if ($this->validationHasFailed() == true) {
          return false;
        }

        // $this->validate(new PresenceOf(
        //     array(
        //         'field' => 'content',
        //         'message' => 'Body is blank',
        //         )
        //     ));

        // $this->validate(new PresenceOf(
        //     array(
        //         'field' => 'content',
        //         'message' => 'Title is blank',
        //         )
        //     ));

        // $this->validate(new PresenceOf(
        //     array(
        //         'field' => 'date_created',
        //         'message' => 'Creation Date Required',
        //         )
        //     ));

        // $this->validate(new PresenceOf(
        //     array(
        //         'field' => 'date_created',
        //         'message' => 'Creation Date Required',
        //         )
        //     ));
    }

    public function isValidPostType()
    {
        return in_array($post_type, $this->valid_post_types);
    }

    public function isPublished()
    {
        if ($this->date_published === null) {
            return false;
        }

        $now = new \DateTime();
        $pub = new \DateTime();
        $pub->setTimeStamp(strtotime($this->date_published));

        if ($now < $pub) {
            return false;
        }

        $pub->setTimeStamp(strtotime($this->date_expires));

        if ($now > $pub) {
            return false;
        }

        return true;

    }
}