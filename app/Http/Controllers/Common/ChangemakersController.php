<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Validator;
use Session;
use App\Models\User;
use App\Models\Changemaker;
use App\Models\UserInterest;
use App\Models\WorkExperience;
use App\Models\UserEducation;
use App\Models\Language;
use Auth;
use App\Models\City;
use App\Models\MakerPreferredDay;
use Illuminate\Support\Facades\DB;
use Hash;

class ChangemakersController extends Controller
{
    //
    public $errors = [];
    public $profile;
    public $last_user;
    public $cv;
    public $other_docs;
    public $cover_letter;
    public $status = true;
    public $sectors = ['2' => 'Accounting', '3' => 'Advertising', '4' => 'Agricultural crops',
        '5' => 'Airline', '6' => 'Artistic works', '7' => 'Automotive and spare parts',
        '8' => 'Biotechnology', '9' => 'Brokerage', '10' => 'Building materials and refractories',
        '11' => 'Call Centers', '12' => 'Chemicals', '14' => 'Clothes &amp; Accessories',
        '15' => 'Construction and building', '16' => 'Consulting', '17' => 'Cosmetics', '18' => 'Defense',
        '19' => 'Education', '20' => 'Electronics and Accessories', '21' => 'Energy', '22' => 'Engineering', '23' => 'Entertainment &amp; Leisure',
        '24' => 'Fertilizers', '25' => 'Financial Services', '26' => 'Food, Beverage and Tobacco', '27' => 'Furniture', '28' => 'Health Care', '29' => 'Home furnishings',
        '30' => 'Investment Banking', '31' => 'Leathers', '32' => 'Legal', '33' => 'Manufacturing', '34' => 'Medical Industries',
        '35' => 'Medicines', '36' => 'Motion Picture and Video', '37' => 'Music', '38' => 'Printing and distribution',
        '39' => 'Real estate investment', '40' => 'Retail and Wholesale', '41' => 'Securities &amp; Commodity Exchanges',
        '42' => 'Services', '43' => 'Soap &amp; Detergent', '44' => 'Software', '45' => 'Sports', '46' => 'Tourism', '47' => 'Transportation', '48' => 'Wood', '49' => 'Yarn and fabric'];

    public function newChangemaker()
    {
        $countries = Country::all()->pluck('name', 'id')->toArray();
        $sectors = $this->sectors;
        $weak_days = ['sun' => 'Sunday', 'mon' => 'Monday', 'tue' => 'Tuesday', 'wed' => 'Wednesday', 'thu' => 'Thursday', 'fri' => 'Friday', 'sat' => 'Saturday'];
        $parent_title = 'Change Makers';
        $page_title = 'Register';
        $cities = City::all()->pluck('name','country_id', 'id')->toArray();
        return view('site.changemakers.register', compact('countries', 'cities','sectors', 'weak_days', 'parent_title', 'page_title'));
    }

    public function storeChangemaker(Request $request)
    {
        DB::beginTransaction();
        $returned_inputs = [];

        if (isset($request->edu) && !empty($request->edu) && count($request->edu) >= 1) {
            $returned_inputs['edu'] = $request->edu;
        }

        if (isset($request->work) && !empty($request->work) && count($request->work) >= 1) {
            $returned_inputs['work_inputs'] = $request->work;
        }

        if (isset($request->lang) && !empty($request->lang) && count($request->lang) >= 1) {
            $returned_inputs['lang_inputs'] = $request->lang;
        }

        // Store in users table

        try {
            $in_user = User::storeUser($request);
        } catch (Exception $e) {
            DB::rollback();
        }

        if (isset($in_user['status']) && $in_user['status'] == false) {
            $this->status = true;
            $this->errors = array_merge($this->errors, $in_user['errors']->toArray());
            return redirect()->back()->with('returned_inputs', $returned_inputs)->withInput($request->all())->withErrors($this->errors);
        }

        // store in changemakers table

        try {
            
            $in_changemaker = ChangeMaker::storeChangeMaker($request);
        } catch (Exception $e) {
            DB::rollback();
        }

        if (isset($in_changemaker['status']) && $in_changemaker['status'] == false) {
            $this->status = true;
            $this->errors = array_merge($this->errors, $in_changemaker['errors']->toArray());
        }

        // Store user interests

        try {
            if (isset($request->sector_interestes) && count($request->sector_interestes) >= 1) {
                foreach ($request->sector_interestes as $interest) {
                    $interest = UserInterest::storeUserInterest($interest, $in_user->id);
                }
            }

        } catch (Exception $e) {
            DB::rollback();
        }

        // Store User Education

        try {
            $user_education = UserEducation::storeUserEducation($request);
        } catch (Exception $e) {
            DB::rollback();
        }

        // store Work experience

        try {
//            DB::rollback();
//            dd($in_changemaker);
            $user_work = WorkExperience::storeWorkExperience($request, $in_changemaker->id);
        } catch (Exception $e) {
        }

        // Languages

        try {
            $languages = Language::storeLanguages($request, $in_changemaker->id);
        } catch (Exception $e) {
            DB::rollback();
        }

        try {
            $days = MakerPreferredDay::storeDays($request, $in_changemaker->id);
        } catch (Exception $e) {
            DB::rollback();
        }


        if (!empty($this->errors) && $this->status === true) {
            Session::put('returned_inputs', $returned_inputs);
            return redirect()->back()->with('returned_inputs', $returned_inputs)->withInput($request->all())->withErrors($this->errors);
        }

        DB::commit();
        Auth::login($in_user);
        Session::flash('message', 'Created Successfully');
        return redirect()->route('changemaker');


    }

    public function changeMakerAccount()
    {
        $user = Auth::user();
        $changemaker = Changemaker::getChangeMakerByUserId($user->id);
        $countries = Country::all()->pluck('name', 'id')->toArray();
        $cities = City::countyCities($changemaker->country_id)->toArray();
        $sectors = $this->sectors;
        $user_interests = UserInterest::userInterests($user->id)->pluck('interest_id', 'interest_id')->toArray();
        return view('site.changemakers.settings', compact('user', 'changemaker', 'countries', 'cities', 'sectors', 'user_interests'));
        // dd(Auth::user());
    }

    public function updateChangeMakerAccount(Request $request)
    {
//        dd($request->all(),'update');
        $auth_maker = Changemaker::loggedInMaker();
        $rules = [
            'last_name' => 'required|min:3',
            'first_name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id . '|unique:changemakers,email,' . $auth_maker->id,
            'private_link' => 'required|unique:changemakers,private_link,' . $auth_maker->id,
            'job_title' => 'required',
            'country_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'address' => 'required',
            'phone' => 'required',
            'nationality' => 'required',
            'gender' => 'required',
            'birth_date' => 'required|date',
            'work_hours' => 'required|numeric',
            'work_place' => 'required',
            'work_time_from' => 'required',
            'work_time_to' => 'required',
            'interests' => 'required',
            'skills' => 'required',
            'facebook' => 'required|url',
            'linked_in' => 'required|url',
            'sector_interests' => 'required',
            'profile' => 'image|mimes:png,jpg,jpeg',
            'other_doc' => 'mimes:pdf,png,jpg,jpeg,xls,docx,doc',
            'cv' => 'mimes:pdf,png,jpg,jpeg,xls,docx,doc',
            'cover_letter' => 'mimes:pdf,png,jpg,jpeg,xls,docx,doc'
        ];

        // Validation
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        //  Get Files Names To use later
        $this->getFilesNames($request);

        // Start Transaction
        DB::beginTransaction();

        // store in users table
        if (!$user = $this->storeInUsersTable($request, Auth::user()->id)) {
            $this->status = false;
            $this->error = 'store in users';
            DB::rollBack();
        }

        // Store in Changemakers Table
        try {
            $request->merge(['user_id' => $user->id]);
            $changemaker = Changemaker::newRecord($request, $auth_maker->id);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->status = false;
            $this->error = 'store in Change-Makers table';
            return $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile();
        }

        // Company Sectors
        if (!$this->storeChangeMakerInterests($request, $changemaker)) {
            $this->status = false;
            $this->error = 'store Company Faxes';
            DB::rollBack();
        }

        // upload Files
        if (!$this->uploadFiles($request)) {
            $this->status = false;
            $this->error = 'Upload Files';
            DB::rollBack();
        };

        DB::commit();

        if ($this->status === false) {
            dd('failed', $this->error);
        }


        Session::flash('message', 'Updated successfully');
        return redirect()->back();

    }

    //     store Company in users table function
    private function storeInUsersTable($request, $id = null)
    {

        try {
            $user_data = [];
            $user_data['name'] = $request->first_name . '' . $request->last_name;
            $user_data['email'] = $request->email;
            $user_data['type'] = Auth::user()->type;
            $user_data['password'] = $request->password;
            $user_data['image'] = $this->profile;
            return User::storeRecord($user_data, $id);
        } catch (\Exception $e) {
            die($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }

    //    store ChangeMakers Interests
    private function storeChangeMakerInterests($request, $changemaker, $id = null)
    {
        if (isset($request->sector_interests) && !empty($request->sector_interests)) {
            $interest_ids = UserInterest::select('id')->where('user_id', $changemaker->id)->get()->toArray();
            DB::table('user_interests')->whereIn('id', $interest_ids)->delete();
            foreach ($request->sector_interests as $interest) {
                try {
                    UserInterest::storeRecord(['interest_id' => $interest, 'user_id' => $changemaker->id], $id);
                } catch (Exception $e) {
                    die($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
                }
            }
        }

        return true;
    }

    //    upload files function
    private function uploadFiles($request)
    {

        try {
            if ($request->hasFile('profile')) {
                $request->profile->storeAs('media/profile/', $this->profile, 'public');
            };

            if ($request->hasFile('other_doc')) {
                $request->other_doc->storeAs('media/files/', $this->other_docs, 'public');
            }

            if ($request->hasFile('cv')) {
                $request->other_doc->storeAs('media/files/', $this->other_docs, 'public');
            }

            if ($request->hasFile('cover_letter')) {
                $request->other_doc->storeAs('media/files/', $this->other_docs, 'public');
            }

        } catch (Exception $e) {
            die($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
        return true;
    }

    //    get Files Names
    private function getFilesNames($request)
    {
        try {
            if ($request->hasFile('profile')) {
                $name = str_random(12) . 'change_maker_' . $request->profile->getClientOriginalName();
                $this->profile = $name;
            };

            if ($request->hasFile('other_doc')) {
                $name = str_random(12) . 'change_maker_' . $request->other_doc->getClientOriginalName();
                $this->other_docs = $name;
            }

            if ($request->hasFile('cv')) {
                $name = str_random(12) . 'change_maker_' . $request->other_doc->getClientOriginalName();
                $this->other_docs = $name;
            }

            if ($request->hasFile('cover_letter')) {
                $name = str_random(12) . 'change_maker_' . $request->other_doc->getClientOriginalName();
                $this->other_docs = $name;
            }
        } catch (Exception $e) {
            die($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }
}
