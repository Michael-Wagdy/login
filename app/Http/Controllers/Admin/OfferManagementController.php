<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Offer;
use Illuminate\Http\Request;
use App\Services\OfferServices;
class OfferManagementController extends Controller
{


    public $offerServices;

    public function __construct(Request $request){

        $this->offerServices = new OfferServices();



    }
   
    public function index()
    {
        //
        $offers = Offer::with('agency:id,name')->get();
        return view('admin.offer.index',compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.offer.create');
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

        return back()->with(['success' => 'Congratulations you have created an offer!']);
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

        // $offer = Offer::with(['agency:id,name','photo','details','categories',function($query){
        //     $query->where('id','like',$id);}])->get();
        $offer = Offer::findOrFail($id);
        return view('admin.offer.show',compact('offer'));
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
           
        $offer = Offer::findOrFail($id);
        return view('admin.offer.edit',compact('offer'));
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
        return back()->with(['success' =>'you have deleted an offer']);

    }
}
