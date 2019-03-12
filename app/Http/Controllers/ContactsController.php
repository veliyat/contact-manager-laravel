<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = $request->get('q');
        //
        
        $contacts = $request->user()->contacts()
                    ->where('first_name', 'LIKE', "%$query%")
                    ->orWhere('last_name', 'LIKE', "%$query%")
                    ->orWhere('email', 'LIKE', "%$query%")
                    ->paginate(8);                
        
        // $contacts = Contact::where('first_name', 'LIKE', "%$query%")
        //                 ->orWhere('last_name', 'LIKE', "%$query%")
        //                 ->paginate(8);
        return view('contacts.index', compact('contacts', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $errors = session('errors');        
        return view('contacts.form', compact('errors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'picture' => 'image',
            'address' => 'required|max:256',
            'phone' => 'required|max:15'
        ]);

        $imageName = '';

        if($request->file('picture')) {
            $path = $request->file('picture')->store('public/contact_pictures');
            $pathArray = explode('/', $path);
            $imageName = $pathArray[count($pathArray) - 1];
        } else {
            $imageName = config('custom.no_image');
        }

        $contact = new Contact();

        $contact->first_name = $request->get('first_name');
        $contact->last_name = $request->get('last_name');
        $contact->email = $request->get('email');
        $contact->picture = $imageName;
        $contact->user_id = $request->user()->id;

        $contact->save();

        $contact->addresses()->create([
            'address' => $request->get('address')
        ]);

        $contact->phone()->create([
            'phone' => $request->get('phone')
        ]);

        return redirect('/contacts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
        // $contact = Contact::find($id);

        return view('contacts.detail', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('contacts.form', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'picture' => 'image',
            'address' => 'required|max:256',
            'phone' => 'required|max:15'
        ]);

        $contact->first_name = $request->get('first_name');
        $contact->last_name = $request->get('last_name');
        $contact->email = $request->get('email');

        $imageName = '';
        if($request->file('picture')) {
            $path = $request->file('picture')->store('public/contact_pictures');
            $pathArray = explode('/', $path);
            $imageName = $pathArray[count($pathArray) - 1];
        } else {
            $imageName = $request->get('oldPic');
        }

        $contact->picture = $imageName;
        $contact->phone->phone = $request->get('phone');
        $address = $contact->addresses()->get()->first();
        $address->address = $request->get('address');
        $address->save();
        $contact->phone->save();
        $contact->save();

        return redirect('/contacts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect('/contacts');
    }
}
