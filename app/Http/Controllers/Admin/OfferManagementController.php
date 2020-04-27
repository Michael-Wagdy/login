<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfferManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['required','date'],
            'end_date' => ['required', 'date'],
            'agency_price' => ['required', 'string', 'max:25'],
            'user_price' => ['required', 'string', 'max:25'],
            'no_rooms' => ['required', 'integer'],
            'status'=> 'boolean',
            'photos.*'=> 'image|max:1999',
            'Departial_time.*'=>['required', 'date'],
            'arrival_time.*'=>['required', 'date'],
            'to.*' => ['required', 'string', 'max:25'],
            'from.*' => ['required', 'string', 'max:25'],
            'transportation_mode.*'=>'in:bus,train',
            'category.*' => ['required', 'integer'],
            'no_trip.*' => ['required', 'integer'],

        ]);
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
    public function store(Request $request)
    {
        //
        
        $this->validator($request->all())->validate();
        
        $offer=   Offer::create([
            'name' => $request['name'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'agency_price' => $request['agency_price'],
            'user_price' => $request['user_price'],
            'no_rooms' => $request['no_rooms'],
            'status' => $request['status'],
            'agency_id'=>$request['agency'],


        ]);

      

        // check if there's photos uploaded and saving it 
    if($request->hasFile('photos')){
        foreach($request->file('photos') as $image){
           $filename=time().'.'.$image->getClientOriginalExtension();
           $image->storeAs('public/uploads/photo',$filename);  
    // create a new photo attached to offer
    $offer->photo()->create([
        'photo'=>$filename ]);
    }
    }
    //end of upload photo code



    //add offer details 
      $i=0;
      $num_rows= count($request['to']);
    while($num_rows > $i ){
        $offer->details()->create([
        'Departial_time'=>$request['Departial_time'][$i],
        'arrival_time'=>$request['arrival_time'][$i],
        'to'=>$request['to'][$i],
        'from'=>$request['from'][$i],
        'no_trip'=>$request['no_trip'][$i],
        'transportation_mode'=>$request['transportation_mode'][$i],
                ]);
        $i++;
            }
            //end of offer details 


            $offer->categories()->sync($request['category']);


        return back()->with('sucess','you have created an agency accounts');

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
           
        $offer = Offer::find($id);
        return view('admin.offer.edit',compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validator($request->all())->validate();
        $offer = Offer::find($id);
        $offer->update([
           'name' => $request['name'],
           'start_date' => $request['start_date'],
           'end_date' => $request['end_date'],
           'agency_price' => $request['agency_price'],
           'user_price' => $request['user_price'],
           'no_rooms' => $request['no_rooms'],
           'status' => $request['status'],
           'agency_id'=>$request['agency'],


       ]);

           // get last offer inserted id
       $offer_id = $id;


       // check if there's photos uploaded and saving it 
   if($request->hasFile('photos')){
       foreach($request->file('photos') as $image){
          $filename=time().'.'.$image->getClientOriginalExtension();
          $image->storeAs('public/uploads/photo',$filename);  
   // create a new photo attached to offer
         $offer->photo()->update([
       'offer_id'=>$offer_id,
       'photo'=>$filename ]);
   }
   }
   //end of upload photo code


    $offer->details()->delete();
   //add offer details 
     $num_rows= count($request['to']);
     for($i=0;$num_rows > $i ;$i++){
          $offer->details()->create([
            'Departial_time'=>$request['Departial_time'][$i],
            'arrival_time'=>$request['arrival_time'][$i],
            'to'=>$request['to'][$i],
            'from'=>$request['from'][$i],
            'no_trip'=>$request['no_trip'][$i],
            'transportation_mode'=>$request['transportation_mode'][$i],
        
          ]);
           };
           //end of offer details 


               $offer->categories()->sync($request['category']);

    
       return back()->with('sucess','you have created an agency accounts');

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
    }
}
