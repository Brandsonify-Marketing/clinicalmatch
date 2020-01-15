@extends('layouts.register-login')

@section('content')

<section class="login-sec verify-sec">
        <div class="container">
          <div class="login-create-form">
            <div class="verified-section thankyou-pg">
              <div class="row align-items-center">
                <div class="col-12 text-center profile-review-data">
                  <h1>Thank You!</h1>
                    <div class="verify-call">
                      <ul class="m-0 p-0">
                        <li class="call-verify">
                          <a href="{{ route('account.personal.index') }}">ENTER CLINICAL MATCH</a>
                        </li>
                      </ul>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection
