<?php
namespace App\Http\Controllers\frontend;
use Mail;
use App\Models\Page;
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
        $sendMail = Mail::to('info@gemicatech.com')->send(new ContactUs($mailData));
        if($sendMail){
            $arr = ['msg' => 'thanks for contacting us', 'status' => true];
        }else{
            $arr = ['msg' => 'Error in sending data', 'status' => false];
        }
        return response()->json($arr);




    }
}
