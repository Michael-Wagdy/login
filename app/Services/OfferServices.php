<?php 

namespace App\Services;

use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Offer;
use Auth;

class OfferServices 
{

    public function __construct()

    {
    }


    protected function IsAgency($request){
        if(Auth::guard('webagency')->user()){
            
            $request['agency'] = Auth::guard('webagency')->user()->id;}
    }
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
    
     


public function create(CreateOfferRequest $request){
    $this->IsAgency($request);


        
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





}


    public function update(UpdateOfferRequest $request,$id){

        $this->IsAgency($request);

        $offer = Offer::findOrFail($id);
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

    }


}













