<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Event;
use Session;
use Validator;
use App\Helpers\Euromed\Euromed;
use Auth;
use Illuminate\Support\Facades\File;

class EventsController extends Controller
{
    //

    private $request;

    function __construct( Request $request){
        $this->request = $request;

    }

    public function storeEvent(Request $request)
    {
        $validator = Validator::make($this->request->all(),$this->validationRules());
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $event = $this->PrepareDataToStoreInEventsTable();

        if(!$event){
            Session::flash('message','Failed To Add Event');
            return redirect()->back();
        }

        Session::flash('message','events Added Successfully');
        return redirect()->back();
    }


    public function updateEvent($id)
    {
        
        $validator = Validator::make($this->request->all(),$this->validationRules());
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $events = $this->PrepareDataToStoreInEventsTable($id);

        if(!$events){
            Session::flash('message','Failed To Update events');
            return redirect()->back();
        }

        Session::flash('message','events Updated Successfully');
        return redirect()->back();
    }

    public function deleteEvent($id)
    {
        $event = Event::find($id);

        $file = $event->attachment;
        $image_path = public_path('media/events/' . $file);
        $event->delete();
        File::delete($image_path);
        $event->delete();
        if ($this->request->ajax()) {
            return response(['id' => $id, 'success' => 'Event Deleted Successfully']);
        } else {
            Session::flash('message', 'Event Deleted Successfully');
//            return redirect()->route('posts');
            return redirect()->back();
        }
    }

    private function validationRules()
    {
        $rules = ['title'=>'required|max:100','description'=>'required|min:50','min_description'=>'required|min:10|max:150'];
        if(isset($this->request->files)){
            $rules['image'] = 'mimes:png,jpg,jpeg,pdf,doc,docx,xls,xcls';
        }
        
        return $rules;
    }

    private function PrepareDataToStoreInEventsTable($id = null)
    {
        $user = Auth::user();
        $event = '';
        $event_data = $this->request->except(['attachments']);
        try {

            if($this->request->hasFile('attachments')){
                $file_name = str_random(12) . '_events_' . $this->request->attachments->getClientOriginalName();
                $this->request->attachments->storeAs('media/events/', $file_name, 'public');
                $event_data['attachment'] = $file_name;
            }

            $events_data['active'] = 1;
            $event_data['start_date'] = Euromed::converDateToTimeStamp($this->request->start_date);
            $event_data['end_date'] = Euromed::converDateToTimeStamp($this->request->end_date);
            $event_data['country_id'] = $user->userRelatedTo()->id;
            $event_data['user_id'] = $user->id;

            if(isset($this->request->status) && !empty($this->request->status)){
                $event_data['status'] = $this->request->status;
            }
            $event = Event::newRecord($event_data, $id);

        } catch (\Exception $e) {
            die($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }

        if(!isset($event) || empty($event)){
            return false;
        }

        return $event;

    }
}
