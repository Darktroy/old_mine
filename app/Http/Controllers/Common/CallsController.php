<?php

namespace App\Http\Controllers\Common;

use App\Models\User;
use App\Notifications\Notifications;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Call;
use App\Models\Country;
use App\Models\UserCall;
use App\Models\CallCountry;
use App\Models\CallCity;
use App\Models\City;

// Facades & packages & libs
//use Psy\Exception\Exception;
use Validator;
use Session;
use Auth;
use DB;
use DateTime;
use App\Helpers\Euromed\Euromed;

class CallsController extends Controller
{
    //
    public $status = true;

    public function adminListAllCalls()
    {
//        dd(Auth::user());
        $page_title = 'Calls';
        $sub_title = 'Add New Call';
        $search = false;
        $calls = Call::paginate(20);
        $looking_for = ['v' => ' Volunteers', 'i' => 'Intern', 'e' => 'Employee'];
        $place = ['b' => 'Online and Offline', 'o' => 'Online', 'f' => 'Offline'];
        return view('panel.calls.index', compact('page_title', 'sub_title', 'search', 'calls', 'looking_for', 'place'));
    }

    public function storeCall(Request $request)
    {

        $rules = [
            "for" => "required|max:2",
            "title" => "required|min:5",
            "person" => "required|min:5",
            "email" => "required|email",
            'task_details' => 'required|min:5',
            "deadline" => "date",
            "selection" => "required|date",
            "number" => "required|numeric",
            "working_hours" => "required|numeric",
            "gender" => "required|max:2",
            "from" => "required|date",
            "to" => "required|date",
            "workplace" => "required|max:2",
            "benefits" => "required|min:5",
            "more" => "min:5",
            'call_country' => 'required',
            'call_city' => 'required'
        ];

        // modify data for call
        $request->deadline = Euromed::converDateToTimeStamp($request->deadline);
        $request->selection = Euromed::converDateToTimeStamp($request->selection);
        $request->from = Euromed::converDateToTimeStamp($request->from);
        $request->to = Euromed::converDateToTimeStamp($request->to);
        $request->merge(['user_id' => Auth::user()->id]);
//        $request->merge(['user_type' => Auth::user()->type]);

        // Validation
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }


        // Store Call In Calls Table
        DB::beginTransaction();

        try {
            $stored_call = Call::storeCall($request);
        } catch (\Exception $e) {
            DB::rollback();
            $this->status = false;
            return $e->getMessage();
        }
        $user = Auth::user();
        // Gather User_calls data
        $user_call_data = [];
        $user_call_data['call_id'] = $stored_call->id;
//        $user_call_data['country_id'] = $user->userRelatedTo()->id;
        $user_call_data['user_id'] = Auth::user()->id;

        // store in user_calls table
        try {
            $user_call = UserCall::storeRecord($user_call_data);
        } catch (\Exception $e) {
            DB::rollback();
            $this->status = false;
            return $e->getMessage();
        }

        // store call Countries
        if (isset($request->call_country) && !empty($request->call_country)) {
            foreach ($request->call_country as $k => $country) {
                try {
                    $country_call = CallCountry::storeRecord(['call_id' => $stored_call->id, 'country_id' => $country]);
                } catch (\Exception $e) {
                    DB::rollback();
                    $this->status = false;
                    return $e->getMessage();
                }
            }
        }

        // Store Call Cities
        if (isset($request->call_city) && !empty($request->call_city)) {
            $call_city = '';
            foreach ($request->call_city as $k => $city) {
                try {
                    $city_country = City::where('id', $city)->first();
                    $call_city = CallCity::storeRecord(['call_id' => $stored_call->id, 'country_id' => $city_country->country_id, 'city_id' => $city]);
                } catch (\Exception $e) {
                    DB::rollback();
                    $this->status = false;
                    return $e->getMessage();
                }
            }
        }

        DB::commit();

        if ($this->status === true) {
            Session::flash('message', 'Call Added Successfully');
            if (isset($request->call_country) && !empty($request->call_country)) {
                foreach ($request->call_country as $k => $country) {
                    $userCountry = User::where('country_id', $country)->first();
                    if ($userCountry)
                        $userCountry->notify(new Notifications('New Call From ' . Auth::user()->name, $country));
                }
            }
            // return redirect()->route('panel.calls');
            return redirect()->back();
        } else {
            Session::flash('message', 'Failed To Add Call');
            return redirect()->back();
        }
    }

    public function adminNewCall()
    {
        $page_title = 'Calls';
        $sub_title = 'Add New Call';
        $search = false;
        $countries = Country::all()->pluck('name', 'id')->toArray();
//        dd($countries);
        return view('panel.calls.new', compact('page_title', 'sub_title', 'search', 'countries'));
    }

    public function deleteCall($call_id, Request $request)
    {
        $call = Call::callById($call_id);

        if (!$call) {
            if ($request->ajax()) {
                return response(['status' => false, 'success' => "call Is not Existed", 'id' => $call_id]);
            } else {
                Session::flash('message', 'Call Not Found');
                return redirect()->back();
            }
        }

        if ($call->delete()) {
            if ($request->ajax()) {
                return response(['status' => true, 'success' => 'Call Deleted Successfully', 'id' => $call->id]);
            } else {
                Session::flash('message', 'Call Delete Successfully');
                return redirect()->back();
            }
        } else {
            if ($request->ajax()) {
                return response(['status' => false, 'success' => 'Failed To Delete The Call', 'id' => $call->id]);
            } else {
                Session::flash('message', 'Failed To Delete The Call');
                return redirect()->back();
            }
        }


    }

    // private function converDateToTimeStamp($date)
    // {
    //     if (DateTime::createFromFormat('Y-m-d G:i:s', $date) == true) {
    //         return $date;
    //     }
    //     $date = strtotime($date);
    //     return date('Y-m-d H:I:s', $date);
    // }

    public function viewCall($call_id)
    {
        $call = Call::callById($call_id);
        $page_title = 'Calls';
        $sub_title = 'View Call ' . $call->title;
        $list = 'Calls';
        $country = Country::where('id', auth()->user()->country->id)->first();
        $url = 'country/calls/' . auth()->user()->country->id . '/1';
        $looking_for = ['v' => ' Volunteers', 'i' => 'Intern', 'e' => 'Employee'];
        $place = ['b' => 'Online and Offline', 'o' => 'Online', 'f' => 'Offline'];
        $genders = ['f' => 'Female', 'm' => 'Male', 'b' => 'Both'];
        $search = false;
        return view('panel.calls.view', compact('list', 'country', 'url', 'page_title', 'sub_title', 'search', 'call', 'looking_for', 'place', 'genders'));
    }

    public function callStatus($call_id, $status)
    {
        $call = Call::updateStatus($call_id, $status);
        if (!$call) {
            return response(['status' => false, 'message' => 'Failed To Change Status']);
        }

        return response(['status' => true, 'message' => 'Status Changed Successfully']);
    }

    public function editCall(Request $request, $id)
    {
        $call = $this->getCall($request, $id);
        $page_title = 'Calls';
        $sub_title = 'edit Call ' . $call->title;
        $search = false;
        $looking_for = ['v' => ' Volunteers', 'i' => 'Intern', 'e' => 'Employee'];
        $place = ['b' => 'Online and Offline', 'o' => 'Online', 'f' => 'Offline'];
        $countries = Country::all()->pluck('name', 'id')->toArray();
        $countries_ids = $call->callCountries()->select('call_countries.country_id')->get()->pluck('country_id')->toArray();

        $cities = City::arrayOfCountries($countries_ids)->pluck('name', 'id')->toArray();
        $cities_ids = $call->callCities()->select('call_cities.city_id')->get()->pluck('city_id')->toArray();
        return view('panel.calls.edit', compact('call', 'page_title', 'sub_title', 'search', 'looking_for', 'place', 'countries', 'countries_ids', 'cities', 'cities_ids'));
    }

    public function updateCall(Request $request, $id)
    {
        $rules = [
            "for" => "required|max:2",
            "title" => "required|min:5",
            "person" => "required|min:5",
            "email" => "required|email",
            'task_details' => 'required|min:5',
            "deadline" => "required|date",
            "selection" => "required|date",
            "number" => "required|numeric",
            "working_hours" => "required|numeric",
            "gender" => "required|max:2",
            "from" => "required|date",
            "to" => "required|date",
            "workplace" => "required|max:2",
            "benefits" => "required|min:5",
            "more" => "min:5",
            'call_country' => 'required',
            'call_city' => 'required'
        ];

        // modify data for call
        $request->deadline = Euromed::converDateToTimeStamp($request->deadline);
        $request->selection = Euromed::converDateToTimeStamp($request->selection);
        $request->from = Euromed::converDateToTimeStamp($request->from);
        $request->to = Euromed::converDateToTimeStamp($request->to);
        $request->merge(['user_id' => Auth::user()->id]);

        // Validation
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Store Call In Calls Table
        DB::beginTransaction();

        try {
            $stored_call = Call::storeCall($request, $id);
        } catch (\Exception $e) {
            DB::rollback();
            $this->status = false;
            return $e->getMessage();
        }

        // Gather User_calls data
        $user_call_data = [];
        $user_call_data['call_id'] = $stored_call->id;
        $user_call_data['user_id'] = Auth::user()->id;

        // store in user_calls table

        try {
            DB::table('user_calls')->where('call_id', $id)->delete();
            $user_call = UserCall::storeRecord($user_call_data);
        } catch (\Exception $e) {
            DB::rollback();
            $this->status = false;
            return $e->getMessage();
        }

        // store call Countries
        if (isset($request->call_country) && !empty($request->call_country)) {
            DB::table('call_countries')->where('call_id', $id)->delete();
            $country_call = '';
            foreach ($request->call_country as $k => $country) {
                try {
                    $country_call = CallCountry::storeRecord(['call_id' => $stored_call->id, 'country_id' => $country]);
                } catch (\Exception $e) {
                    DB::rollback();
                    $this->status = false;
                    return $e->getMessage();
                }
            }
        }

        // Store Call Cities
        if (isset($request->call_city) && !empty($request->call_city)) {
            DB::table('call_cities')->where('call_id', $id)->delete();
            $call_city = '';
            foreach ($request->call_city as $k => $city) {
                try {
                    $city_country = City::where('id', $city)->first();
                    $call_city = CallCity::storeRecord(['call_id' => $stored_call->id, 'country_id' => $city_country->country_id, 'city_id' => $city]);
                } catch (\Exception $e) {
                    DB::rollback();
                    $this->status = false;
                    return $e->getMessage();
                }
            }
        }

        DB::commit();

        if ($this->status === true) {
            Session::flash('message', 'Call Updated Successfully');
            // return redirect()->route('panel.calls');
            return redirect()->back();
        } else {
            Session::flash('message', 'Failed To Update Call');
            return redirect()->back();
        }
    }

    public function callActivation($call_id, $status)
    {
        $call = Call::updateActivation($call_id, $status);
        if (!$call) {
            return response(['status' => false, 'message' => 'Failed To Change Status']);
        }

        return response(['status' => true, 'message' => 'Status Changed Successfully']);

    }

    public function getCall(Request $request, $call_id)
    {
        $call = Call::callById($call_id);
        if ($request->ajax()) {
            return response(['call' => $call]);
        } else {
            return $call;
        }
    }

    public function viewCallsInSite()
    {
        $parent_title = 'Countries';
        $page_title = 'Calls';
        $calls = Call::where('activate', 1)->paginate(20);
        $for = ['v' => ' Volunteers', 'i' => 'Intern', 'e' => 'Employee'];
        $place = ['b' => 'Online and Offline', 'o' => 'Online', 'f' => 'Offline'];
        return view('site.calls.index', compact('list', 'url', 'country', 'calls', 'page_title', 'parent_title', 'for', 'place'));
    }

    public function filterCalls(Request $request)
    {
//        dd($request->all());
        $for = ['v' => ' Volunteers', 'i' => 'Intern', 'e' => 'Employee'];
        $place = ['b' => 'Online and Offline', 'o' => 'Online', 'f' => 'Offline'];
        $parent_title = 'Home';
        $page_title = 'Calls';

        $query = Call::where('activate', 1);
        if (isset($request->looking_for) && !empty($request->looking_for)) {
            $query->where('for', $request->looking_for);
        }
        if (isset($request->from) && !empty($request->from)) {
            $query->where('from', '>=', date('Y-m-d H:i:s', strtotime($request->from)));
        }
        if (isset($request->to) && !empty($request->to)) {
            $query->where('to', '<=', date('Y-m-d H:i:s', strtotime($request->to)));
        }
        if (isset($request->countries) && !empty($request->countries)) {
            $query->join('call_countries', 'calls.id', '=', 'call_countries.call_id')
                ->join('countries_details', 'call_countries.country_id', '=', 'countries_details.id')
                ->where('call_countries.country_id', $request->countries)
                ->select('calls.*', 'call_countries.*', 'countries_details.name as country_name', 'countries_details.id');
        }
        $query->orderBy('calls.id', 'DESC');
        $calls = $query->paginate(20);
//        dd($calls);
        return view('site.calls.index', compact('calls', 'page_title', 'parent_title', 'for', 'place'));
    }

    public function viewCallInSite($call_id)
    {
        $call = Call::callByid($call_id);
        $for = ['v' => ' Volunteers', 'i' => 'Intern', 'e' => 'Employee'];
        $place = ['b' => 'Online and Offline', 'o' => 'Online', 'f' => 'Offline'];
        $genders = ['f' => 'Female', 'm' => 'Male', 'b' => 'Both'];
        $parent_title = 'Calls';
        $page_title = $call->title;
        $list = 'Calls';
        $country = Country::where('id', auth()->user()->country->id)->first();
        $url = 'country/calls/' . auth()->user()->country->id . '/1';
        return view('site.calls.single_call', compact('list', 'url', 'country', 'call', 'parent_title', 'page_title', 'for', 'place', 'genders'));
    }

    public function callsOwnerFilter($type)
    {
        $query = Call::where('active', 1);
        if ($type == '') {

        }

    }
}
