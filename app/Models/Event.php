<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $table = 'events';
    protected static function newRecord($data, $id = null)
    {
        // dd($data);
        if ( !empty($id) && $id != null) {
            $event = self::where('id', $id)->first();
        } else {
            $event = new self;
        }

        (isset($data['title']) && !empty($data['title'])) ? $event->title = $data['title'] : false;
        (isset($data['min_description']) && !empty($data['min_description'])) ? $event->min_description = $data['min_description'] : false;
        (isset($data['description']) && !empty($data['description'])) ? $event->description = $data['description'] : false;
        (isset($data['active']) && !empty($data['active'])) ? $event->active = $data['active'] : false;
        (isset($data['status']) && !empty($data['status'])) ? $event->status = $data['status'] : false;
        (isset($data['start_date']) && !empty($data['start_date'])) ? $event->start_date = $data['start_date'] : false;
        (isset($data['end_date']) && !empty($data['end_date'])) ? $event->end_date = $data['end_date'] : false;
        (isset($data['full_address']) && !empty($data['full_address'])) ? $event->full_address = $data['full_address'] : false;
        (isset($data['city_id']) && !empty($data['city_id'])) ? $event->city_id = $data['city_id'] : false;
        (isset($data['country_id']) && !empty($data['country_id'])) ? $event->country_id = $data['country_id'] : false;
        (isset($data['user_id']) && !empty($data['user_id'])) ? $event->user_id = $data['user_id'] : false;
        (isset($data['attachment']) && !empty($data['attachment'])) ? $event->attachment = $data['attachment'] : false;

        if (!$event->save()) {
            return false;
        }

        return $event;
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
