<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Mail\InviteFriendEmail;
use App\Models\ContactPerson;
use App\Models\Countries;
use App\Models\Country;
use App\Models\OrganizationDescription;
use App\Models\OrganizationPhonesFaxes;
use App\Models\Organizations;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Mockery\Exception;

class ApplicationsController extends Controller
{
    public function index()
    {
        $applications = Organizations::where('accept', '0')->get();
        $page_title = 'Applications';
        $sub_title = 'List All Applications';
        $search = true;

        return view('panel.applications.index', compact('applications', 'sub_title', 'page_title', 'search'));
    }

    /**
     * @param $id
     */
    public function view($id)
    {
        $page_title = 'Applications';
        $sub_title = 'View Application details';
        $search = true;

        $applications = Organizations::where('id', $id)->first();
        $app_details = OrganizationDescription::where('organization', $id)->first();
        $contact_persons = ContactPerson::where('organization', $id)->get();
        $contact_phones = OrganizationPhonesFaxes::where('organization', $id)->get();
        $country_cities = DB::table('organizations')
            ->select('cities.name as city_name', 'countries_details.name as country_name')
            ->join('countries_details', 'countries_details.id', '=', 'organizations.country_id')
            ->join('cities', 'cities.id', '=', 'organizations.city_id')
            ->where(['organizations.id' => $id])
            ->get();

        return view('panel.applications.view', compact('applications', 'app_details', 'contact_persons', 'contact_phones', 'country_cities', 'sub_title', 'page_title', 'search'));
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $application = OrganizationDescription::where('organization', $id)->first();
        $name = Organizations::where('id', $id)->first();

        DB::beginTransaction();
        try {
            $name->accept = 1;
            $name->saveOrFail();
        } catch (Exception $e) {
            DB::rollback();
        }

        $user = new User();
        try {
            $user->name = $name->first_name;
            $user->email = $application->login_email;
            $user->password = bcrypt($application->login_password);
            $user->type = 1;
            $user->saveOrFail();

        } catch (Exception $e) {
            DB::rollback();
        }

        try {
            $last_country = Country::orderBy('id', 'DESC')->first();
            $countries = Countries::where('id', $name->country_id)->first();

            $country = new Country();
            $country->id = $last_country->id + 1;
            $country->name = $countries->name1;
            $country->nationality = $countries->nationality;
            $country->flag = $countries->flag;
            $country->user_id = $user->id;
            $country->saveOrFail();

            $data = URL::to('user/login');
            Mail::to($user->email)->send(new InviteFriendEmail($data));
        } catch (\Exception $e) {
            DB::rollback();
        }

        DB::commit();

        return redirect(url('panel/application/index'))->with('status', 'Invitation Accept success');
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            OrganizationDescription::where('organization', $id)->delete();
        } catch (\Exception $e) {
            DB::rollback();
        }
        try {
            contactPerson::where('organization', $id)->delete();
        } catch (\Exception $e) {
            DB::rollback();
        }
        try {
            OrganizationPhonesFaxes::where('organization', $id)->delete();
        } catch (\Exception $e) {
            DB::rollback();
        }
        try {
            Organizations::where('id', $id)->delete();
        } catch (\Exception $e) {
            DB::rollback();
        }

        DB::commit();

        return redirect(url('panel/application/index'))->with('status', 'Invitation Deleted success');
    }

    /**
     * @param $litter
     */
    public function getCountriesByFirstLetter($litter)
    {
        $page_title = 'Countries';
        $sub_title = 'List All Countries';
        $parent_title = 'Countries';
        $search = true;
        $country_search = DB::table('organizations')
            ->select('cities.name as city_name', 'countries.name1 as country_name')
            ->join('countries', 'countries.id', '=', 'organizations.country_id')
            ->join('cities', 'cities.id', '=', 'organizations.city_id')
            ->where('countries.name1', 'like', $litter . '%')
            ->orWhere('cities.name', 'like', $litter . '%')
            ->andWhere(['organizations.accept' => 0])
            ->OrderBy('cities.name', 'ASC')
            ->OrderBy('countries.name', 'ASC')
            ->paginate(9);
    }
}
