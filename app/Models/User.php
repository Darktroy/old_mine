<?php

namespace App\Models;

use http\Exception\UnexpectedValueException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Illuminate\Http\Request;
use Auth;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use LaratrustUserTrait;

    public $stimestamp = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'image'
    ];

    protected $attributes = [
        'image' => ""
    ];

    public $errors = '';

    public $old_roles = ['name' => 'required', 'email' => 'required|email|unique:users', 'password' => 'required|min:6|confirmed', 'profile' => 'required|image'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function country()
    {
        if (auth()->user()) {
            if (auth()->user()->type == 1) {
                return $this->hasOne('App\Models\Country', 'user_id', 'id');
            } elseif (auth()->user()->type == 4) {
                return $this->hasOne('App\Models\Country', 'user_id', 'parent_id');
            } else {
                return $this->hasOne('App\Models\Country', 'user_id', 'id');
            }
        }
    }

    public function changemaker()
    {
        return $this->hasOne('App\Models\Changemaker', 'user_id');
    }

    public function orgnization()
    {
        return $this->hasOne('App\Models\OrganizationDescription', 'login_email', 'email');
    }

    public function userRelatedTo()
    {
        $user = '';
        if (Auth::user()->type == 1) {
            $user = $this->hasOne('App\Models\Country', 'user_id');
        } elseif (Auth::user()->type == 2) {
            $user = $this->hasOne('App\Models\Company', 'user_id');
        } elseif (Auth::user()->type == 3) {
            $user = $this->hasOne('App\Models\ChangeMaker', 'user_id');
        } else {
            $user = new self;
        }
        return $user->first();
    }

//    old one New to update
    public static function storeUser($request)
    {
        $_this = new self;
        $data = $request->all();
        $data['name'] = $request->last_name . ' ' . $request->first_name;

        if (!$_this->validateForm($_this->old_roles, $data)) {
            return ['status' => false, 'errors' => $_this->errors];
        };

        $_this->name = (isset($request->name) && !empty($request->name)) ? $request->name : $request->last_name . ' ' . $request->first_name;
        $_this->email = $request->email;
        $_this->password = bcrypt($request->password);
        $_this->type = 3;

        if ($request->hasFile('profile')) {
            $name = str_random(12) . 'change_maker_' . $request->profile->getClientOriginalName();
            $request->profile->storeAs('media/profile/', $name, 'public');
            $_this->image = $name;
        };

        $_this->save();
        return $_this;
    }

//    new one
    protected static function storeRecord($data, $id = null)
    {
        //        dd($data, $id);
        if ($id != null) {
            $user = self::where('id', $id)->first();
        } else {
            $user = new self();
        }

        if (isset($data['name']) && !empty($data['name'])) {
            $user->name = $data['name'];
        } elseif (isset($data['last_name']) && isset($data['first_name'])) {
            $user->name = $data['last_name'] . $data['first_name'];
        } else {
            $user->name = false;
        }

        (isset($data['email']) && !empty($data['email'])) ? $user->email = $data['email'] : false;
        (isset($data['password']) && !empty($data['password'])) ? $user->password = bcrypt($data['password']) : false;
        (isset($data['type']) && !empty($data['type'])) ? $user->type = $data['type'] : false;
        (isset($data['image']) && !empty($data['image'])) ? $user->image = $data['image'] : null;
        (isset($data['position']) && !empty($data['position'])) ? $user->position = $data['position'] : false;
        (isset($data['organization']) && !empty($data['organization'])) ? $user->organization = $data['organization'] : false;
        (isset($data['tel']) && !empty($data['tel'])) ? $user->tel = $data['tel'] : false;
        (isset($data['phone']) && !empty($data['phone'])) ? $user->phone = $data['phone'] : false;
        (isset($data['status']) && !empty($data['status'])) ? $user->status = $data['status'] : false;
        (isset($data['parent_id']) && !empty($data['parent_id'])) ? $user->parent_id = $data['parent_id'] : false;


        if (!$user->save()) {
            return false;
        }

        return $user;
    }

    protected static function getUserById($user_id)
    {
        return self::where('id', $user_id)->first();
    }

    public function validateForm($roles = [], $data = [])
    {
        $validator = Validator::make($data, $old_roles);
        if ($validator->fails()) {
            $this->errors = $validator->messages();
            return false;
        }
        return true;
    }

    public function calls()
    {
        return $this->hasMany('App\Models\Call', 'user_id');
    }

    public function isActive()
    {
        if ($this->status != 1) {
            return false;
        }

        return true;
    }

    public function followers()
    {
        return $this->hasMany('App\Models\CountriesFollowers', 'user_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_user');
    }

    public function countryRoles()
    {
        return $this->hasMany('App\Models\RolesUsers', 'user_id');
    }

    public function organizationDescription()
    {
        return $this->hasMany('App\Models\OrganizationDescription', 'login_email', 'email');
    }

    /**
     * @param $role
     * @return boolean
     */
    public function hasRole($role)
    {
        if (in_array($role, array_column($this->roles->toArray(), 'name'))) {
            return true;
        }
        return false;
    }

    /**
     * Get key in array with corresponding value
     *
     * @return int
     * @throws \Exception
     */
    private function getIdInArray($array, $term)
    {
        foreach ($array as $key => $value) {
            if ($value == $term) {
                return $key;
            }
        }

        throw new \Exception("You don't have permission to access this Method !!", 244);
    }
}
