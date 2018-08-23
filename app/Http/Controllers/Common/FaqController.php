<?php

namespace App\Http\Controllers\Common;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;

class FaqController extends Controller
{
    //

    public function index()
    {
        $page_title = 'FAQ';
        $sub_title = 'List All Questions';
        $search = true;
        $categories = [
            'r_m'=>'Register Change Maker',
            'r_c'=>'Register Company',
            'r_p'=>'Register Partner',
            "r_o"=>"Register Organization",
            'l'=>'label',
            "f"=>"Fees",
            'd'=>'Donation',
            'g'=>'General',
            null=>'Select Category'
        ];
        $questions = Faq::paginate('20');
        return view('panel.faq.index',compact('questions','page_title','sub_title','search','categories'));
    }

    public function newQuestion()
    {
        $page_title = 'FAQ';
        $sub_title = 'New Question';
        $search = false;
        return view('panel.faq.new',compact('page_title','sub_title','search'));
    }

    public function storeQuestion(Request $request)
    {
        $question = new Faq();

        $rules = ['question'=>'required|min:5','answer'=>'required|min:5','category'=>'required'];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }


        if ($question->create($request->all())){
            Session::flash('message','Question created Successfully');
            return redirect()->route('faq');
        }
        
    }

    public function editQuestion($id)
    {
        $page_title = 'FAQ';
        $sub_title = 'Edit Question';
        $search = false;
        $question = Faq::findOrFail($id);
        return view('panel.faq.edit',compact('question','page_title','sub_title','search'));
    }


    public function updateQuestion(Request $request, $id)
    {
        $question = Faq::findOrFail($id);
        $rules = ['question'=>'required|min:5','answer'=>'required|min:5','category'=>'required'];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }


        if ($question->update($request->all())){
            Session::flash('message','Question Updated Successfully');
            return redirect()->back();
        }

    }

    public function deleteQuestion(Request $request, $id)
    {
        $question = Faq::findOrFail($id);
        if($question->delete()){
            Session::falsh('message','Question Deleted Successfully');
            return redirect()->route('faq');
        }

    }


    public function homeFaq()
    {
        $questions = Faq::paginate(20);
        $parent_title = 'Home';
        $page_title = 'FAQ';
        return view('site.faq',compact('questions','parent_title','page_title'));
    }

    public function getCategoryQuestions($category)
    {
        $parent_title = 'Home';
        $page_title = 'FAQ';
        $questions = Faq::whereCategory($category)->paginate(20);
        return view('site.faq',compact('questions','parent_title','page_title'));
    }


}
