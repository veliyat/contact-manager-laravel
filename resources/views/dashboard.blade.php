@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <p>You are logged in!</p>

            <hr />

            <h3>
                Contacts
                <a href="{{ url('contacts') }}">
                    <span class="badge badge-success">{{ $total_contacts }}</span>
                </a>
            </h3>
        </div>
    </div>
@endsection
