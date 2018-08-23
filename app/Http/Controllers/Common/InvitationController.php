<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Common\orgchecks\Organization;
use App\Http\Controllers\Controller;
use App\Mail\InviteFriendEmail;
use App\Models\contactPerson;
use App\Models\Countries;
use App\Models\OrganizationDescription;
use App\Models\OrganizationPhonesFaxes;
use App\Models\Organizations;
use App\Models\City;
use App\Models\Country;
use App\Models\invitation;
use App\Models\User;
use App\Notifications\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class InvitationController extends Controller
{
    public $errors = [];
    public $cv;
    public $other_docs;
    public $status = true;

    /**
     * @param $org_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invitations()
    {
        $parent_title = 'Organization';
        $page_title = 'Invitation';
        $countries = Country::all()->pluck('name', 'id')->toArray();
        $user = User::where('id', auth()->user()->id)->first();
        $organization = OrganizationDescription::where('login_email', $user->email)->with('Organizations')->first();

        return view('site.country.invite', compact('organization', 'countries', 'parent_title', 'page_title'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveInvitation(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $organization = OrganizationDescription::where('login_email', $user->email)->with('Organizations')->first();

        $this->validate($request, [
            'email' => 'required',
//            'org_name' => 'required',
            'country_id' => 'required',
            'subj_name' => 'required',
            'content' => 'required'
        ]);
        $submitted_data = $request->all();

        $submitted_data['org_name'] = $organization->Organizations->org_name;
        Invitation::create($submitted_data);

        if ($submitted_data['user_type'] == 3 || $submitted_data['user_type'] == 2)
            $data = 'http://dev.oyounmasr.com/invite/invite-app';
        elseif ($submitted_data['user_type'] == 1)
            $data = 'http://dev.oyounmasr.com/company/register';
        elseif ($submitted_data['user_type'] == 0)
            $data = 'http://dev.oyounmasr.com/changemakers/register';

        Mail::to($submitted_data['email'])->send(new InviteFriendEmail($data));

        return redirect('/')->with('status', 'Invitation sent success');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function inviteApplication()
    {
        $parent_title = 'Invitation';
        $page_title = 'Application Form';
        $countries = Country::all()->pluck('name', 'id')->toArray();

        return view('site.country.application_form', compact('countries', 'parent_title', 'page_title'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function saveCountryApplication(Request $request)
    {

        $this->validate($request, [
            'country_id' => 'required',
            'org_name' => 'required',
            'email' => 'required|email|unique:Organizations',
            'belong_to' => 'required',
            'org_type' => 'required',
            'status' => 'required',
            'address' => 'required',
            'manager_name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'selected_by' => 'required',
            'suggested_contribution' => 'required',
//            'support_us' => 'required',
            'check_social' => 'required',
            'login_email' => 'required',
            'login_Password' => 'required',
            'agree' => 'required',
            'about_us' => 'required',
            'services_desc' => 'required',
            'logo' => 'required',
            'postal_code' => 'required'
        ]);

        $data = $request->all();
        if (Organization::checkOnline($data['website']) == false || Organization::checkOnline($data['p_link']) == false) {
            \Session::flash('message', 'Enter a Valid website');
            return redirect()->back();
        }

        DB::beginTransaction();
        $returned_inputs = [];

        if (isset($request->contact_person) && !empty($request->contact_person) && count($request->contact_person) >= 1) {
            $returned_inputs['contact_person'] = $request->contact_person;
        }

        if (isset($request->contact_phone) && !empty($request->contact_phone) && count($request->contact_phone) >= 1) {
            $returned_inputs['contact_phone'] = $request->contact_phone;
        }

        try {
            if ((isset($data['city_id']) && !filter_var($data['city_id'], FILTER_VALIDATE_INT)) && isset($data['city_name'])) {
                $last_city = City::orderBy('id', 'DESC')->first();
                $city = new City();
                $city->id = $last_city->id + 1;
                $city->name = $data['city_name'];
                $city->country_id = $data['country_id'];
                $city->saveOrFail();
                $data['city_id'] = $city->id;
            }
        } catch (\Exception $e) {
            DB::rollback();
        }
        //fill data of organization
        $organization = new Organizations();

        try {
            $organization = $organization->saveOragnizationDetails($data);
        } catch (\Exception $e) {
            DB::rollback();
        }
        //fill data of organization_description
        try {
            $Organization_description = OrganizationDescription::storeCountry($request, $organization->id);
        } catch (\Exception $e) {
            DB::rollback();
        }

        if (isset($Organization_description['status']) && $Organization_description['status'] == false) {
            $this->status = true;
            $this->errors = array_merge($this->errors, $Organization_description['errors']->toArray());
        }
        try {
            $person = new contactPerson;
            $contact_person = $person->storeContactPerson($request, $organization->id);
        } catch (Exception $e) {
            DB::rollback();
        }
        try {
            OrganizationPhonesFaxes::storeContactnumbers($request, $organization->id);
        } catch (Exception $e) {
            DB::rollback();
        }
        DB::commit();

        if (isset($data['city_name'])) {
            auth()->user()->notify(new Notifications('There was inset new city ', $organization->id));
        }

        \Session::flash('message', 'Created Successfully');
        return redirect('/');
    }
}
