<?php
namespace App\Http\Controllers\frontend;
use Mail;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Mail\frontend\ContactUs;
use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\ContactusRequest;

class ContactusController extends Controller
{
    public function store(ContactusRequest $request)
    {


        $mailData = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'subject' => $request->get('subject'),
            'message' => $request->get('message'),
        ];
        $mail = Setting::where('key', 'site_email')->first()->value;
        $sendMail = Mail::to($mail)->send(new ContactUs($mailData));
        if($sendMail){
            $arr = ['msg' => 'thanks for contacting us', 'status' => true];
        }else{
            $arr = ['msg' => 'Error in sending data', 'status' => false];
        }
        return response()->json($arr);




    }
}
