<?php
namespace App\Models;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    protected $guarded = [];
    protected $fillable = ['label','key', 'value','type'];



    public static function add($key, $val, $type = 'string')
    {
        if ( self::has($key) ) {
            return self::set($key, $val, $type);
        }

        return self::create(['key' => $key, 'value' => $val, 'type' => $type]) ? $val : false;
    }


    public static function get($key, $default = null)
    {
        if ( self::has($key) ) {
            $setting = self::getAllSettings()->where('key', $key)->first();
            return self::castValue($setting->val, $setting->type);
        }

        return self::getDefaultValue($key, $default);
    }


    public static function set($key, $val, $type = 'string')
    {
        if ( $setting = self::getAllSettings()->where('key', $key)->first() ) {
            return $setting->update([
                'key' => $key,
                'value' => $val,
                'type' => $type]) ? $val : false;
        }

        return self::add($key, $val, $type);
    }


    public static function remove($key)
    {
        if( self::has($key) ) {
            return self::whereName($key)->delete();
        }

        return false;
    }


    public static function has($key)
    {
        return (boolean) self::getAllSettings()->whereStrict('key', $key)->count();
    }


    public static function getValidationRules()
    {
        return self::getDefinedSettingFields()->pluck('rules', 'key')
            ->reject(function ($val) {
            return is_null($val);
        })->toArray();
    }


    public static function getDataType($field)
    {
        $type  = self::getDefinedSettingFields()
                ->pluck('data', 'key')
                ->get($field);

        return is_null($type) ? 'string' : $type;
    }


    public static function getDefaultValueForField($field)
    {
        return self::getDefinedSettingFields()
                ->pluck('value', 'key')
                ->get($field);
    }

    private static function getDefaultValue($key, $default)
    {
        return is_null($default) ? self::getDefaultValueForField($key) : $default;
    }


    private static function getDefinedSettingFields()
    {
        return collect(config('setting_fields'))->pluck('elements')->flatten(1);
    }


    private static function castValue($val, $castTo)
    {
        switch ($castTo) {
            case 'int':
            case 'integer':
                return intval($val);
                break;

            case 'bool':
            case 'boolean':
                return boolval($val);
                break;

            default:
                return $val;
        }
    }


    public static function getAllSettings()
    {
        return self::all();
    }
}
?>
