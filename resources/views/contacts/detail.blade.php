@extends('layouts.app')

@section('content')
<div class="card">
        <div class="card-header">              
            {{ $contact->first_name }} {{ $contact->last_name }}

            <a href="{{ url('/contacts') }}" class="btn btn-secondary float-right">Back</a>
        </div>

        <div class="card-body">            
            <img src="{{ config('custom.contact_picture_base_url') }}/{{ $contact->picture }}" width="200"/>
            <hr />
            <p>
                <strong>Email: </strong> {{ $contact->email }}
            </p>
            <p>
                <strong>Phone: </strong> {{ $contact->phone->phone }}
            </p>
        </div>
</div>
@stop