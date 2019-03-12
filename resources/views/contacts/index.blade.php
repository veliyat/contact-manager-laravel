@extends('layouts.app')

@section('content')
    <div class="card">
            <div class="card-header">
                Contacts

                <a class="btn btn-primary float-right" href="{{ url('contacts/create') }}">
                    <i class="fas fa-plus"></i>
                    Add Contact
                </a>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col">
                    
                        <form action="{{ url('/contacts') }}" method="get">                            
                            <div class="form-row form-group">
                                <div class="col col-md-11 col-xs-11">
                                    <input name="q" value="{{ $query }}" class="form-control" placeholder="Search Here..." />
                                </div>
                                
                                <div class="col">
                                    <button class="btn btn-primary btn-block">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        {{ $contacts->links() }}
                    </div>
                </div>

                <div class="row">
                    @foreach($contacts as $contact)
                        <div class="col-md-3">
                            <div class="card" style="margin-bottom: 12px;">
                                <img src="{{ config('custom.contact_picture_base_url').$contact->picture }}" class="card-img-top" alt="{{ $contact->first_name }}"/>
                                <div class="card-body">
                                    {{ $contact->first_name }} {{ $contact->last_name}}

                                    <p>
                                        <form action="{{ url('/contacts/'.$contact->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger float-left" style="margin-right: 4px;">
                                                <i class="fas fa-times-circle"></i>
                                            </button>
                                        </form>

                                        <a href="{{ url('contacts/'.$contact->id) }}" class="btn btn-success float-left" style="margin-right: 4px;">
                                            <i class="fas fa-address-card"></i>
                                        </a>

                                        <a href="{{ url('contacts/'.$contact->id.'/edit') }}" class="btn btn-warning float-left">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="row">
                    <div class="col">
                        {{ $contacts->links() }}
                    </div>
                </div>

            </div>            
    </div>
@stop