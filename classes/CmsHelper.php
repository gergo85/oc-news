<?php namespace Indikator\News\Classes;

use System\Classes\PluginManager;

class CmsHelper
{
    /**
     * Detect if Winter CMS is being used
     * 
     * @return bool
     */
    public static function isWinterCms()
    {
        // Check if Winter.Translate plugin exists
        if (class_exists('Winter\Translate\Plugin')) {
            return true;
        }
        
        // Check if Winter CMS is installed by checking system version
        if (defined('WINTER_VERSION')) {
            return true;
        }
        
        // Check if Winter.Translate is in the plugin list
        try {
            $pluginManager = PluginManager::instance();
            return $pluginManager->exists('Winter.Translate');
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * Get the correct translate behavior class name based on CMS
     * 
     * @param string $prefix Prefix for the class name ('@' for implement array, '' for class checking)
     * @return string
     */
    public static function getTranslateBehavior($prefix = '@')
    {
        $behavior = self::isWinterCms() 
            ? 'Winter.Translate.Behaviors.TranslatableModel'
            : 'RainLab.Translate.Behaviors.TranslatableModel';
            
        return $prefix . $behavior;
    }
    
    /**
     * Get translator and locale classes based on CMS
     * 
     * @return array
     */
    public static function getTranslateClasses()
    {
        if (self::isWinterCms()) {
            return [
                'translator' => 'Winter\Translate\Classes\Translator',
                'locale' => 'Winter\Translate\Models\Locale'
            ];
        }
        
        // RainLab.Translate (October CMS)
        return [
            'translator' => 'RainLab\Translate\Classes\Translator',
            'locale' => class_exists('RainLab\Translate\Classes\Locale') 
                ? 'RainLab\Translate\Classes\Locale'
                : 'RainLab\Translate\Models\Locale'
        ];
    }
    
    /**
     * Check if translate plugin is available
     * 
     * @return bool
     */
    public static function hasTranslate()
    {
        return class_exists('Winter\Translate\Behaviors\TranslatableModel') || 
               class_exists('RainLab\Translate\Behaviors\TranslatableModel');
    }
}
