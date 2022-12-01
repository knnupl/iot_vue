<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InputDevices as Input;
use App\Models\OutputDevices as Output;
class DashboardController extends Controller
{
    //

    
    public function SaveInputValue(Request $request)
    {
        
       //dd($output);
       $input = json_decode(json_encode($request->toArray()));
        foreach($input as $item)
        {
                Input::where('id',$item->id)
                ->update([
                             'value' => floatval($item->value)
                         ]);
        }
       
        return "Save Value Complete";
    }
    public function SaveOutputValue(Request $request)
    {
        
     
        $output = $request->toArray();      
        
                Output::where('id',$output['id'])
                ->update([
                             'is_active' => $output['is_active']
                         ]);
        
       
        return "Save Value Complete";
    }
    public function GetOutputData()
    {

        $req = Output::all()->toArray();
        return $req;
    }
    public function query()
    {

        
        $input = Input::all()->map(function($item){
            return ['device' => $item->device,'value' => $item->value];
        });

         $output =  Output::all()->map(function($item){
           
            if($item->is_active === 1)
            {
             $stat = true;   
            }else if($item->is_active === 0)
            {
                $stat= false;
            }
            return ['device' => $item->device,'is_active' => $stat];
        });


        return [
                $input,
                $output
                 ];
    }
}
