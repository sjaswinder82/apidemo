<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Repositories\Contracts\ContactRepository;
use App\Services\CountryService;
use App\Transformers\ContactTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{   
    private $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountryService $service)
    {
        return $service->fetch();
        $user = auth()->user();
        $contacts = $this->repository->getUserContacts($user->id);
        
        return fractal($contacts, new ContactTransformer())
                ->withResourceName('contact')
                ->respond();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateContactRequest $request)
    {
        // App::setLocale('fr');
        $user = auth()->user();
        $payload = $request->only('name', 'email', 'phone');
        
        $contact = $user->contacts()->create($payload);

        $response = fractal($contact, new ContactTransformer())
                    ->withResourceName('contact')
                    ->toArray();

        $response['message'] = trans('messages.contacts.create_success');

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  Contact  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $contact = $this->repository->getUserContact($user->id, $id);
        
        return fractal($contact, new ContactTransformer())
                    ->withResourceName('contact')
                    ->respond();
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
        $payload = $request->only('name', 'email', 'phone');
       
        return $this->repository->updateContact($id, $payload);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);

        return $contact->delete();
    }

    public function uploadContactImage(Request $request, $id) {
        $file = $request->file('file');
        $user = auth()->user();
        $uploadFile = $request->file('file')->storePublicly('public');
        // $uploadFile = Storage::putFile(\Str::random(10), $request->file('file'));
        // $uploadFile = $request->file('file')->storeAs(
        //     \Str::random(10), 'filename'
        // );

        $payload = ['image' => $uploadFile, 'user_id' => $user->id];
        $contact = $this->repository->updateContact($id, $payload);

        return fractal($contact, new ContactTransformer())
                    ->withResourceName('contact')
                    ->respond();
    }
}
