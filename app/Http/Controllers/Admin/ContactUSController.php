<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\ContactUS;
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
        $messages = ContactUS::all();

        return view('admin.message.index',compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        return view('admin.message.show',compact('contactUS'));
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
