<?php

namespace App\Http\Controllers\agency;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Offer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\OfferServices;

class OfferController extends Controller
{   
    public $offerServices;
    public function __construct()
    {
        $this->offerServices = new OfferServices;
    }
    


    
    public function index()
    {
        //to fatech data of offers related to logged in user
       $offers =  Auth::guard('webagency')->user()->offers;
        return view('agency.offer.index',compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('agency.offer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOfferRequest $request)
    {
        //
        $this->offerServices->create($request);

        return back()->with('sucess','you have created an offer');

    }
        
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $offer = Offer::find($id);

        return view('agency.offer.show',compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $offer = Offer::find($id);
        return view('agency.offer.edit',compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOfferRequest $request, $id)
    {
        //
           
        $this->offerServices->update($request,$id);

        return back()->with(['success' => 'Congratulations you have added an offer!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $offer = Offer::find($id);
        $offer->delete();
        return back()->with('sucess','you have dleted an offer');

    }
}
