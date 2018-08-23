<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteConfig extends Model
{
    //
    protected $table = 'site_configs';
    protected $fillable = ['key', 'value'];

    public static function findOrCreate($key)
    {
        $model = static::where('key', $key)->first();
        return $model ?: new static;
    }

    public static function getValueByKey($key)
    {
        $config = static::where('key', $key)->first();
        if ($config)
            return $config->value;
    }
}
