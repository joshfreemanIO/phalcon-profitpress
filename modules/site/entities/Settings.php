<?php

namespace ProfitPress\Site\Entities;

use ProfitPress\Site\Models\Settings as SettingsModel;

class Settings
{

    public $global_css;

    public function getglobal_css()
    {
        return SettingsModel::getSetting('global_css');
    }
}