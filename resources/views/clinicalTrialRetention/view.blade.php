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
                <h1>List of Patients</h1>
              </div>
              <div class="table-tab">
              </div>
                <div class="table-details">
                        <table class="table" id="clinical-search">
                          <thead>
                            <tr class="list-item">
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Phone</th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tr>
                            @foreach($patients as $patient)
                            <tr>
                              <td data-label="Name">{{ $patient['name'] }}</td>
                              <td data-label="Email">{{ $patient['email'] }}</td>
                              <td data-label="Phone">{{ $patient['phone'] }}</td>
                              <td><a href="mailto:{{ $patient['email'] }}?Subject=Hello%20again" target="_top">Send Mail</a></td>
                              <td><a href="tel:{{ $patient['phone'] }}" style="color:red">Call</td>
                            </tr>
                            @endforeach
                          </tr>
                        </table>
                </div>
              </div>
            </div>
        </div>
      </div>
@endsection