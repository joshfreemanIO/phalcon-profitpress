<?php

namespace ProfitPress\Site\Models;

class Settings extends \ProfitPress\Components\BaseModel
{

    /**
     * @var string
     *
     */
    public $setting_name;

    /**
     * @var string
     *
     */
    public $setting_value;

    public $settings = array();

    public static function getSetting($setting)
    {
        return self::findFirst("setting_name = '$setting'")->setting_value;
    }

    public static function setSetting($setting_name, $setting_value)
    {
        $model = self::findFirst(array(
                "setting_name = :setting_name:",
                'bind' => array('setting_name' => $setting_name),
            ));

        if (!$model) {
            $model = new self();
            $model->setting_name = $setting_name;
        }

        $model->setting_value = $setting_value;

        $model->save();
    }

    public static function getSettings()
    {
        $site_settings = self::find();

        foreach ($site_settings as $setting) {
            $setting_name = $setting->get('setting_name');
            $setting_value = $setting->get('setting_value');
            $settings[$setting_name] = $setting_value;
        }

        return $settings;
    }

    public static function settingsVersionIsCurrent($setting_version)
    {

        $stored_version = self::findFirst("setting_name = 'settings_version'");

        if (!$stored_version) {
            $stored_version = self::updateSettingsVersion();
            return false;
        }

        if ($stored_version->get('setting_value') === $setting_version) {
            return true;
        } else {
            return false;
        }
    }

    public static function updateSettingsVersion($session_version)
    {
        $settings = self::getSettings();

        if (isset($settings['settings_version'])) {
            unset($settings['settings_version']);
            $version_model = self::findFirst("setting_name = 'settings_version'");
        } else {
            $version_model = new self();
        }

        $version = sha1(serialize($settings));

        if ($version === $session_version) {
            return false;
        }

        $version_model->set('setting_name', 'settings_version');
        $version_model->set('setting_value', $version);

        $self = new self();
        $self->getDI()->getShared('settings')->set('settings_version',$version);

        $version_model->save();

        return $version_model->get('setting_value');
    }

    public function afterSave()
    {
        self::updateSettingsVersion($this->getDI()->getShared('settings')->get('settings_version'));
    }
}

