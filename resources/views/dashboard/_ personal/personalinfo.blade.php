@extends('layouts.dashboard-menu')

@section('content')
<div class="page-container">
<div class="dashbrd-section">
    <div class="page-title-hdng">
      <h5>My Account</h5>
      <h1>Personal Information</h1>
    </div>
    <h3>Overview</h3>
    @if(\Session::has('success'))

    <div class="alert alert-success">
        {{\Session::get('success')}}
    </div>

    @endif
    <div class="clinically-form">
      <form action="">
            <table id="personalinfo" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tr>
                        @if(isset($user->first_name) && !empty($user->first_name) || isset($user->last_name) && !empty($user->last_name))
                        <td>{{$user->first_name. " " .$user->last_name}}</td>
                        @endif

                        @if(isset($profile[0]->address_info) && !empty($profile[0]->address_info))
                        <td>{{$profile[0]->address_info}}</td>
                        @endif

                        @if(isset($profile[0]->contact_info) && !empty($profile[0]->contact_info))
                        <td>{{$profile[0]->contact_info}}</td>
                        @endif

                        @if(isset($user->email) && !empty($user->email))
                        <td>{{$user->email}}</td>
                        @endif

                        <td><a href="{{action('DashboardController@editprofile',Auth::user()->id)}}">Update Your Personal Information</a></td>
                    </tr>
                </table>
      </form>
    </div>
  </div>
</div>
@endsection
