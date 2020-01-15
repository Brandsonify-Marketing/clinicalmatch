@extends('layouts.dashboard-menu')

@section('content')

<div class="page-container">
    <div class="dashbrd-section">
        <div class="page-title-hdng">
            <h5>Find a Clinical Trial</h5>
        </div>
        <div class="clinically-form">
            <div class="table-tab">
                <h5>Overview</h5>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

            </div>
            <div class="table-details">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name of Clinical Trial</th>
                            <th scope="col">Posted</th>
                            <th scope="col">Expires</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clinicaltrials as $clinicaltrial)
                        <tr>
                            <td data-label="Name of Clinical Trial">{{ $clinicaltrial->study_title }}</td>
                            <td data-label="Posted: ">{{ \Carbon\Carbon::parse($clinicaltrial->created_at)->format('m.d.Y')}}</td>
                            <td data-label="Expires: ">{{ $clinicaltrial->expiry_date }}</td>
                            <td data-label="Description: "><p>{{ $clinicaltrial->rationale }}</p></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="more-detail">
                <a href="#">more</a>
            </div>
        </div>
    </div>
</div>

@endsection
