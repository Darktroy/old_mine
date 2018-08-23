<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use App\Models\City;
use App\Models\Country;


class CitiesController extends Controller
{
    //
    public function index()
    {
        $page_title = 'cities';
        $sub_title = 'List All Cities';
        $search = true;
        $cities = City::paginate(20);
        return view('panel.cities.index', compact('cities', 'page_title', 'sub_title', 'search'));
    }

    public function newCity()
    {
        $page_title = 'cities';
        $sub_title = 'New City';
        $search = true;
        $countries = Country::all()->pluck('name', 'id');
        return view('panel.cities.new', compact('page_title', 'sub_title', 'search', 'countries'));
    }

    public function storeCity(Request $request)
    {
        $city = new City;
        $rules = ['name' => 'required', 'country_id' => 'required|numeric'];
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->wothErrors($validation);
        }

        $city->name = $request->name;
        $city->country_id = $request->country_id;

        if (!$city->save()) {
            Session::flash('message', 'Failed To Add City');
            return redirect()->back();
        }

        Session::flash('message', 'City Added Successfully');
        return redirect()->route('cities');
    }

    public function editCity($id)
    {
        $page_title = 'Citites';
        $sub_title = 'Edit';
        $search = false;
        $city = City::where('id', $id)->first();
        $countries = Country::all()->pluck('name', 'id');
        return view('panel.cities.edit', compact('city', 'countries', 'page_title', 'sub_title', 'search'));
    }

    public function updateCity(Request $request, $id)
    {
        // dd($request->all());
        $city = City::where('id', $id)->first();
        $rules = ['name' => 'required', 'country_id' => 'required|numeric'];
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->wothErrors($validation);
        }

        $city->name = $request->name;
        $city->country_id = $request->country_id;

        if (!$city->save()) {
            Session::flash('message', 'Failed To Update City');
            return redirect()->back();
        }

        Session::flash('message', 'City Updated Successfully');
        return redirect()->route('cities');

    }

    public function deleteCity(Request $request, $id)
    {
        $city = City::where('id', $id)->first();
        if (!$city->delete()) {
            Session::flash('message', 'Failed To Delete City');
            return redirect()->back();
        }

        Session::flash('message', 'City Delete Successfully');
        return redirect()->route('cities');
    }

}
