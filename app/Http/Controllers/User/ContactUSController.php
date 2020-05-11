<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\ContactUS;
use App\Http\Requests\StoreContactUsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContactUSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::user();
        return view('user.contactUs',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactUsRequest $request)
    {
        //
            $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
            'secret' => '6LfBx_EUAAAAAC9oFCHglBQjv-sZfBxZJUtagCPT',
            'response' => $request['g-recaptcha']
        ];
    $options = [
            'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
            ]
        ];
    $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            $resultJson = json_decode($result);
    if ($resultJson->success = false) {
            return back()->withErrors(['captcha' => 'ReCaptcha not true']);
            }
    if ($resultJson->score >= 0.3) {
            //Validation was successful, add your form submission logic here

            $contactUS = new ContactUS();
            $contactUS->frist_name = $request->frist_name;
            $contactUS->last_name = $request->last_name;
            $contactUS->email = $request->email;
            $contactUS->subject = $request->subject;
            $contactUS->message = $request->message;
            $contactUS->user_id = Auth::user()->id;
            $contactUS->status = 1;
            $contactUS->save();
    
    
    
            return back()->with(['success','your message has been sent, we are going to contact you soon']);
    






          
    } else {
            return back()->withErrors(['captcha' => 'ReCaptcha less than 0.3']);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactUS  $contactUS
     * @return \Illuminate\Http\Response
     */
    public function show(ContactUS $contactUS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactUS  $contactUS
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactUS $contactUS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactUS  $contactUS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactUS $contactUS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactUS  $contactUS
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUS $contactUS)
    {
        //
    }
}
