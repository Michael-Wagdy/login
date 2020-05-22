<?php 

namespace App\Services;

use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Offer;
use Auth;
use Carbon\Carbon;
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
    
     
    protected function CheckDate($request){
        /*
             $request['start_date']
            $request['end_date']
            $request['Departial_time'] array
            $request['arrival_time']   array

        */
        $start_date =$request->start_date;
        $end_date =$request->end_date;
        $departial_time =  $request->Departial_time;
        $arrival_time =  $request->arrival_time;
        // dd($departial_time[0] <= $end_date && $departial_time[0] > $arrival_time[0]);
        //    dd([  $start_date,$end_date,$departial_time,$arrival_time, Carbon::now()->toDateTimeString()]); 
        // check start date is after now()
// dd($end_date >= $arrival_time[0] && $arrival_time[0] > $start_date); 
// return false but no error show up
// dd(count($departial_time));
        if( $start_date > Carbon::now()->toDateTimeString() )
        {
            if($end_date > $start_date)
        {
            for($i=0; count($departial_time) > $i ; $i++){
                    if($departial_time[0] <> $start_date)
                    {
                        return back()->withErrors(['message'=>'you have to set first  Departial_time equal start date']);
                    }
                    elseif($end_date >= $arrival_time[0] && $arrival_time[0] > $start_date ){
                            if($departial_time[0] <= $end_date && $departial_time[0] < $arrival_time[0]){
                        continue;
                    }
                        else{
                            return back()->withErrors(['message'=>'you can not enter an departial time bigger than arrival time']);

                        }
                    
                    }else{
                        return back()->withErrors(['message'=>'you have to set first  arrival_time Less than or equal end date']);
                    }
                                    
                    if($departial_time[$i] <= $arrival_time[$i-1])
                    {
                        return back()->withErrors(['message'=>'you can not set an departial time less than the previous arriavl time']);
                    }else{
                        if($arrival_time[$i] >= $end_date && $arrival_time[$i] >$departial_time[$i])
                        {
                            continue;
                        }else{
                        return back()->withErrors(['message'=>'you can not enter an arrival time bigger than offer end date']);
                        }
                    }
            }
            
        }else{ // message if he entered wrong end date
            return back()->withErrors(['message'=>'you can not set a end date before start date']);
        }
        }else { // message if he entered wrong start date
            return back()->withErrors(['message'=>'you can not set a start date before this moment']);
        }
    }

public function create(CreateOfferRequest $request){
    $this->IsAgency($request);
    if( $this->CheckDate($request)){
        return $this->CheckDate($request);
    }

        
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
       if( $this->CheckDate($request)){
           return $this->CheckDate($request);
       }

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













