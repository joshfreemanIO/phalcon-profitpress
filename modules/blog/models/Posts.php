<?php

/**
 * Contains the Posts class
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

use ProfitPress\Components\Tag as Tag;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Blog\Models
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class Posts extends \ProfitPress\Components\BaseModel
{

    /**
     * @var integer
     *
     */
    protected $id;

    /**
     * @var string
     *
     */
    protected $title;

    /**
     * @var string
     *
     */
    protected $slug;

    /**
     * @var string
     *
     */
    protected $content;

    /**
     * @var string
     *
     */
    protected $created;

    /**
     * @var integer
     *
     */
    protected $users_id;

    /**
     * @var integer
     *
     */
    protected $categories_id;

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
     * @var integer
     *
     */
    protected $published = 1;
    /**
     * Initializer method for model.
     */
    public function initialize()
    {
        $this->belongsTo("users_id", "ProfitPress\Blog\Models\Users", "id");
        $this->belongsTo("categories_id", "ProfitPress\Blog\Models\Categories", "id");
    }

    public function getUsers()
    {
            return $this->getRelated('ProfitPress\Blog\Models\Users');
    }

    public function getCategories()
    {
            return $this->getRelated('ProfitPress\Blog\Models\Categories');
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
}
