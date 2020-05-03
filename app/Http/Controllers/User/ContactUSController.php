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
