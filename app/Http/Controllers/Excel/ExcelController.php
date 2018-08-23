<?php

namespace App\Http\Controllers\Excel;

use App\Http\Controllers\Controller;
use App\Models\CountriesFollowers;
use App\Models\User;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\Auth;

class ExcelController extends Controller
{

    /**
     *
     */
    public function export($country_id)
    {
        $user = User::where('id', Auth::user()->id)->with('orgnization')->first();
        $org_id = $user->orgnization->organization;
        $countryFollowers = CountriesFollowers::where('country_id', $country_id)->where('follow', 1)->with(['user' => function ($query) {
            $query->orderBy('name', 'ASC');
        }])->get()->groupBy('type');

        $changeMakers = [];
        $companies = [];
        $partners = [];
        $countriesAdmins = [];

        if (!empty($countryFollowers)) {
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
        }

//        $position = 1;
//        $links = ['Settings' => ['status' => 'active', 'url' => url('country/account'), 'name' => 'Settings', 'icon' => ' icon-cog3']];

//        return Excel::create('followers', function ($excel) use ($changeMakers, $companies, $partners, $countriesAdmins, $links, $user, $position) {
//            $excel->sheet('followers', function ($sheet) use ($changeMakers, $companies, $partners, $countriesAdmins, $links, $user, $position) {
////                $sheet->fromArray($countryFollowers);
//                $sheet->loadView('site.country.followers', ['links' => $links, 'user' => $user, 'position' => $position,
//                    'changeMakers' => $changeMakers, 'companies' => $companies, 'partners' => $partners, 'countriesAdmins' => $countriesAdmins]);
//            });
//        });

        return Excel::create('followers', function ($excel) use ($changeMakers, $companies, $partners, $countriesAdmins) {
            $excel->sheet('changeMakers', function ($sheet) use ($changeMakers) {
                $sheet->fromArray($this->exportExcelData($changeMakers));
            });
            $excel->sheet('companies', function ($sheet) use ($companies) {
                $sheet->fromArray($this->exportExcelData($companies));
            });
            $excel->sheet('partners', function ($sheet) use ($partners) {
                $sheet->fromArray($this->exportExcelData($partners));
            });
            $excel->sheet('countriesAdmins', function ($sheet) use ($countriesAdmins) {
                $sheet->fromArray($this->exportExcelData($countriesAdmins));
            });
        })->download('xlsx');
    }

    public function exportExcelData($arrayObject)
    {
        $result = [];
        $i = 0;
        if (!empty($arrayObject)) {
            foreach ($arrayObject as $data) {
                $result[$i]['name'] = $data['name'];
                $result[$i]['email'] = $data['email'];
                $i++;
            }
        }
        return $result;
    }
}
