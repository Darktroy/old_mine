<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RoleController;
use App\Models\ContactPerson;
use App\Models\CountriesFollowers;
use App\Models\Country;
use App\Models\OrganizationDescription;
use App\Models\OrganizationPhonesFaxes;
use App\Models\Organizations;
use App\Models\User;
use App\Notifications\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrganizationsController extends Controller
{
    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'num_of_emp' => 'required',
            'num_of_mem' => 'required',
            'suggested_contribution' => 'required',
            'support_us' => 'required',
            'about_us' => 'required',
            'services_desc' => 'required'
        ]);
        $Organization = Organizations::where('id', $id)->with('organizationDetails', 'organizationContacts', 'country', 'city', 'organizationContactPerson')->first();
        DB::beginTransaction();
        $data = $request->all();
        try {
            Organizations::saveUpdateOragnization($data, $id);
            OrganizationDescription::updateOrgDetails($data, $id);
            $i = 1;
            foreach ($Organization->organizationContacts as $contact) {
                OrganizationPhonesFaxes::updateContactnumbers($request->organization_contacts[$i], $contact->id);
                $i++;
            }
            $i = 1;
            foreach ($Organization->organizationContactPerson as $contact) {
                ContactPerson::updateContactPerson($request->organization_contact_person[$i], $contact->id);
                $i++;
            }

        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage() . $e->getLine();
        }
        DB::commit();
        \Session::flash('message', 'Updated Successfully');
        return redirect()->back();
        DB::close();
    }

    public function index($country_id = null, $position = null)
    {
        $list = 'Organizations';
        $url = 'country/organization/index/';
        if (!empty(auth()->user())) {
            $user = User::where('id', Auth::user()->id)->with('organizationDescription', 'country')->first();
            if ($position == 1)
                $country = Country::where('id', $user->country->id)->first();
            else
                $country = Country::where('id', $country_id)->first();
            if ($position == 1) {
                $organizationsDesc = $user->organizationDescription;//->organizations()->paginate(10);
                $organizations = [];
                foreach ($organizationsDesc as $org) {
                    $organizations[] = $org->organizations;
                }
            } else
                $organizations = Organizations::where('accept', 1)->where('country_id', $country_id)->orderBy('org_name', 'ASC')->paginate(10);
            $links = [
                'all' => ['status' => 'active', 'url' => url('country/organization/index/' . $country_id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
//                'new' => ['status' => '', 'url' => url('invite/invite-app'), 'name' => 'New', 'icon' => ' icon-plus2']
            ];

            return view('site.country.organization.index', compact('country', 'url', 'list', 'position', 'country_id', 'links', 'organizations', 'user'));
        } else {
            $country = Country::where('id', $country_id)->first();
            $links = [
                'all' => ['status' => 'active', 'url' => url('country/organization/index/' . $country_id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            ];
            $organizations = Organizations::where('accept', 1)->where('country_id', $country_id)->orderBy('org_name', 'ASC')->paginate(10);

            return view('site.country.organization.index', compact('country', 'url', 'list', 'position', 'country_id', 'links', 'organizations'));
        }
    }

    public function filterOrganization($letter, $country_id)
    {
        $parent_title = 'Home';
        $page_title = 'Organization';
        $list = 'Organizations';
        $url = 'country/organization/index/';
        $country = Country::where('id', $country_id)->first();
        $organization = Organizations::where('accept', 1)
            ->where('org_name', 'like', '%' . $letter . '%')
            ->where('country_id', $country_id)
            ->orderBy('org_name', 'ASC')
            ->paginate(20);
        if (!empty(auth()->user())) {

            $links = [
                'all' => ['status' => 'active', 'url' => url('organization/index/' . $country_id), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
//                'new' => ['status' => '', 'url' => url('organization/create'), 'name' => 'New', 'icon' => ' icon-plus2']
            ];
        } else {
            $links = [
                'all' => ['status' => 'active', 'url' => url('organization/index/' . $country_id), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            ];
        }

        return view('site.country.organization.index', compact('country', 'url', 'list', 'links', 'organization', 'page_title', 'parent_title'));
    }

    /**
     * @param $id
     * @param null $country_id
     * @param null $position
     */
    public function view($id, $country_id = null, $position = null)
    {
        $parent_title = 'Countries';
        $sub_title = 'view';
        $list = 'Organizations';
        $url = 'country/organization/index/';
        $organization = Organizations::where('id', $id)->with('organizationDetails', 'organizationContacts', 'country', 'city', 'organizationContactPerson')->first();
        $page_title = $organization->org_name;
        if (auth()->user()) {
            $user = User::where('id', $organization->organizationDetails->user->id)->with('country')->first();
            if ($position == 1)
                $country = Country::where('id', $user->country->id)->first();
            else
                $country = Country::where('id', $country_id)->first();

            return view('site.country.organization.view', compact('country', 'url', 'list', 'parent_title', 'sub_title', 'page_title', 'user', 'organization', 'country_id', 'position'));
        } else {
            return redirect('/user/login');
        }
    }

    public function follow($org_id)
    {
        if (!auth()->user()) {
            return redirect('user/login');
        }
        $followed = CountriesFollowers::where('org_id', $org_id)->where('user_id', auth()->user()->id)->first();

        if (!empty($followed)) {
            if ($followed->follow == 0) {
                $followed->follow = 1;
            } else
                $followed->follow = 0;

            $followed->saveOrFail();
        } else {
            $newFollow = new CountriesFollowers();
            $newFollow->org_id = $org_id;
            $newFollow->user_id = auth()->user()->id;
            $newFollow->follow = 1;
            $newFollow->type = auth()->user()->type;

            $newFollow->saveOrFail();
        }

        $orgnization = Organizations::where('id', $org_id)->first();
        $userOrg = User::where('id', $orgnization->user_id)->first();
        if ($userOrg) {
            $userOrg->notify(new Notifications('You have been followed by ' . auth()->user()->name, $org_id));
        } else
            auth()->user()->notify(new Notifications('You have been followed by ' . auth()->user()->name, $org_id));

        return redirect('country/organization/view/' . $org_id)->with('followed success');
    }


    /**
     * @param $id
     */
    public function delete($id)
    {
        $role_permission = new RoleController();
        if (!$role_permission->checkRolePermission("delete_organization")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }

        DB::beginTransaction();
        $crg_disc = OrganizationDescription::find('organization', $id);
        $crg_contact = OrganizationPhonesFaxes::find('organization', $id);
        $crg = Organizations::find('id', $id);
        try {
            $crg_disc->delete();
            $crg_contact->delete();
            $crg->delete();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
        DB::commit();
    }

    public function followOrganization($org_id, $offer_id = null, $country_id = null)
    {
        if (!auth()->user()) {
            return redirect('user/login');
        }
        $followed = CountriesFollowers::where('org_id', $org_id)->where('user_id', auth()->user()->id)->first();

        if (!empty($followed)) {
            if ($followed->follow == 0) {
                $followed->follow = 1;
            } else
                $followed->follow = 0;

            $followed->saveOrFail();
        } else {
            $newFollow = new CountriesFollowers();
            $newFollow->org_id = $org_id;
            $newFollow->user_id = auth()->user()->id;
            $newFollow->follow = 1;
            $newFollow->type = auth()->user()->type;

            $newFollow->saveOrFail();
        }

        if (isset($offer_id))
            return redirect('/offers/view/' . $offer_id)->with('followed success');
        else
            return redirect('country/organization/index/' . $country_id)->with('followed success');
    }
}