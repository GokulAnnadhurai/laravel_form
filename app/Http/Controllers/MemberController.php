<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class MemberController extends Controller
{
    public function edit($id)
    {
    	$Data['user'] = User::findorfail($id);
    	return view('edit',$Data);
    }

    public function update($id,Request $request)
    {

		$this->validate(
			request(), [
				'name' => ['required', 'string', 'max:255'],
				'email' => ['required', 'string', 'email', 'max:255'],
				'mobile' => ['required', 'numeric', 'min:11'],
				'address' => ['required',],
				'city' => ['required',],
				'state' => ['required',],
				'gender' => ['required',],
				'hobbies' => ['required',],
		]);
	 	

	    $updateUser=User::findorfail($id);
	    $updateUser->name=request('name');
	    $updateUser->email=request('email');
	    $updateUser->mobile=request('mobile');
	    $updateUser->address=request('address');
	    $updateUser->city=request('city');
	    $updateUser->state=request('state');
	    $updateUser->gender=request('gender');
	    $updateUser->hobbies=serialize(request('hobbies'));

		if ($request->hasFile('image')) {
          	$image = $request->file('image');
        	$imagename = $image->getClientOriginalName();
        	$image->move(public_path().'/images/', $imagename);
	    	$updateUser->image=$imagename;
	    }

    	$updateUser->save();

        return redirect(url('/home'));
    	
    }

    public function delete($id)
    {
	 	try{
           User::find($id)->delete();
           return back();
       	}catch (Exception $e){
           return back();
       	}
    }
}
