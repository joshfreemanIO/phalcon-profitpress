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

    public $options = array();

    public static function getOption($option)
    {
        return self::findFirst("option_name = '$option'")->option_value;
    }

    public static function setOption($option_name, $option_value)
    {
        $model = self::findFirst(array(
                "option_name = :option_name:",
                'bind' => array('option_name' => $option_name),
            ));

        if (!$model) {
            $model = new self();
            $model->option_name = $option_name;
        }

        $model->option_value = $option_value;

        $model->save();
    }

}
