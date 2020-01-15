@extends('layouts.dashboard-menu')

@section('content')

<div class="page-container">
        <div class="dashbrd-section">
            <div class="page-title-hdng">
              <h5>My Account</h5>
              <h1>Update Personal Information</h1>
            </div>
            <div class="clinically-form">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br />
                    @endif

                    <form action="{{ route('dashboard.personalupdate', Auth::user()->id) }}" enctype="multipart/form-data" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" name="first_name" value={{ $user->first_name }}>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" name="last_name" value={{ $user->last_name }} >
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" name="email" value={{ $user->email }}>
                        </div>
                        <div class="form-group">
                            <label for="address_info">Address:</label>
                            <input type="address_info" class="form-control" name="address_info" value={{$profile[0]->address_info}}>
                        </div>
                        <div class="form-group">
                            <label for="contact_info">Phone:</label>
                            <input type="contact_info" class="form-control" name="contact_info" value={{$profile[0]->contact_info}}>
                        </div>
                        <button type="submit" class="btn-typo">Update</button>
                    </form>
            </div>
          </div>
        </div>

@endsection
