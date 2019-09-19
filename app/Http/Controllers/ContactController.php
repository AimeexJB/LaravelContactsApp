<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use App\contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();

        return view('contacts.index')->with(array (
            'contacts' => $contacts
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'firstName' => 'required|max:191',
            'lastName' => 'required|max:191',
            'address' => 'required|max:191',
            'email' => 'required|max:191',
            'phoneNumber' => 'required|max:10'
        );

        $messages = array(
            'alphanum' => 'The :attribute field must contain only numbers, no special characters'
        );

        $request->validate($rules, $messages);

        $contact = new Contact();
        $contact->firstName= $request->input('firstName');
        $contact->lastName= $request->input('lastName');
        $contact->address= $request->input('address');
        $contact->email= $request->input('email');
        $contact->phoneNumber= $request->input('phoneNumber');

        $contact->save();

        $session = $request->session()->flash('message', 'contact added successfully');

        return redirect()->route('contacts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return view('contacts.show')->with(array (
            'contact' => $contact

        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);

        return view('contacts.edit')->with(array (
            'contact' => $contact

        ));
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
        $contact = Contact::findOrFail($id);

        $rules = array(
            'firstName' => 'required|max:191',
            'lastName' => 'required|max:191',
            'address' => 'required|max:191',
            'email' => 'required|max:191',
            'phoneNumber' => 'required|alphanum|min:10|max:10'
        );

        $messages = array(
            'alphanum' => 'The :attribute field must contain only numbers, no special characters',

        );

        $request->validate($rules, $messages);

        $contact->firstName= $request->input('firstName');
        $contact->lastName= $request->input('lastName');
        $contact->address= $request->input('address');
        $contact->email= $request->input('email');
        $contact->phoneNumber= $request->input('phoneNumber');

        $contact->save();

        $session = $request->session()->flash('message', 'contact updated successfully');

        return redirect()->route('contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $contact->delete();

        $request->session()->flash('message', 'Contact deleted successfully');

        return redirect()->route('contacts.index');
    }


    public function apiIndex()
    {
        $data = Contact::all();
        $status = 200;
        $response = array(
            'status' => $status,
            'data' => $data
        );

        return response()->json($response);
    }

    public function apiShow($id)
    {
        $contact = Contact::find($id);
        if ($contact === null) {
            $status = 404;
            $data = null;
        }
        else {
            $status = 200;
            $data = $contact;
        }
        $response = array(
            'status' => $status,
            'data' => $data
        );

        return response()->json($response);
    }

    public function apiStore(Request $request)
    {
        $content = $request->getContent();
        $request->merge((array)json_decode($content));

        $rules= [
            'firstName' => 'required|max:191',
            'lastName' => 'required|max:191',
            'address' => 'required|max:191',
            'email' => 'required|max:191',
            'phoneNumber' => 'required|max:10'
        ];

    $validation = Validator::make($request->all(), $rules);

        if($validation->fails()) {
            $data =$validation->getMessageBag();
            $status = 422;
        }
        else{
            $contact = new Contact();

            $contact->firstName= $request->input('firstName');
            $contact->lastName= $request->input('lastName');
            $contact->address= $request->input('address');
            $contact->email= $request->input('email');
            $contact->phoneNumber= $request->input('phoneNumber');

            $contact->save();

            $data = $contact;
            $status = 200;


        }

        $response = array(
        'status' => $status,
        'data' => $data
        );
        return response()->json($response);
    }

    public function apiUpdate(Request $request,$id)
    {
         $contact = Contact::find($id);
        if ($contact === null) {
            $status = 404;
            $data = null;
        }

        else{
         $content = $request->getContent();
        $request->merge((array)json_decode($content));

        $rules= [
            'firstName' => 'required|max:191',
            'lastName' => 'required|max:191',
            'address' => 'required|max:191',
            'email' => 'required|max:191',
            'phoneNumber' => 'required|max:10'
        ];
    $validation = Validator::make($request->all(),$rules);

        if ($validation->fails()) {
            $data = $validation->getMessageBag();
            $status = 422;
        }
            else{
            $contact->firstName= $request->input('firstName');
            $contact->lastName= $request->input('lastName');
            $contact->address= $request->input('address');
            $contact->email= $request->input('email');
            $contact->phoneNumber= $request->input('phoneNumber');
            $contact->save();
                $data =$contact;
                $status = 200;
            }
            }
        $response = array(
        'status' => $status,
        'data' => $data);
        return response()->json($response);
    }

public function apiDelete(Request $request,$id)
    {
        $contact = Contact::find($id);
        if ($contact === null) {
            $data = null;
            $status = 404;

        }

        else {
            $contact->delete();
            $data = null;
            $status = 200;


        }
       $response = array(
        'status'=> $status,
        'data' => $data
        );

        return response()->json($response);
    }


}
