@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ isset($contact) ? 'Edit Contact' : 'Add Contact' }}
        </div>

        <div class="card-body">               
            <form action="{{ isset($contact) ? url('contacts/'.$contact->id) : url('contacts') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($contact))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') ? old('first_name') : (isset($contact) ? $contact->first_name : '') }}"
                        class="form-control {{ $errors && $errors->has('first_name') ? 'is-invalid' : '' }}">
                    <span class="invalid-feedback">{{ $errors ? $errors->first('first_name') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') ? old('last_name') : (isset($contact) ? $contact->last_name : '') }}"
                        class="form-control {{ $errors && $errors->has('last_name') ? 'is-invalid' : '' }}">
                    <span class="invalid-feedback">{{ $errors ? $errors->first('last_name') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" value="{{ old('email') ? old('email') : (isset($contact) ? $contact->email : '') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="picture">Picture</label>
                    <input type="file" id="picture" name="picture">
                    @if(isset($contact))
                        <img src="{{ config('custom.contact_picture_base_url') }}/{{ $contact->picture }}" width="80"/>
                        <input type="hidden" name="oldPic" value="{{ $contact->picture }}" />
                    @endif
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" class="form-control">{{ old('address') ? old('address') : (isset($contact) ? $contact->addresses()->first()->address : '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') ? old('phone') : (isset($contact) ? $contact->phone->phone : '') }}" class="form-control">
                </div>

                <button class="btn btn-primary">Add</button>
            </form>    
        </div>
    </div>    

    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('address');
    </script>
@stop