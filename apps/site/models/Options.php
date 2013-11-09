<?php

namespace ProfitPress\Site\Models;

class Options extends \Phalcon\Mvc\Model
{

    /**
     * @var string
     *
     */
    public $option_name;

    /**
     * @var string
     *
     */
    public $option_value;

    public static function getOption($option)
    {
        return self::findFirst("option_name = '$option'")->option_value;
    }

}
