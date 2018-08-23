<?php

namespace App\Http\Controllers\Common;

use App\Models\CountriesFollowers;
use App\Models\OfferCountry;
use App\Models\OffersActivities;
use App\Models\OfferSector;
use App\Models\OrganizationDescription;
use App\Models\Organizations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Offer;
use App\Models\Country;
use App\Models\OfferActivity;

//Facades & libs & packages
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;
use DB;

class OffersController extends Controller
{
    //
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

    public $status = true;
    public $roles = [
        'title' => 'required|min:5',
        'contactPerson' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'summary' => 'required',
        'description' => 'required',
        'deadline' => 'required|date|date_format:Y-m-d',
        'sectors' => 'required',
        'activities' => 'required',
        'offer_country' => 'required'
    ];

    public function index()
    {
        $page_title = 'Offers';
        $sub_title = 'Add New Offer';
        $search = false;
        $offers = Offer::paginate(20);
        return view('panel.offers.index', compact('page_title', 'sub_title', 'search', 'offers'));
    }

    public function indexCountryOffers($country)
    {
        $page_title = 'Offers';
        $sub_title = 'Add New Offer';
        $parent_title = 'Add New Offer';
        $search = true;
        $offers_ids = OfferCountry::where('country_id', $country)->pluck('offer_id')->toArray();
        $offers = Offer::whereIn('id', $offers_ids)->get();

        return view('site.country.offers.index', compact('page_title', 'sub_title', 'parent_title', 'search', 'offers'));
    }

    public function adminNewOffer()
    {
        $page_title = 'Offers';
        $sub_title = 'Add New Offer';
        $search = false;
        $countries = Country::all()->pluck('name', 'id')->toArray();
        $activities = OfferActivity::all()->pluck('name', 'id')->toArray();
        $sectors = $this->sectors;
        return view('panel.offers.new', compact('page_title', 'sub_title', 'search', 'countries', 'sectors', 'activities'));
    }

    public function create()
    {
        $page_title = 'Offers';
        $sub_title = 'Add New Offer';
        $search = false;
        $countries = Country::all()->pluck('name', 'id')->toArray();
        $activities = OfferActivity::all()->pluck('name', 'id')->toArray();
        $sectors = $this->sectors;
        return view('panel.offers.new', compact('page_title', 'sub_title', 'search', 'countries', 'sectors', 'activities'));
    }

    /**
     * @param Request $request
     * @return $this|array|\Illuminate\Http\RedirectResponse|string
     */
    public function storeOffer(Request $request)
    {
        return $request->all();

        $activity_id = "";
        $validator = Validator::make($request->all(), $this->roles);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $request->deadline = $this->convertDateToTimeStamp($request->deadline);

        DB::beginTransaction();

        // Offer Activity

        if ($request->activities == 0) {
            $other_activity = OfferActivity::storeRecord(['name' => $request->other_activity]);
            $request->merge(['activity_id' => $other_activity->id]);
        } else {
            $request->merge(['activity_id' => $request->activities]);
        }

        // Store New Offer

        try {
            $offer = Offer::storeRecord($request);
            // OffersActivities::storeRecord($activity_id,$offer->id);
        } catch (\Exception $e) {
            DB::rollback();
            $this->status = false;
            return $e->getMessage();
        }
        // Store Offer Sectors
        if (isset($request->sectors) && !empty($request->sectors)) {
            try {
                foreach ($request->sectors as $sector) {
                    $offer_sectors = OfferSector::storeRecord(['offer_id' => $offer->id, 'sector_id' => $sector]);
                }
            } catch (\Exception $e) {
                DB::rollback();
                $this->status = false;
                return $e->getMessage();
            }
        }


        // Store Offer Countries
        if (isset($request->offer_country) && !empty($request->offer_country)) {
            foreach ($request->offer_country as $k => $country) {
                try {
                    $country_offer = OfferCountry::storeRecord(['offer_id' => $offer->id, 'country_id' => $country]);
                } catch (\Exception $e) {
                    DB::rollback();
                    $this->status = false;
                    return $e->getMessage();
                }
            }
        }


        DB::commit();

        if ($this->status === true) {
            Session::flash('message', 'Offer Added Successfully');
            // return redirect()->route('panel.offers');
            return redirect()->back();
        } else {
            Session::flash('message', 'Failed To Add Offer');
            return redirect()->back();
        }

    }


    public function editOffer($offer_id)
    {
        $offer = Offer::where('id', $offer_id)->with('offerCountries', 'offerType', 'owner', 'offerSectors')->first();
        $page_title = 'Offers';
        $sub_title = 'edit ' . $offer->title;
        $countries = Country::all()->pluck('name', 'id')->toArray();
        $offer_countries = $offer->offerCountries()->select('country_id')->get()->pluck('country_id')->toArray();
        $sector_ids = $offer->offerSectors()->select('sector_id')->get()->pluck('sector_id')->toArray();
        $activities = OfferActivity::all()->pluck('name', 'id')->toArray();
        $sectors = $this->sectors;
        $search = false;

        return view('panel.offers.edit', compact('page_title', 'sub_title', 'search', 'countries', 'offer', 'activities', 'sectors', 'offer_countries', 'sector_ids'));
    }

    public function updateOffer(Request $request, $id)
    {

        $validator = Validator::make($request->all(), $this->roles);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $request->deadline = $this->convertDateToTimeStamp($request->deadline);

        DB::beginTransaction();

        // Offer Activity

        if ($request->activities == 0) {
            $other_activity = OfferActivity::storeRecord(['name' => $request->other_activity]);
            $request->merge(['activity_id' => $other_activity->id]);
        } else {
            $request->merge(['activity_id' => $request->activities]);
        }

        // Store New Offer

        try {
            $offer = Offer::storeRecord($request, $id);
        } catch (\Exception $e) {
            DB::rollback();
            $this->status = false;
            return $e->getMessage() . $e->getLine();
        }

        // Store Offer Sectors
        if (isset($request->sectors) && !empty($request->sectors)) {
            DB::table('offers_sectors')->where('offer_id', $id)->delete();
            try {
                foreach ($request->sectors as $sector) {
                    $offer_sectors = OfferSector::storeRecord(['offer_id' => $offer->id, 'sector_id' => $sector]);
                }
            } catch (\Exception $e) {
                DB::rollback();
                $this->status = false;
                return $e->getMessage() . $e->getLine();
            }
        }


        // Store Offer Countries
        if (isset($request->offer_country) && !empty($request->offer_country)) {
            DB::table('offer_countries')->where('offer_id', $id)->delete();
            foreach ($request->offer_country as $k => $country) {
                try {
                    $country_offer = OfferCountry::storeRecord(['offer_id' => $offer->id, 'country_id' => $country]);
                } catch (\Exception $e) {
                    DB::rollback();
                    $this->status = false;
                    return $e->getMessage() . $e->getLine();
                }
            }
        }


        DB::commit();

        if ($this->status === true) {
            Session::flash('message', 'Offer Updated Successfully');
            // return redirect()->route('panel.offers');
            return redirect()->back();
        } else {
            Session::flash('message', 'Failed To Update Offer');
            return redirect()->back();
        }
    }

    public function deleteOffer($offer_id, Request $request)
    {
        $offer = Offer::offerById($offer_id);

        if (!$offer->delete()) {
            if ($request->ajax()) {
                return response(['status' => false, 'message' => 'Failed To Delete The Offer']);
            }
            Session::flash('message', 'Failed To Delete Offer');
            return redirect()->back();
        }

        if ($request->ajax()) {
            return response(['status' => true, 'message' => ' Offer Deleted Successfully', 'id' => $offer_id]);
        }

        Session::flash('message', 'Offer Deleted Successfully');
        return redirect()->back();
    }

    public function viewOffer($offer_id)
    {
        $offer = Offer::offerById($offer_id);
        $page_title = 'Offers';
        $sub_title = $offer->title;
        $search = false;
        $sectors = $this->sectors;
        return view('panel.offers.view', compact('offer', 'page_title', 'sub_title', 'search', 'sectors'));
    }

    private function convertDateToTimeStamp($date)
    {
        $date = strtotime($date);
        return date('Y-m-d H:I:s', $date);
    }

    public function offerActivation($offer_id, $status)
    {
        $offer = Offer::updateActivation($offer_id, $status);
        if (!$offer) {
            return response(['status' => false, 'message' => 'Failed To Change Status']);
        }

        return response(['status' => true, 'message' => 'Status Changed Successfully']);

    }

    public function offerStatus($offer_id, $status)
    {
        $offer = Offer::updateStatus($offer_id, $status);
        if (!$offer) {
            return response(['status' => false, 'message' => 'Failed To Change Status']);
        }

        return response(['status' => true, 'message' => 'Status Changed Successfully']);
    }

    public function viewOffersInSite()
    {
        $parent_title = 'Home';
        $page_title = 'Offers';
        $offers = Offer::where('active', 1)->paginate(20);
        $activities = OfferActivity::all()->pluck('name', 'id')->toArray();
        return view('site.offers.index', compact('offers', 'page_title', 'parent_title', 'activities'));
    }

    public function listOfferTypes(Request $request)
    {
        $types = OfferActivity::all();
        if ($request->ajax()) {
            return response(['types' => $types]);
        }

        return $types;
    }

    public function filterOffers(Request $request)
    {
//        dd($request->all());
        $query = Offer::where('active', 1);

        //      Activity id
        if (isset($request->activity_id) && !empty($request->activity_id)) {
            $query->where('activity_id', $request->activity_id);
        }

        //      Filter Country
        if (isset($request->countries) && !empty($request->countries)) {
            $query->join('offer_countries', 'offers.id', '=', 'offer_countries.offer_id')
                ->join('countries_details', 'offer_countries.country_id', '=', 'countries_details.id')
                ->select('countries_details.name as country_name', 'offers.*', 'offer_countries.*');
        }

        //        Filter By Sectors
        if (isset($request->sectors) && !empty($request->sectors)) {
            $query->join('offers_sectors', 'offers.id', '=', 'offers_sectors.offer_id')
                ->where('offers_sectors.sector_id', $request->sectors);
        }

        //        Filter By Dead line
        if (isset($request->deadline) && !empty($request->deadlin)) {
            $query->where('deadline', date('Y-m-d H:i:s', strtotime($request->deadline)));
        }
        $query->orderBy('offers.id', 'DESC');

        $offers = $query->paginate(20);
        $parent_title = 'Home';
        $page_title = 'Offers';
        $activities = OfferActivity::all()->pluck('name', 'id')->toArray();
        return view('site.offers.index', compact('offers', 'page_title', 'parent_title', 'activities'));
    }

    public function getSectors()
    {
        return response(['sectors' => $this->sectors]);
    }

    /**
     * @param $offer_id
     * @param null $country_id
     * @param null $position
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewSingleOfferInSite($offer_id, $country_id = null, $position = null)
    {
        $offer = Offer::offerById($offer_id);
        $parent_title = 'Offers';
        $page_title = $offer->title;
        $list = 'Offers';
        $url = 'country/offers/';
        $country = Country::where('id', $country_id)->first();
        $organization_desc = OrganizationDescription::where('login_email', $offer->owner->email)->with('organizations')->first();
        if (auth()->user()) {
            if (!empty($organization_desc)) {
                $followed = CountriesFollowers::where('org_id', $organization_desc->organizations)->where('user_id', auth()->user()->id)->first();
                if (!empty($followed) && $followed->follow == 1) $follow = 1;
            } else $follow = 0;
        } else
            $follow = 0;

        return view('site.offers.single_offer', compact('country', 'url', 'list', 'country_id', 'position', 'follow', 'organization_desc', 'offer', 'page_title', 'parent_title'));
    }
}
