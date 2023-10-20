<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;




class ContactController extends Controller
{

    public function Contact(Request $request)
    {
        // Try to identify
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required'],
            'subject' => ['required'],
        ]);
    
        $contact=contact::create([
            'email' => $request->email,
            'name' => $request->name,
            'subject' => $request->subject,
        ]); 
        if(isset($contact)){
        // Set the success message in the session
        //you need to destroy the other session
        $request->session()->flash('success', 'Your message has been sent successfully.');
        }
        else{
        //you need to destroy the other session

        $request->session()->flash('error', 'something went wrong.');

        }
        return view('Header links.Contact');

    
        // Regenerate the session for security
        $request->session()->regenerate();
    
        if ($request->session()->has('previous_url')) {
            $previousUrl = $request->session()->get('previous_url');
            $request->session()->forget('previous_url'); // Clear the stored URL
            return redirect()->intended($previousUrl);
        }
        // If there is no previous URL, you might want to specify a default URL here.
    }
    //for api
    function index()  {
        $contact=Contact::select(
            DB::raw('id'),
            DB::raw('name'),
            DB::raw('email'),
            DB::raw('subject'),
            DB::raw('date_format(created_at, "%d-%m-%Y") as date'),
            DB::raw('`read`'),
            )->get();

        return response()->json($contact);
    }
    function State(Request $request,$id)  {
        $affected = DB::table('contact')
              ->where('id', $id)
              ->update(['read' => 1]);
        $verify=DB::table('contact')->where('id', $id)->where('read',1);
        /* if($Contact->update(['`read`' => 1])) */
        if($affected || $verify) 
        {
        return response()->json(['message' => 'Message marked as read',$id], 200);
        }
        else {
            return response()->json(['error' => 'An error occurred while updating the state'], 500);

        }
    }
    function Delete(Request $request,$id)  {
        //$contact=contact::find($id);
        try {
            $contact=contact::destroy($id);

                return response()->json(['message' => 'message deleted successfully'], 200);

        } catch (\Exception $e) {
            // Handle any exceptions that occur during deletion
            return response()->json(['error' => 'An error occurred while deleting the message',$e], 500);
        }
    }

    
    
    
}
