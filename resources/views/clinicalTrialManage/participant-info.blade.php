@extends('layouts.dashboard-menu')



@section('content')



<div class="page-container">

    <div class="dashbrd-section">

        @if(\Session::has('success'))

        <div class="alert alert-success w-100">

            {{\Session::get('success')}}

        </div>

        @endif

        <div class="page-title-hdng">

            <h5></h5>

            <h1>Participant Information</h1>

        </div>

        <div class="table-details">

            <table class="table" id="clinical-search">

                <thead>

                    <tr class="list-item">

                        <th scope="col">Participant Name</th>

                        <th scope="col">Phone Number</th>

                        <th scope="col">Email Address</th>

                        <th scope="col">Message</th>

                    </tr>

                </thead>

                <tr>
                    <td data-label="Participant Name">{{@$clinicalmanages->user->firstname . " " . @$clinicalmanages->user->lastname}}</td>

                    <td data-label="Phone Number"><a href="tel:{{@$clinicalmanages->user->profile->contact}}">{{@$clinicalmanages->user->profile->contact}}</a></td>

                    <td data-label="Email Address"><a href="mailto:{{ @$clinicalmanages->user->email}}">{{ @$clinicalmanages->user->email }}</a></td>

                    <td data-label="Message"><a href="{{route('message.chat',$clinicalmanages->user->id)}}">Message</a></td>

                </tr>

            </table>

        </div>

    </div>

</div>

</div>

</div>

@endsection

