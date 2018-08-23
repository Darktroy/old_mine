<?php
namespace app\Helpers\Euromed;

use DateTime;

class Euromed
{
    public static function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public static function converDateToTimeStamp($date)
    {

        if (DateTime::createFromFormat('Y-m-d G:i:s', $date) == true) {
            return $date;
        }
        $date = strtotime($date);
        return date('Y-m-d H:I:s', $date);
    }

    public static function authorize($role)
    {
        if(!auth()->user()->hasRole($role)){
            abort(404,'Unauthorized');
        }

        return true;
    }
}