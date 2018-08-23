<?php

namespace App\Http\Controllers\Common;


use App\Http\Controllers\RoleController;
use App\Notifications\Notifications;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//  Facades
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Session;
use Validator;
use Auth;
use JavaScript;
use App\Helpers\Euromed\Euromed;

//  Models
use App\Models\{
    CallCountry, Countries, CountriesFollowers, Message, OfferCountry, OrganizationDescription, Organizations, RolesUsers, Sponser, User, Country, Offer, City, Category, Call, Event, Agreement, News, Post, Tag, OfferActivity, Role, Permission, UsersCountries
};


class CountriesController extends Controller
{
    //
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $page_title = 'All Countries';
        $sub_title = 'List All Countries';
        $parent_title = 'Countries';
        $search = true;
        $countries = Country::OrderBy('name', 'ASC')->paginate(18);

        if (!empty(auth()->user())) {
            if (auth()->user()->type == 0) {
                return view('panel.countries.index', compact('page_title', 'sub_title', 'search', 'countries', 'parent_title'));
            }
        }

        return view('site.country.index', compact('page_title', 'sub_title', 'search', 'countries', 'parent_title'));

    }

    /**
     * @param $litter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCountriesByFirstLetter($litter)
    {
        $page_title = 'Countries';
        $sub_title = 'List All Countries';
        $parent_title = 'Countries';
        $search = true;
        $countries = Country::where('name', 'like', $litter . '%')->OrderBy('name', 'ASC')->paginate(9);
        return view('site.country.index', compact('page_title', 'sub_title', 'search', 'countries', 'parent_title'));
    }

    public function viewCountry(Request $request, $id)
    {
        $country = Country::where('id', $id)->first();
        $sponsers = Sponser::where('status', 1)->get();
        $page_title = 'All Countries';
        $sub_title = 'View Country';
        $parent_title = 'Countries';
        $search = false;

        $position = 2;

        if ($request->ajax()) {
            return $country;
        }

        if ($country) {
            $country_id = $id;
            if (!empty(auth()->user())) {
                $user = User::where('id', Auth::user()->id)->first();
                $followed = CountriesFollowers::where('country_id', $country_id)->where('user_id', auth()->user()->id)->first();
                $count = CountriesFollowers::where('country_id', $country_id)->where('follow', 1)->get()->count();
                if (!empty($followed) && $followed->follow == 1) $follow = 1;
                else $follow = 0;

                $role_permission = new RoleController();
                $country_admin = true;
                if (!$role_permission->checkRolePermission("country_admin")) {
                    $country_admin = false;
                }

                $links = [
                    'all' => ['status' => 'active', 'url' => url('countries'), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
//                    'new' => ['status' => '', 'url' => url('invite/invite-app'), 'name' => 'New', 'icon' => ' icon-plus2']
                ];
                if (auth()->user()->type == 0) {
                    return view('panel.countries.single', compact('follow', 'count', 'position', 'country_id', 'links', 'user', 'country', 'sponsers', 'page_title', 'sub_title', 'parent_title', 'search'));
                } else {
                    return view('site.country.view', compact('country_admin', 'count', 'follow', 'position', 'country_id', 'links', 'user', 'country', 'sponsers', 'page_title', 'sub_title', 'parent_title', 'search'));
                }
            }
            $links = [
                'all' => ['status' => 'active', 'url' => url('countries'), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            ];
            return view('site.country.view', compact('position', 'country_id', 'links', 'country', 'sponsers', 'page_title', 'sub_title', 'parent_title', 'search'));

        } else {
            Session::flash('message', 'Country Not Found');
            return redirect()->route('countries');
        }
    }

    public function editCountry($id)
    {
        $page_title = 'Countries';
        $sub_title = 'Edit';
        $search = false;
        $country = Country::where('id', $id)->first();
        return view('panel.countries.edit', compact('country', 'page_title', 'sub_title', 'search'));
    }

    public function updateCountry(Request $request, $id)
    {
        // dd($request->all());
        $role_permission = new RoleController();
        if (!$role_permission->checkRolePermission("update_country")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }

        //  Country object
        if (auth::user()->type == 1) {
            $country = Country::where('user_id', $id)->first();
        } else {
            $country = Country::where('id', $id)->first();
        }

        // User Object
        $user = User::where('id', $country->user_id)->first();

        // Validation

        $rules = ['name' => 'required|min:2', 'flag' => 'image', 'description' => 'required|min:6'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Flag Image Handling
//        if ($request->hasFile('flag')) {
//            $name = str_random(12) . 'flag_' . $request->flag->getClientOriginalName();
//            $request->flag->storeAs('media/flags/', $name, 'public');
//            $country->flag = $name;
//            $user->image = $name;
//        }

        // Password
//        if (isset($request->password)) {
//            $user->password = bcrypt($request->password);
//        }

        // Assign Inputs [email,name,nationality]
//        $user->email = $request->email;
        $country->nationality = $request->nationality;
        $country->name = $request->name;
        $country->description = $request->description;
//        $user->name = $request->name;
        $country->phone_code = $request->phone_code;

        if ($country->save()) {

            Session::flash('message', 'Updated Successfully');

            if (Auth::user()->type == 1) {
                return redirect()->back();
            }
            return redirect()->route('countries');
        } else {
            Session::flash('message', 'Failed To Update Country');
            return redirect()->back();
        }

    }

    public function countryAccount()
    {
        $user = User::where('id', Auth::user()->id)->with('country')->first();
        $role_permission = new RoleController();
        $country_admin = true;
        if (!is_bool($role_permission->checkRolePermission("country_admin"))) {
            $country_admin = false;
        }
        $position = 1;

        $details = OrganizationDescription::where('login_email', $user->email)->with('organizations')->first();
        $country = Country::where('id', $user->country->id)->first();
        $links = [
            'Settings' => ['status' => 'active', 'url' => url('country/account'), 'name' => 'Settings', 'icon' => ' icon-cog3']];
        return view('site.country.account', compact('country', 'details', 'country_admin', 'position', 'user', 'links'));
    }

    //  List All Calls
    public function viewAllCalls($country_id = null, $position = null)
    {
//        $role_permission = new RoleController();
//        if (!$role_permission->checkRolePermission("view_call")) {
//            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
//            return redirect()->back()->with('You do not have permission to access this method', 403);
//        }

        $looking_for = ['v' => ' Volunteers', 'i' => 'Intern', 'e' => 'Employee'];
        $place = ['b' => 'Online and Offline', 'o' => 'Online', 'f' => 'Offline'];
        $list = 'Calls';
        $url = 'country/calls/';
        if (Auth::user()) {
            $user = User::where('id', Auth::user()->id)->with('country', 'calls')->first();
            if ($position == 1) {
                $country = Country::where('id', $user->country->id)->first();
                $country_id = $user->country->id;
                $calls = $user->calls()->latest()->paginate(10);
            } else {
                $country = Country::where('id', $country_id)->first();
                $calls = CallCountry::where('country_id', $country_id)->with(['calls' => function ($query) {
                    $query->orderBy('created_at', 'DESC');
                }])->first();
                if (!empty($calls))
                    $calls = $calls->calls()->paginate(10);
            }


            JavaScript::put([
                'calls' => $calls,
                'looking_for' => $looking_for,
                'places' => $place
            ]);

            $links = [
                'all' => ['status' => 'active', 'url' => url('country/calls/' . $country_id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
                'new' => ['status' => '', 'url' => url('country/calls/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
            ];
            return view('site.country.calls.index', compact('country', 'url', 'list', 'position', 'country_id', 'links', 'user', 'calls', 'looking_for', 'place'));
        } else {
            $country = Country::where('id', $country_id)->first();
            $calls = CallCountry::where('country_id', $country_id)->with(['calls' => function ($query) {
                $query->orderBy('created_at', 'DESC');
            }])->first();

            if (!empty($calls))
                $calls = $calls->calls()->paginate(10);

            JavaScript::put([
                'calls' => $calls,
                'looking_for' => $looking_for,
                'places' => $place
            ]);

            $links = [
                'all' => ['status' => 'active', 'url' => url('country/calls/' . $country_id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
                'new' => ['status' => '', 'url' => url('country/calls/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
            ];

            return view('site.country.calls.index', compact('country', 'url', 'list', 'position', 'country_id', 'links', 'calls', 'looking_for', 'place'));
        }

    }

    //  New Call
    public function newCall($country_id = null, $position = null)
    {
        $role_permission = new RoleController();
        if (!$role_permission->checkRolePermission("create_call")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }
        $list = 'Calls';
        $url = 'country/calls/';
        $new = 'New';
        $country = Country::where('id', $country_id)->first();
        $user = User::where('id', Auth::user()->id)->with('country')->first();
        $links = [
            'all' => ['status' => 'active', 'url' => url('country/calls/' . $country_id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            'new' => ['status' => '', 'url' => url('country/calls/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
        ];
        $cities = City::where('country_id', $user->country->id)->pluck('name', 'id')->toArray();
        $countries = Country::all()->pluck('name', 'id')->toArray();
        return view('site.country.calls.new', compact('country', 'url', 'list', 'new', 'position', 'country_id', 'links', 'user', 'countries', 'cities'));
    }

    //  Country Edit Calls
    public function editCall($id, $country_id = null, $position = null)
    {
        $role_permission = new RoleController();
        $list = 'Calls';
        $url = 'country/calls/';
        $edit = 'Edit';
        $country = Country::where('id', $country_id)->first();
        if (!$role_permission->checkRolePermission("update_call")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }
        $user = User::where('id', Auth::user()->id)->with('country')->first();
        $links = [
            'all' => ['status' => 'active', 'url' => url('country/calls/' . $country_id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            'new' => ['status' => '', 'url' => url('country/calls/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
        ];
        $call = Call::where('id', $id)->where('user_id', auth()->user()->id)->with('callCountries', 'callCities')->first();
        $cities = City::where('country_id', $user->country->id)->pluck('name', 'id')->toArray();
        $countries = Country::all()->pluck('name', 'id')->toArray();
        return view('site.country.calls.edit', compact('country', 'url', 'list', 'edit', 'position', 'country_id', 'links', 'user', 'call', 'cities', 'countries'));
    }

    //  Get Country Cities
    public function getCities(Request $request, $id = null)
    {
        $cities = '';
        $country = '';

        if ($id != null) {
            $country = $this->viewCountry($request, $id);
            $cities = City::where('country_id', $id)->get()->pluck('name', 'id');
        } else {
            $cities = City::whereIn('country_id', $request->countries_id)->get()->pluck('name', 'id');
        }

        if ($request->ajax()) {
            return response(['cities' => $cities->toArray(), 'country' => $country]);
        }

        return $cities;
    }

    public function listCountriesAjax(Request $request)
    {
        $countries = Country::all();
        if ($request->json) {
            return response(['countries' => $countries]);
        }
        return $countries;
    }

    //  List All Topics
    public function listTopics($country_id = null, $position = null)
    {
        $list = 'Topics';
        $url = 'country/topics/';
        if (!empty(auth()->user())) {
            $user = User::where('id', Auth::user()->id)->with('country')->first();
            if ($position == 1) {
                $country = Country::where('id', $user->country->id)->first();
                $country_id = $user->country->id;
            } else
                $country = Country::where('id', $country_id)->first();
            $links = [
                'all' => ['status' => 'active', 'url' => url('country/topics/' . $user->country->id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
                'new' => ['status' => '', 'url' => url('country/topics/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
            ];
            if ($position == 1)
                $topics = post::where('user_id', $user->id)->orderBy('created_at', 'DESC')->with('country')->paginate(10);
            else
                $topics = post::where('country_id', $country_id)->orderBy('created_at', 'DESC')->with('user')->paginate(10);

            return view('site.country.topics.index', compact('country', 'url', 'list', 'position', 'country_id', 'links', 'user', 'topics'));
        } else {
            $country = Country::where('id', $country_id)->first();
            $links = [
                'all' => ['status' => 'active', 'url' => url('country/topics'), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            ];

            $topics = post::where('country_id', $country_id)->orderBy('created_at', 'DESC')->with('user')->paginate(10);

            return view('site.country.topics.index', compact('country', 'url', 'list', 'position', 'country_id', 'links', 'topics'));
        }
    }

    //  Create new Topic
    public function newTopic($country_id = null, $position = null)
    {
        $role_permission = new RoleController();
        $list = 'Topics';
        $url = 'country/topics/';
        $new = 'New';
        if (!$role_permission->checkRolePermission("create_post")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }
        $user = User::where('id', Auth::user()->id)->with('country')->first();
        if ($position == 1) {
            $country = Country::where('id', $user->country->id)->first();
            $country_id = $user->country->id;
        } else
            $country = Country::where('id', $country_id)->first();
        $links = [
            'all' => ['status' => 'active', 'url' => url('country/topics/' . $user->country->id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            'new' => ['status' => '', 'url' => url('country/topics/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
        ];
        $categories = Category::pluck('name', 'id');
        $posts_tags = Tag::all()->pluck('tag')->toArray();
        return view('site.country.topics.new', compact('country', 'url', 'list', 'new', 'position', 'country_id', 'links', 'user', 'categories', 'posts_tags'));
    }

    // Edit Topic
    public function editTopic($id, $country_id = null, $position = null)
    {
        $role_permission = new RoleController();
        $list = 'Topics';
        $url = 'country/topics/';
        $edit = 'Edit';
        if (!$role_permission->checkRolePermission("update_post")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }
        $user = User::where('id', Auth::user()->id)->with('country')->first();
        if ($position == 1) {
            $country = Country::where('id', $user->country->id)->first();
            $country_id = $user->country->id;
        } else
            $country = Country::where('id', $country_id)->first();
        $links = [
            'all' => ['status' => 'active', 'url' => url('country/topics/' . $user->country->id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            'new' => ['status' => '', 'url' => url('country/topics/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
        ];
        $categories = Category::pluck('name', 'id');
        $post = Post::find($id);
        $posts_tags = Tag::all()->pluck('tag')->toArray();
        return view('site.country.topics.edit', compact('country', 'url', 'list', 'edit', 'position', 'country_id', 'links', 'user', 'categories', 'posts_tags', 'post', 'posts_tags'));

    }

    //  List All Country News
    public function listNews($country_id = null, $position = null)
    {
        $list = 'News';
        $url = 'country/news/';

        if (!empty(Auth::user())) {
            $user = User::where('id', Auth::user()->id)->with('country')->first();
            if ($position == 1) {
                $country = Country::where('id', $user->country->id)->first();
                $country_id = $user->country->id;
            } else
                $country = Country::where('id', $country_id)->first();
            $links = [
                'all' => ['status' => 'active', 'url' => url('country/news/' . $user->country->id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
                'new' => ['status' => 'active', 'url' => url('country/news/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
            ];

            if ($position == 1)
                $news = News::where('user_id', $user->id)->orderBy('created_at', 'DESC')->with('country')->paginate(10);
            else
                $news = News::where('country_id', $country_id)->orderBy('created_at', 'DESC')->with('user')->paginate(10);
            return view('site.country.news.index', compact('country', 'url', 'list', 'position', 'country_id', 'links', 'user', 'news'));
        } else {
            $country = Country::where('id', $country_id)->first();
            $links = [
                'all' => ['status' => 'active', 'url' => url('country/news/' . $country_id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            ];

            $news = News::where('country_id', $country_id)->orderBy('created_at', 'DESC')->with('user')->paginate(10);
            return view('site.country.news.index', compact('country', 'url', 'list', 'position', 'country_id', 'links', 'news'));
        }
    }

    //  Add New News
    public function newNews($country_id = null, $position = null)
    {
        $role_permission = new RoleController();
        $list = 'News';
        $url = 'country/news/';
        $new = 'New';
        if (!$role_permission->checkRolePermission("create_news")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }
        $user = User::where('id', Auth::user()->id)->with('country')->first();
        if ($position == 1) {
            $country = Country::where('id', $user->country->id)->first();
            $country_id = $user->country->id;
        } else
            $country = Country::where('id', $country_id)->first();
        $links = [
            'all' => ['status' => 'active', 'url' => url('country/news/' . $user->country->id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            'new' => ['status' => 'active', 'url' => url('country/news/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
        ];
        return view('site.country.news.new', compact('country', 'url', 'list', 'new', 'position', 'country_id', 'links', 'user', 'news'));
    }

    //  Edit News
    public function editNews($id, $country_id = null, $position = null)
    {
        $role_permission = new RoleController();
        $list = 'News';
        $url = 'country/news/';
        $edit = 'Edit';
        if (!$role_permission->checkRolePermission("update_news")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }
        $user = User::where('id', Auth::user()->id)->with('country')->first();
        if ($position == 1) {
            $country = Country::where('id', $user->country->id)->first();
            $country_id = $user->country->id;
        } else
            $country = Country::where('id', $country_id)->first();
        $links = [
            'all' => ['status' => 'active', 'url' => url('country/news/' . $user->country->id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            'new' => ['status' => 'active', 'url' => url('country/news/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
        ];
        $news = News::find($id);
        return view('site.country.news.edit', compact('country', 'url', 'list', 'edit', 'position', 'country_id', 'links', 'user', 'news'));

    }


    //  List All Agreements
    public function listAgreements($country_id = null, $position = null)
    {
        $list = 'Agreements';
        $url = 'country/agreements/';
        if (!empty(Auth::user())) {
            $user = User::where('id', Auth::user()->id)->with('country')->first();
            if ($position == 1) {
                $country = Country::where('id', $user->country->id)->first();
                $country_id = $user->country->id;
            } else
                $country = Country::where('id', $country_id)->first();
            $links = [
                'all' => ['status' => 'active', 'url' => url('country/agreements/' . $user->country->id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
                'new' => ['status' => '', 'url' => url('country/agreements/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
            ];

            if ($position == 1)
                $agreements = Agreement::where('user_id', $user->id)->orderBy('created_at', 'DESC')->with('country')->paginate(10);
            else
                $agreements = Agreement::where('country_id', $country_id)->orderBy('created_at', 'DESC')->with('user')->paginate(10);
            return view('site.country.agreements.index', compact('country', 'url', 'list', 'position', 'country_id', 'links', 'user', 'agreements'));
        } else {
            $country = Country::where('id', $country_id)->first();
            $links = [
                'all' => ['status' => 'active', 'url' => url('country/agreements/' . $country_id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            ];

            $agreements = Agreement::where('country_id', $country_id)->orderBy('created_at', 'DESC')->with('user')->paginate(10);
            return view('site.country.agreements.index', compact('country', 'url', 'list', 'position', 'country_id', 'links', 'agreements'));
        }
    }

    public function newAgreement($country_id = null, $position = null)
    {
        $role_permission = new RoleController();
        $list = 'Agreements';
        $url = 'country/agreements/';
        $new = 'New';
        if (!$role_permission->checkRolePermission("create_agreements")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }
        $user = User::where('id', Auth::user()->id)->with('country')->first();
        if ($position == 1) {
            $country = Country::where('id', $user->country->id)->first();
            $country_id = $user->country->id;
        } else
            $country = Country::where('id', $country_id)->first();
        $links = [
            'all' => ['status' => 'active', 'url' => url('country/agreements/' . $user->country->id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            'new' => ['status' => '', 'url' => url('country/agreements/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
        ];
        return view('site.country.agreements.new', compact('country', 'url', 'list', 'new', 'position', 'country_id', 'links', 'user'));
    }

    public function editAgreement($id, $country_id = null, $position = null)
    {
        $role_permission = new RoleController();
        $list = 'Agreements';
        $url = 'country/agreements/';
        $edit = 'Edit';
        if (!$role_permission->checkRolePermission("update_agreements")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }
        $user = User::where('id', Auth::user()->id)->with('country')->first();
        if ($position == 1) {
            $country = Country::where('id', $user->country->id)->first();
            $country_id = $user->country->id;
        } else
            $country = Country::where('id', $country_id)->first();
        $links = [
            'all' => ['status' => 'active', 'url' => url('country/agreements/' . $user->country->id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            'new' => ['status' => '', 'url' => url('country/agreements/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
        ];
        $agreement = Agreement::find($id);
        return view('site.country.agreements.edit', compact('country', 'url', 'list', 'edit', 'position', 'country_id', 'links', 'user', 'agreement'));
    }


    //  List All Events
    public function listEvents($country_id = null, $position = null)
    {
//        Euromed::authorize('events');
        $list = 'Events';
        $url = 'country/events/';
        if (!empty(auth()->user())) {
            $user = User::where('id', Auth::user()->id)->with('country')->first();

            if ($position == 1) {
                $country = Country::where('id', $user->country->id)->first();
                $country_id = $user->country->id;
            } else
                $country = Country::where('id', $country_id)->first();

            $links = [
                'all' => ['status' => 'active', 'url' => url('country/events/' . $user->country->id . '/' . $position),
                    'name' => 'List All', 'icon' => ' icon-pen-plus'],
                'new' => ['status' => '', 'url' => url('country/events/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
            ];

            if ($position == 1)
                $events = Event::where('user_id', $user->id)->where('country_id', $country_id)->orWhere('user_id', $user->parent_id)->orderBy('created_at', 'DESC')->with('user')->paginate(10);
            else
                $events = Event::where('country_id', $country_id)->where('country_id', $country_id)->orWhere('user_id', $user->parent_id)->orderBy('created_at', 'DESC')->with('user')->paginate(10);
            return view('site.country.events.index', compact('url', 'list', 'country', 'position', 'country_id', 'links', 'user', 'events'));
        } else {
            $country = Country::where('id', $country_id)->first();
            $links = [
                'all' => ['status' => 'active', 'url' => url('country/events/' . $country_id), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            ];

            $events = Event::where('country_id', $country_id)->orderBy('created_at', 'DESC')->paginate(10);
            return view('site.country.events.index', compact('url', 'list', 'position', 'country', 'country_id', 'links', 'events'));
        }
    }

    public function newEvent($country_id = null, $position = null)
    {
        $role_permission = new RoleController();
        $list = 'Events';
        $new = 'New';
        $url = 'country/events/';
        $user = User::where('id', Auth::user()->id)->with('country')->first();
        if ($position == 1) {
            $country = Country::where('id', $user->country->id)->first();
            $country_id = $user->country->id;
        } else
            $country = Country::where('id', $country_id)->first();
        if (!$role_permission->checkRolePermission("create_event")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }
//        Euromed::authorize('events');
        $cities = City::where('country_id', $user->country->id)->pluck('name', 'id')->toArray();
        $links = [
            'all' => ['status' => 'active', 'url' => url('country/events/' . $user->country->id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            'new' => ['status' => '', 'url' => url('country/events/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
        ];
        return view('site.country.events.new', compact('url', 'list', 'new', 'country', 'position', 'country_id', 'links', 'user', 'cities'));
    }

    //  Edit Country Event
    public function editEvent($id, $country_id = null, $position = null)
    {
        $role_permission = new RoleController();
        $list = 'Events';
        $edit = 'Edit';
        $url = 'country/events/';
        if (!$role_permission->checkRolePermission("update_event")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }
//        Euromed::authorize('events');
        $user = User::where('id', Auth::user()->id)->with('country')->first();
        if ($position == 1) {
            $country = Country::where('id', $user->country->id)->first();
            $country_id = $user->country->id;
        } else
            $country = Country::where('id', $country_id)->first();
        $cities = City::where('country_id', $user->country->id)->pluck('name', 'id')->toArray();
        $links = [
            'all' => ['status' => 'active', 'url' => url('country/events/' . $user->country->id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            'new' => ['status' => '', 'url' => url('country/events/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
        ];
        $event = Event::find($id);
        return view('site.country.events.edit', compact('country', 'url', 'list', 'edit', 'country ', 'position', 'country_id', 'links', 'user', 'event', 'cities'));
    }

    //  List All country Offers
    public function viewAllOffers($country_id = null, $position = null)
    {
        $page_title = 'Countries';
        $sub_title = 'List All Offers';
        $parent_title = 'Offers';
        $search = true;
        $list = 'Offers';
        $url = 'country/offers/';
//        Euromed::authorize('offers');

        if (!empty(Auth::user())) {
            $user = User::where('id', Auth::user()->id)->with('country')->first();
            if ($position == 1) {
                $country = Country::where('id', $user->country->id)->first();
                $country_id = $user->country->id;
            } else
                $country = Country::where('id', $country_id)->first();

            $links = [
                'all' => ['status' => 'active', 'url' => url('country/offers/' . $user->country->id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
                'new' => ['status' => '', 'url' => url('country/offers/new/' . $user->country->id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
            ];
            if ($position == 1)
                $offers = Offer::where('user_id', $user->id)
                    ->orWhere('user_id', $user->parent_id)
                    ->orderBy('created_at', 'DESC')
                    ->with('owner', 'offerCountries', 'offerSectors', 'offerType')
                    ->paginate(10);
            else {
                $offers = OfferCountry::where('country_id', $country_id)->with(['offers' => function ($query) {
                    $query->orderBy('created_at', 'DESC');
                }])->first();
                if (!empty($offers))
                    $offers = $offers->offers()->paginate(10);
            }
            return view('site.country.offers.index', compact('country', 'url', 'list', 'events', 'position', 'country_id', 'links', 'user', 'offers', 'page_title', 'sub_title', 'parent_title', 'search'));
        } else {
            $country = Country::where('id', $country_id)->first();
            $links = [
                'all' => ['status' => 'active', 'url' => url('country/offers/' . $country_id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
                'new' => ['status' => '', 'url' => url('country/offers/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
            ];
            $offers = OfferCountry::where('country_id', $country_id)->with(['offers' => function ($query) {
                $query->orderBy('created_at', 'DESC');
            }])->first();
            if (!empty($offers))
                $offers = $offers->offers()->paginate(10);

            return view('site.country.offers.index', compact('country', 'url', 'list', 'position', 'country_id', 'links', 'offers', 'page_title', 'sub_title', 'parent_title', 'search'));
        }
    }

//  New offer
    public
    function newOffer($country_id = null, $position = null)
    {
        $role_permission = new RoleController();

        if (!$role_permission->checkRolePermission("create_offers")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }
        $list = 'Offers';
        $url = 'country/offers/';
        $new = 'New';
//        Euromed::authorize('offers');
        $sectors = ['2' => 'Accounting', '3' => 'Advertising', '4' => 'Agricultural crops',
            '5' => 'Airline', '6' => 'Artistic works', '7' => 'Automotive and spare parts',
            '8' => 'Biotechnology', '9' => 'Brokerage', '10' => 'Building materials and refractories',
            '11' => 'Call Centers', '12' => 'Chemicals', '14' => 'Clothes &amp; Accessories',
            '15' => 'Construction and building', '16' => 'Consulting', '17' => 'Cosmetics', '18' => 'Defense',
            '19' => 'Education', '20' => 'Electronics and Accessories', '21' => 'Energy', '22' => 'Engineering', '23' => 'Entertainment &amp; Leisure',
            '24' => 'Fertilizers', '25' => 'Financial Services', '26' => 'Food, Beverage and Tobacco', '27' => 'Furniture', '28' => 'Health Care', '29' => 'Home furnishings',
            '30' => 'Investment Banking', '31' => 'Leathers', '32' => 'Legal', '33' => 'Manufacturing', '34' => 'Medical Industries',
            '35' => 'Medicines', '36' => 'Motion Picture and Video', '37' => 'Music', '38' => 'Printing and distribution',
            '39' => 'Real estate investment', '40' => 'Retail and Wholesale', '41' => 'Securities &amp; Commodity Exchanges',
            '42' => 'Services', '43' => 'Soap &amp; Detergent', '44' => 'Software', '45' => 'Sports', '46' => 'Tourism', '47' => 'Transportation', '48' => 'Wood', '49' => 'Yarn and fabric'
        ];

        $user = User::where('id', Auth::user()->id)->with('country')->first();
        if ($position == 1) {
            $country = Country::where('id', $user->country->id)->first();
            $country_id = $user->country->id;
        } else
            $country = Country::where('id', $country_id)->first();
        $links = [
            'all' => ['status' => 'active', 'url' => url('country/offers/' . $user->country->id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            'new' => ['status' => '', 'url' => url('country/offers/new/' . $user->country->id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
        ];
        $countries = Country::all()->pluck('name', 'id')->toArray();
        $activities = OfferActivity::all()->pluck('name', 'id')->toArray();
        return view('site.country.offers.new', compact('country', 'url', 'list', 'new', 'position', 'country_id', 'links', 'user', 'sectors', 'activities', 'countries'));
    }

//  Country Edit offers
    public
    function editOffer($id, $country_id = null, $position = null)
    {
        $role_permission = new RoleController();

        if (!$role_permission->checkRolePermission("update offers")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }
        $list = 'Offers';
        $url = 'country/offers/';
        $edit = 'Edit';
//        Euromed::authorize('offers');
        $sectors = ['2' => 'Accounting', '3' => 'Advertising', '4' => 'Agricultural crops',
            '5' => 'Airline', '6' => 'Artistic works', '7' => 'Automotive and spare parts',
            '8' => 'Biotechnology', '9' => 'Brokerage', '10' => 'Building materials and refractories',
            '11' => 'Call Centers', '12' => 'Chemicals', '14' => 'Clothes &amp; Accessories',
            '15' => 'Construction and building', '16' => 'Consulting', '17' => 'Cosmetics', '18' => 'Defense',
            '19' => 'Education', '20' => 'Electronics and Accessories', '21' => 'Energy', '22' => 'Engineering', '23' => 'Entertainment &amp; Leisure',
            '24' => 'Fertilizers', '25' => 'Financial Services', '26' => 'Food, Beverage and Tobacco', '27' => 'Furniture', '28' => 'Health Care', '29' => 'Home furnishings',
            '30' => 'Investment Banking', '31' => 'Leathers', '32' => 'Legal', '33' => 'Manufacturing', '34' => 'Medical Industries',
            '35' => 'Medicines', '36' => 'Motion Picture and Video', '37' => 'Music', '38' => 'Printing and distribution',
            '39' => 'Real estate investment', '40' => 'Retail and Wholesale', '41' => 'Securities &amp; Commodity Exchanges',
            '42' => 'Services', '43' => 'Soap &amp; Detergent', '44' => 'Software', '45' => 'Sports', '46' => 'Tourism', '47' => 'Transportation', '48' => 'Wood', '49' => 'Yarn and fabric'
        ];
        $user = User::where('id', Auth::user()->id)->with('country')->first();
        if ($position == 1) {
            $country = Country::where('id', $user->country->id)->first();
            $country_id = $user->country->id;
        } else
            $country = Country::where('id', $country_id)->first();
        $links = [
            'all' => ['status' => 'active', 'url' => url('country/offers/' . $user->country->id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            'new' => ['status' => '', 'url' => url('country/offers/new/' . $user->country->id . '/' . $position), 'name' => 'New', 'icon' => ' icon-plus2']
        ];
        $offer = offer::where('id', $id)->with('offerCountries', 'offerType', 'owner', 'offerSectors')->first();

        $activities = OfferActivity::all()->pluck('name', 'id')->toArray();
        $countries = Country::all()->pluck('name', 'id')->toArray();
        return view('site.country.offers.edit', compact('country', 'url', 'list', 'edit', 'country_id', 'position', 'links', 'user', 'offer', 'activities', 'countries', 'sectors'));
    }

    public
    function listAllUsers($country_id = null, $position = null)
    {
        $role_permission = new RoleController();
        if (!$role_permission->checkRolePermission("list_user")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }
        $user = User::where('id', Auth::user()->id)->with('country')->first();
        $list = 'Sub Users';
        $url = 'countries/country/';
        if ($position == 1) {
            $country = Country::where('id', $user->country->id)->first();
            $country_id = $user->country->id;
        } else
            $country = Country::where('id', $country_id)->first();
        $links = [
            'all' => ['status' => 'active', 'url' => url('country/users/' . $country_id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            'new' => ['status' => '', 'url' => url('country/users/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => 'icon-user-plus']
        ];

        $users = User::where('parent_id', $user->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('site.country.users.index', compact('country', 'url', 'list', 'position', 'country_id', 'links', 'user', 'users'));
    }

    public
    function newUser($country_id = null, $position = null)
    {
        $role_permission = new RoleController();

        if (!$role_permission->checkRolePermission("create_user")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }
        $user = User::where('id', Auth::user()->id)->with('country')->first();
        $list = 'Sub Users';
        $url = 'country/users/';
        $new = 'New';
        if ($position == 1) {
            $country = Country::where('id', $user->country->id)->first();
            $country_id = $user->country->id;
        } else
            $country = Country::where('id', $country_id)->first();
        $roles = Role::all();
        $links = [
            'all' => ['status' => 'active', 'url' => url('country/users/' . $country_id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            'new' => ['status' => '', 'url' => url('country/users/new/' . $country_id . '/' . $position), 'name' => 'New', 'icon' => 'icon-user-plus']
        ];
        return view('site.country.users.new', compact('country', 'url', 'list', 'new', 'position', 'country_id', 'links', 'user', 'roles'));
    }

    /**
     * @param $id
     * @param null $country_id
     * @param null $position
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public
    function editUser($id, $country_id = null, $position = null)
    {
        $role_permission = new RoleController();

        if (!$role_permission->checkRolePermission("update_user")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }
        $user = User::where('id', Auth::user()->id)->with('country')->first();
        $sub_user = User::where('id', $id)->first();
        $roles_users = RolesUsers::where('user_id', $user->id)->pluck('role_id')->toArray();
        $sub_roles = $sub_user->roles->pluck('role_id')->toArray();
        $roles = Role::all();
        $list = 'Sub Users';
        $url = 'country/users/';
        $edit = 'Edit';
        $country = Country::where('id', $user->country->id)->first();

        $links = [
            'all' => ['status' => 'active', 'url' => url('country/users/' . $user->country->id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
            'new' => ['status' => '', 'url' => url('country/users/new/' . $user->country->id . '/' . $position), 'name' => 'New', 'icon' => 'icon-user-plus']
        ];
        $countries = Country::all()->pluck('name', 'id')->toArray();
        return view('site.country.users.edit', compact('country', 'url', 'list', 'edit', 'country_id', 'roles_users', 'position', 'links', 'user', 'sub_user', 'roles', 'sub_roles'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function saveUser(Request $request, $id)
    {
        DB::beginTransaction();
        $data = $request->all();
        try {
            User::storeRecord($request->all(), $id);

        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage() . $e->getLine();
        }
        DB::commit();
        \Session::flash('message', 'Updated Successfully');
        return redirect()->back();
        DB::close();
    }

    public
    function follow($country_id)
    {
        if (!auth()->user()) {
            return redirect('user/login');
        }
        $followed = CountriesFollowers::where('country_id', $country_id)->where('user_id', auth()->user()->id)->first();

        if (!empty($followed)) {
            if ($followed->follow == 0) {
                $followed->follow = 1;
            } else
                $followed->follow = 0;

            $followed->saveOrFail();
        } else {
            $newFollow = new CountriesFollowers();
            $newFollow->country_id = $country_id;
            $newFollow->user_id = auth()->user()->id;
            $newFollow->follow = 1;
            $newFollow->type = auth()->user()->type;

            $newFollow->saveOrFail();
        }

        $userCountry = User::where('country_id', $country_id)->first();
        if ($userCountry) {
            $userCountry->notify(new Notifications('You have been followed by ' . auth()->user()->name, $country_id));
        } else
            auth()->user()->notify(new Notifications('You have been followed by ' . auth()->user()->name, $country_id));

        return redirect('countries/country/' . $country_id)->with('followed success');
    }

    /**
     * @param $country_id
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    public
    function usersFollowers($country_id)
    {
        $role_permission = new RoleController();

        if (!$role_permission->checkRolePermission("show_followers")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }

        $user = User::where('id', Auth::user()->id)->first();
        $countryFollowers = CountriesFollowers::where('country_id', $country_id)->where('follow', 1)->with(['user' => function ($query) {
            $query->orderBy('name', 'ASC');
        }])->get()->groupBy('type');
        $list = 'Followers';
        $url = 'countries/country/';
        $country = Country::where('id', $country_id)->first();
        $changeMakers = [];
        $companies = [];
        $partners = [];
        $countriesAdmins = [];

        foreach ($countryFollowers as $followers) {
            foreach ($followers as $follower) {
                if ($follower->type == 1) {
                    $countriesAdmins[] = $follower->user;
                } elseif ($follower->type == 2) {
                    $companies[] = $follower->user;
                } elseif ($follower->type == 3) {
                    $changeMakers[] = $follower->user;
                } elseif ($follower->type == 5) {
                    $partners[] = $follower->user;
                }
            }
        }
        $position = 1;
        $links = [
            'Settings' => ['status' => 'active', 'url' => url('country/account'), 'name' => 'Settings', 'icon' => ' icon-cog3']];
        return view('site.country.followers', compact('country', 'url', 'list', 'country_id', 'links', 'user', 'position', 'changeMakers', 'companies', 'partners', 'countriesAdmins'));

    }


    /**
     * @param $country_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function contactUs($country_id, $position)
    {
        if (!Auth::user())
            return redirect('/login');

        $page_title = 'Countries';
        $sub_title = 'Contact us';
        $parent_title = 'Countries';
        $search = false;
        $position = 2;
        $user = User::where('id', Auth::user()->id)->with('country')->first();
        $links = [];

        return view('site.contact_us', compact('links', 'user', 'position', 'country_id', 'page_title', 'sub_title', 'search', 'parent_title'));
    }

    /**
     * @param Request $request
     * @param $country_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public
    function saveContactUs(Request $request, $country_id)
    {
        $message = new Message();
        $rules = ['name' => 'required', 'email' => 'required|email', 'subject' => 'required', 'message' => 'required'];

        $data = $request->all();
        $data['user_id'] = User::where('country_id', $country_id)->pluck('id')->first();
        $data['name'] = $request['name'] . ' ' . $request['last_name'];

        $this->validate($request, $rules);

        if ($message->create($data)) {
            \Session::flash('message', 'thank you for contacting us');
            return redirect('/');
        } else {
            \Session::flash('message', 'Failed to Send message please try again');
            return redirect('country/contact_us/' . $country_id . '/2');
        }
    }


    public
    function editOrganization($id, $country_id = null, $position = null)
    {
        $role_permission = new RoleController();

        if (!$role_permission->checkRolePermission("edit_organization")) {
            \Illuminate\Support\Facades\Session::flash('message', 'You do not have permission to access this method');
            return redirect()->back()->with('You do not have permission to access this method', 403);
        }
        $list = 'Organizations';
        $url = 'country/organization/index/';
        $edit = 'Edit';
        $country = Country::where('id', $country_id)->first();

        $user = User::where('id', Auth::user()->id)->with('country')->first();
        $links = [
            'all' => ['status' => 'active', 'url' => url('country/organization/index/' . $user->country->id . '/' . $position), 'name' => 'List All', 'icon' => ' icon-pen-plus'],
        ];
        $Organization = Organizations::where('id', $id)->with('organizationDetails', 'organizationContacts', 'country', 'city', 'organizationContactPerson')->first();
        return view('site.country.organization.edit', compact('country', 'url', 'list', 'edit', 'country_id', 'position', 'links', 'user', 'Organization'));
    }
}
