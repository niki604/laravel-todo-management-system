<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EmployeeMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function sendInvite(Request $request)
    {
        if($request->emailId) {
            $user = User::create([
                'email' => $request->emailId,
                'password' => Hash::make(123456789),
                'type' => 'employee'
            ]);
            try {
                Mail::to($request->emailId)->send(new EmployeeMail($user->id));
                toastr()->success('Email sent Successfully');
    
            } catch (\Throwable $th) {
                toastr()->error($th);
            }
           return redirect()->route('employee');
        }
    }

    public function createPassword($id, Request $request)
    {
        return view('employees.create-password', compact('id'));
    }

    public function addPassword($id, Request $request)
    {
        $user = User::findorFail($id);
        $user->password = Hash::make($request->password);
        $user->active = '1';
        $user->save();
        
        toastr()->success('Password Updated Successfully');
        return redirect()->route('employee');
    }

    public function notification($id)
    {
        if($id == Auth::user()->id) {
            $user = User::findorFail($id);
            if(isset($user))
            {
                $notificationData = Task::where('user_id', $id)->get();
                return view('employees.notifications')->with([
                    'notificationData' => $notificationData
                ]);
            }
        } else {
            abort(404);
        }
        
    }
}
