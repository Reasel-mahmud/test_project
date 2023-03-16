<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OneToOne;


class OneController extends Controller
{
    public function addPhone(){
        $phones = OneToOne::all();
        return view('admin.OneTo_one.one_to_one',compact('phones'));
    }

    public function savePhone(Request $request){
        $request->validate([
            'phone_name' => 'required|unique:one_to_ones,phone_name',
        ]);
        $phone = new OneToOne();
        $phone->phone_name = $request->phone_name;
        $phone->description = $request->description;
        $phone->save();
        return back();
    }
    public function phoneDelete(Request $request){
        $phone = OneToOne::find($request->phone_id);
        $phone->delete();
        return back();
    }

    // public function phoneEdit($id){
    //     $phones = OneToOne::find($id);
    //     return view('admin.OneTo_one.phone_edit', compact('phones'));
    // }

    public function phoneEdit($id){
        $phones = OneToOne::find($id);
        return response()->json([
            'status'=>200,
            'phones'=>$phones,
        ]);
    }

    public function updatePhone( Request $request){
        $request->validate([
            'phone_name' => 'unique:one_to_ones,phone_name',
        ]);
        $phone = OneToOne::find($request->phone_id);
        $phone->phone_name = $request->phone_name;
        $phone->description = $request->description;
        $phone->save();
        return back();
    }
}


