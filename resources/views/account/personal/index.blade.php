@extends('layouts.dashboard-menu')

@section('content')
<div class="page-container">
<div class="dashbrd-section">
    <div class="page-title-hdng">
      <h5>My Account</h5>
      <h1>User Information</h1>
    </div>
    <h3>Overview</h3>
    @if(\Session::has('success'))
    <div class="alert alert-success">
        {{\Session::get('success')}}
    </div>
    @endif
    <div class="clinically-form">
      <form action="">
        <div class="table-details application-detail">
            <table id="personalinfo" class="table tble-bordered">
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
                        @if(isset($user->firstname) && !empty($user->firstname) || isset($user->lastname) && !empty($user->lastname))
                        <td>{{$user->firstname. " " .$user->lastname}}</td>
                         @else
                        <td></td>
                        @endif
                        <td>{{@$profile->address}}</td>
                        <td>{{@$profile->contact}}</td>  
                        @if(isset($user->email) && !empty($user->email))
                        <td>{{$user->email}}</td>
                        @else
                        <td></td>
                        @endif
                        <td><a href="{{ route('account.personal.edit')}}">Update Your User Information</a></td>
                    </tr>
                </table>
            </div>
      </form>
    </div>
  </div>
</div>
@endsection
