<?php

namespace App\Http\Controllers\Common;

// main Libs
use App\Models\CompanyAddress;
use App\Models\CompanySector;
use App\Models\PhoneAndFax;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Models
use App\Models\Company;
use App\Models\Address;
use App\Models\Country;
use App\Models\City;
use App\Models\CompanyPerson;
use App\Models\User;
use App\Models\AddressType;
use App\Models\Call;

// Facades & libs & packages & helpers
use Mockery\Exception;
use Validator;
use DB;
use Session;
use Auth;
use JavaScript;

class CompanyController extends Controller
{
    //

    protected $sectors = ['2' => 'Accounting', '3' => 'Advertising', '4' => 'Agricultural crops',
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
    protected $status = true;
    protected $profile;
    protected $other_docs;
    protected $error; // error in which function
    private $user;


    public function register()
    {
        $parent_title = 'Company';
        $page_title = 'Register';
        $sectors = $this->sectors;
        $address_types = Address::all()->pluck('name', 'id')->toArray();
        $countries = Country::all()->pluck('name', 'id')->toArray();
        return view('site.company.register', compact('sectors', 'countries', 'parent_title', 'page_title', 'address_types'));
    }

    public function getUser()
    {
        $this->setUser();
        return $this->user;
    }

    public function setUser()
    {
        $this->user = Auth::user();
    }

    private function getCompany()
    {
        $user = $this->getUser();
        return Company::getCompanyByUserId($user->id);
    }

    //    store company  register new user
    public function storeCompany(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email|unique:companies,email',
            'p_link' => 'required|unique:companies,p_link',
            'belongs_to' => 'required|max:3',
            'country_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'address' => 'required',
            'address.*' => 'min:3',
            'phones' => 'required',
            'phones.*' => 'min:4',
            'faxes.*' => 'min:3',
            'person_title' => 'required',
            'person_lname' => 'required|min:2',
            'person_fname' => 'required|min:2',
            'p_position' => 'required|min:3',
            'department' => 'min:3',
            'p_email' => 'required|email|unique:company_persons,email',
            'p_tel' => 'required|min:5',
            'about' => 'required|min:10',
            'turn_over_from' => '',
            'turn_over_to' => '',
            'product_description' => 'required|min:10',
            'needs' => 'required|min:10',
            'password' => 'required|min:6|confirmed',
            'logo' => 'required|image|mimes:png,jpg,jpeg',
            'agree' => 'required',
            'other_doc' => 'mimes:pdf,png,jpg,jpeg,xls,docx,doc'
        ];

        // Validation
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //  Get Files Names To use later
        $this->getFilesNames($request);


        // modify request data
        $request->established = $this->converDateToTimeStamp($request->established);
        $request->company_type = implode(',', $request->company_type);
        $request->product_type = implode(',', $request->product_type);


        DB::beginTransaction();

        // store in users table
        if (!$user = $this->storeInUsersTable($request)) {
            $this->status = false;
            $this->error = 'store in users';
            DB::rollBack();
        }

        // Store in Companies Table
        try {
            $request->merge(['user_id' => $user->id]);
            $company = Company::newRecord($request);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->status = false;
            $this->error = 'store in company table';
            return $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile();
        }

        // Company Person
        if (!$person = $this->storeCompanyPersons($request, $company)) {
            $this->status = false;
            $this->error = 'store Company Person';
            DB::rollBack();
        }

        // Company Address
        if (!$this->storeCompanyAddress($request, $company)) {
            $this->status = false;
            $this->error = 'store Company Address';
            DB::rollBack();
        }

        // company phones
        if (!$this->storeCompanyPhones($request, $company)) {
            $this->status = false;
            $this->error = 'store Company Phones';
            DB::rollBack();
        }

        // company faxes
        if (!$this->storeCompanyFaxes($request, $company)) {
            $this->status = false;
            $this->error = 'store Company Faxes';
            DB::rollBack();
        }

        // Company Sectors
        if (!$this->storeCompanySectors($request, $company)) {
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


        Session::flash('message', 'registered successfully');
        Auth::login($user);
        return redirect()->route('company');
    }

    //    Update Company
    public function updateCompany(Request $request)
    {
        $loggedInCompany = Company::loggedInCompany();
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id . '|unique:companies,email,' . $loggedInCompany->id,
            'p_link' => 'required|unique:companies,p_link,' . $loggedInCompany->id,
            'belongs_to' => 'required|max:3',
            'country_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'address' => 'required',
            'address.*' => 'min:3',
            'phones' => 'required',
            'phones.*' => 'min:4',
            'faxes.*' => 'min:3',
            'person_title' => 'required',
            'person_lname' => 'required|min:2',
            'person_fname' => 'required|min:2',
            'p_position' => 'required|min:3',
            'department' => 'min:3',
            'p_email' => 'required|email|unique:company_persons,email,' . $loggedInCompany->person->id,
            'p_tel' => 'required|min:5',
            'about' => 'required|min:10',
            'turn_over_from' => '',
            'turn_over_to' => '',
            'product_description' => 'required|min:10',
            'needs' => 'required|min:10',
            'logo' => 'image|mimes:png,jpg,jpeg',
            'other_doc' => 'mimes:pdf,png,jpg,jpeg,xls,docx,doc'
        ];

        // Validation
        $validator = Validator::make($request->all(), $rules, ['p_email.unique' => 'Person Email exist once']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //  Get Files Names To use later
        $this->getFilesNames($request);


        // modify request data
        $request->established = $this->converDateToTimeStamp($request->established);
        $request->company_type = implode(',', $request->company_type);
        $request->product_type = implode(',', $request->product_type);


        // Start Transaction
        DB::beginTransaction();

        // store in users table
        if (!$user = $this->storeInUsersTable($request, Auth::user()->id)) {
            $this->status = false;
            $this->error = 'store in users';
            DB::rollBack();
        }

        // Store in Companies Table
        try {
            $request->merge(['user_id' => $user->id]);
            $company = Company::newRecord($request, $loggedInCompany->id);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->status = false;
            $this->error = 'store in company table';
            return $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile();
        }

        // Company Person
        if (!$person = $this->storeCompanyPersons($request, $company, $company->person->id)) {
            $this->status = false;
            $this->error = 'store Company Person';
            DB::rollBack();
        }

        // Company Address
        if (!$this->storeCompanyAddress($request, $company)) {
            $this->status = false;
            $this->error = 'store Company Address';
            DB::rollBack();
        }

        // company phones
        if (!$this->storeCompanyPhones($request, $company)) {
            $this->status = false;
            $this->error = 'store Company Phones';
            DB::rollBack();
        }

        // company faxes
        if (!$this->storeCompanyFaxes($request, $company)) {
            $this->status = false;
            $this->error = 'store Company Faxes';
            DB::rollBack();
        }

        // Company Sectors
        if (!$this->storeCompanySectors($request, $company)) {
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

    //    Store Company Person Function
    private function storeCompanyPersons($request, $company, $id = null)
    {
        try {
            $person_data = [];
            $person_data['company_id'] = $company->id;
            $person_data['title'] = $request->person_title;
            $person_data['last_name'] = $request->person_lname;
            $person_data['first_name'] = $request->person_fname;
            $person_data['position'] = $request->p_position;
            $person_data['department'] = $request->department;
            $person_data['email'] = $request->p_email;
            $person_data['phone'] = $request->p_tel;
            $person_data['mobile'] = $request->p_mobil;
            return CompanyPerson::newRecord($person_data, $id);

        } catch (\Exception $e) {
            die($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }

    //     store Company in users table function
    private function storeInUsersTable($request, $id = null)
    {
        try {
            $user_data = [];
            $user_data['name'] = $request->name;
            $user_data['email'] = $request->email;
            $user_data['type'] = 2;
            $user_data['password'] = $request->password;
            $user_data['image'] = $this->profile;
            return User::storeRecord($user_data, $id);
        } catch (\Exception $e) {
            die($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }

    //    Store company Phones
    private function storeCompanyPhones($request, $company, $id = null)
    {
        if (isset($request->phones) && !empty($request->phones) && is_array($request->phones)) {
            $ids = PhoneAndFax::select('id')->where('company_id', $company->id)->where('number_type', 'p')->get()->toArray();
            DB::table('phones')->whereIn('id', $ids)->delete();

            foreach ($request->phones as $phone) {
                $data = [];
                $data['company_id'] = $company->id;
                $data['number'] = $phone;
                $data['type'] = 'p';
                try {
                    PhoneAndFax::storeRecord($data, $id);
                } catch (Exception $e) {
                    die($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
                }
            }
        }

        return true;

    }

    //     store Company Faxes
    private function storeCompanyFaxes($request, $company, $id = null)
    {
        if (isset($request->faxes) && !empty($request->faxes) && is_array($request->faxes)) {
            $ids = PhoneAndFax::select('id')->where('company_id', $company->id)->where('number_type', 'f')->get()->toArray();
            DB::table('phones')->whereIn('id', $ids)->delete();

            foreach ($request->faxes as $phone) {
                $data = [];
                $data['company_id'] = $company->id;
                $data['number'] = $phone;
                $data['type'] = 'f';
                try {
                    PhoneAndFax::storeRecord($data, $id);
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
            if ($request->hasFile('logo')) {
                $request->logo->storeAs('media/profile/', $this->profile, 'public');
            };

            if ($request->hasFile('other_doc')) {
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
            if ($request->hasFile('logo')) {
                $name = str_random(12) . '_company_' . $request->logo->getClientOriginalName();
                $this->profile = $name;
            };

            if ($request->hasFile('other_doc')) {
                $name = str_random(12) . '_company_' . $request->other_doc->getClientOriginalName();
                $this->other_docs = $name;
            }
        } catch (Exception $e) {
            die($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }

    //    store Company Address
    private function storeCompanyAddress($request, $company, $id = null)
    {
        if (isset($request->address) && !empty($request->address)) {
            $ids = CompanyAddress::select('id')->where('company_id', $company->id)->get()->toArray();
            DB::table('address')->whereIn('id', $ids)->delete();

            foreach ($request->address as $k => $address) {
                $addressData = [];
                $addressData['company_id'] = $company->id;
                if (isset($address['address_type']) && !empty($address['address_type']) && $address['address_type'] === 'o') {
                    $addressData['type'] = AddressType::storeRecord(['name' => $address['new_type']])->id;
                } else {
                    $addressData['type'] = $address['address_type'];
                }
                $addressData['address'] = $address['address'];
                $addressData['postal'] = $address['postal'];
                try {
                    CompanyAddress::storeRecord($addressData, $id);
                } catch (Exception $e) {
                    die($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
                }
            }
        }

        return true;
    }

    //    store company Sectors
    private function storeCompanySectors($request, $company, $id = null)
    {
        if (isset($request->sectors) && !empty($request->sectors)) {
            $sector_ids = CompanySector::select('id')->where('company_id', $company->id)->get()->toArray();
            DB::table('companies_sectors')->whereIn('id', $sector_ids)->delete();
            foreach ($request->sectors as $sector) {
                try {
                    CompanySector::storeRecord(['sector_id' => $sector, 'company_id' => $company->id], $id);
                } catch (Exception $e) {
                    die($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
                }
            }
        }

        return true;
    }

    //    converting date to date Y-m-d
    private function converDateToTimeStamp($date)
    {
        $date = strtotime($date);
        return date('Y-m-d H:I:s', $date);
    }

    //    View Company Account
    public function companyAccount()
    {
        $user = Auth::user();
        $company = Company::getCompanyByUserId($user->id);
        $countries = Country::all()->pluck('name', 'id')->toArray();
        $cities = City::countyCities($company->country_id)->toArray();
        $sectors = $this->sectors;
        $sectorObject = [];

        foreach ($sectors as $k => $val) {

            $newObject['id'] = $k;
            $newObject['text'] = $val;
            $sectorObject[] = $newObject;
        }


        $company_sectors = CompanySector::companySectors($company->id)->pluck('sector_id');
        $parent_title = $company->name;
        $page_title = 'settings';
        $address_types = Address::all()->pluck('name', 'id')->toArray();
        $company_address = DB::table('companies')
            ->join('address', 'companies.id', '=', 'address.company_id')
            ->join('address_types', 'address_types.id', '=', 'address.type_id')
            ->select('address_types.name as typeName', 'address.id as addressId', 'address.company_id', 'address.type_id', 'address.postal', 'address.address')
            ->get();

        JavaScript::put([
            'address_count' => count($company_address),
            'address' => $company_address,
            'address_types' => $address_types,
            'company_sectors' => $company_sectors,
            'sectors' => $sectorObject,
        ]);
        $links = ['Settings' => ['status' => 'active', 'url' => url('company/settings'), 'name' => 'Settings', 'icon' => ' icon-cog3']];
        return view('site.company.settings', compact('user', 'company', 'countries', 'links', 'cities', 'sectors', 'company_sectors', 'parent_title', 'page_title', 'address_types'));

    }




    public function viewCalls()
    {
        $calls = Call::userCalls(Auth::user()->id)->orderBy('created_at', 'desc')->paginate(20);
        $parent_title = $this->getCompany()->name;
        $page_title = 'Calls';
        $user = $this->getUser();
        $looking_for = ['v' => ' Volunteers', 'i' => 'Intern', 'e' => 'Employee'];
        $place = ['b' => 'Online and Offline', 'o' => 'Online', 'f' => 'Offline'];
        JavaScript::put([
            'calls' => $calls,
            'looking_for' => $looking_for,
            'places' => $place
        ]);
        $links = $links = [
            'calls' => ['status' => 'active', 'url' => url('company/calls'), 'name' => 'Calls', 'icon' => 'icon-phone2'],
            'new' => ['status' => '', 'url' => url('company/calls/new'), 'name' => 'New Call', 'icon' => 'icon-pen-plus']];
        return view('site.company.calls', compact('calls', 'parent_title', 'page_title', 'links', 'user'));
    }

    public function newCall()
    {
        $parent_title = $this->getCompany()->name;
        $page_title = 'New Call';
        $user = $this->getUser();
        $countries = Country::all()->pluck('name', 'id')->toArray();
        $links = $links = [
            'calls' => ['status' => '', 'url' => url('company/calls'), 'name' => 'Calls', 'icon' => 'icon-phone2'],
            'new' => ['status' => 'active', 'url' => url('company/calls/new'), 'name' => 'New Call', 'icon' => 'icon-pen-plus']];
        return view('site.company.new_call', compact('calls', 'parent_title', 'page_title', 'links', 'user', 'countries'));
    }

}
