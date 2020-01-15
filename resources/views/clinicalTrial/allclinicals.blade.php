@extends('layouts.dashboard-menu')

@section('content')
        <div class="page-container">
            <div class="dashbrd-section">
              <div class="page-title-hdng">
                <h5></h5>
                <h1>Find a Clinical Trial</h1>
              </div>
              <div class="clinically-form">
                <div class="table-serch">
                  <form action="{{ route('account.bank.delete', $bank->id) }}" method="post">
                  <div class="search-input">
                    <input type="search" placeholder="Search" name="">
                  </div>
                 </form>
                  <div class="search-sbmit">
                    <input class="btn-trans" type="submit" value="submit" name="">
                    <button class="btn-trans">Filter</button>
                  </div>
                </div>
                <div class="table-details">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Applicant Name</th>
                              <th scope="col">Posted</th>
                              <th scope="col">Study Interest</th>
                              <th scope="col">Status</th>
                              <th scope="col">Clinical Trial Name</th>
                              <th scope="col">Patient Name</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($clinicalmanages as $clinicalmanage)
                            <tr class="list-item">
                              <td>{{ $clinicalmanage->id }}</td>
                              <td>{{ $clinicalmanage->id }}</td>
                              <td>{{ $clinicalmanage->study_title }}</td>
                              <td>{{ $clinicalmanage->status }}</td>
                              {{-- <td data-label="Posted: ">{{ \Carbon\Carbon::parse($subinvestigator->created_at)->format('d.m.Y')}}</td>
                              <td data-label="Expires: ">08.17.2019</td>
                              <td data-label="Description: "><p>{{ $clinicaltrial->rationale }}</p></td>
                              <td><a href="{{action('ClinicalManageController@viewtrials',$clinicaltrial->id)}}">View</a></td> --}}
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                </div>
                <div class="more-detail">
                  <a href="javascript:void(0):" id = "ViewMoreListItem">view more</a>
                </div>
              </div>
            </div>
        </div>
      </div>
@endsection
