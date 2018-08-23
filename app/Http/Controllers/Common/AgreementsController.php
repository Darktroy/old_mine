<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use Session;
use App\Models\Agreement;

class AgreementsController extends Controller
{
    //
    public function storeAgreement(Request $request)
    {
        // dd($request->all());
        $rules = ['title'=>'required|max:100','description'=>'required|min:50','min_description'=>'required|min:10|max:150'];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $agreement = $this->PrepareDataToStoreInAgreementsTable($request);

        if(!$agreement){
            Session::flash('message','Failed To Add Agreement');
            return redirect()->back();
        }

        Session::flash('message','Agreement Added Successfully');
        return redirect()->back();
    }

    public function updateAgreement(Request $request,$id)
    {
        $rules = ['title'=>'required|max:100','description'=>'required|min:50','min_description'=>'required|min:10|max:150'];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $agreement = $this->PrepareDataToStoreInAgreementsTable($request,$id);

        if(!$agreement){
            Session::flash('message','Failed To Update Agreement');
            return redirect()->back();
        }

        Session::flash('message','Agreement Updated Successfully');
        return redirect()->back();
    }

    public function deleteAgreement(Request $request, $id)
    {
        $agreement = Agreement::find($id);
        $agreement->delete();
        if ($request->ajax()) {
            return response(['id' => $id, 'success' => 'Agreement Deleted Successfully']);
        } else {
            Session::flash('message', 'Agreement Deleted Successfully');
//            return redirect()->route('posts');
            return redirect()->back();
        }
    }

    private function PrepareDataToStoreInAgreementsTable(Request $request, $id = null)
    {
        # code...
        // dd($request->all());
        $agreement = '';
        $agreement_data = [];
        try {
            
            $agreement_data['title'] = $request->title;
            $agreement_data['min_description'] = $request->min_description;
            $agreement_data['description'] = $request->description;
            
            $agreement = Agreement::newRecord($agreement_data, $id);

        } catch (\Exception $e) {
            die($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }

        if(!isset($agreement) || empty($agreement)){
            return false;
        }

        return $agreement;
    }
}
