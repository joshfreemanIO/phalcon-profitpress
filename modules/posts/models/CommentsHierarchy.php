<?php

namespace ProfitPress\Posts\Models;

class CommentsHierarchy extends \ProfitPress\Components\BaseModel
{

    protected $comment_id;
    protected $post_id;
    protected $ni_a;
    protected $ni_c;
    protected $ni_b;
    protected $ni_d;
    protected $ni_left_bound;
    protected $ni_right_bound;

    /**
     * Initializer method for model.
     */
    public function initialize()
    {
        $this->belongsTo("post_id", "ProfitPress\Posts\Models\Posts", "id");
    }

    public function createHierarchy($parent_id = null)
    {
        if ($parent_id === null) {
            $this->newComment();
        } else {
            $this->newChildComment($parent_id);
        }
    }

    public static function getCommentById($comment_id)
    {
        $condition = 'comment_id = :comment_id:';
        $bind = array('comment_id' => $comment_id);

        return self::findFirst(array($condition, 'bind' => $bind));
    }

    private function newComment($value)
    {
        $this->ni_a = 2;
        $this->ni_c = 1;
        $this->ni_b = 1;
        $this->ni_d = 0;
        $this->calculateBounds();
    }

    private function newChildComment($parent_id)
    {
        $parent_comment = self::getCommentById($parent_id);

        $condition = array(
            'type' => .l
            );

        $this->ni_a = 2;
        $this->ni_c = 1;
        $this->ni_b = 1;
        $this->ni_d = 0;
    }

    private function calculateBounds()
    {
        $this->ni_left_bound = $this->ni_a / $this->ni_b;

        $this->ni_right_bound = ($this->ni_a + $this->ni_b) / ($this->ni_b + $this->ni_d);
    }

    private function
}