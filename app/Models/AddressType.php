<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressType extends Model
{
    //
    protected $table = 'address_types';

    protected static function storeRecord($data, $id = null)
    {
        if ($id != null){
            $type = self::where('id',$id)->first();
        }else{
            $type = new self();
        }

        $type->name = $data['name'];
        if (!$type->save()){
            return false;
        }

        return $type;

    }
}
