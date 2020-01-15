@extends('layouts.dashboard-menu')

@section('content')

<div class="page-container">
        <div class="dashbrd-section">
            <div class="page-title-hdng">
              <h5>My Account</h5>
              <h1>Update Personal Information</h1>
            </div>
            <div class="submit-paymnt back-btn">
                  <a href="{{ route('account.personal.index') }}">Back</a>
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
                    <form action="{{ route('account.personal.update') }}" enctype="multipart/form-data" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" name="firstname" value={{ $user->firstname }}>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" name="lastname" value={{ $user->lastname }} >
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="address" class="form-control" name="address" value={{ @$profile->address }}>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact Number:</label>
                            <input type="contact" maxlength="10" placeholder="xxx-xxx-xxxx" class="form-control" onkeypress="return isNumberKey(this, event);" name="contact" value={{ @$profile->contact }}>
                        </div>
<!--                         <div class="form-group">
                          <div class="upload_files">
                            <span>Profile Image: <input type="file" name="image" value={{ @$profile->image }}></span>
                            <br>
                            @if(!empty($profile->image))
                            <img src="{{ url('storage/profile-image/'.$profile->image)}}" width="200px"/>                  
                            @endif
                          </div>
                        @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color:red">{{ $message }}</strong>
                                </span>
                        @enderror -->
                        <div class="form-group">
<!--                           <div class="upload_files"> -->
                            <span>Profile Image: <input type="file" 
                                                    class="filepond"
                                                    name="image"
                                                    accept="image/png, image/jpeg, image/gif"/></span>
                            <br>
                            @if(!empty($profile->image))
                            <img src="{{ url('storage/profile-image/'.$profile->image)}}" width="200px"/>                  
                            @endif
<!--                           </div> -->
                        @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color:red">{{ $message }}</strong>
                                </span>
                        @enderror
                        </div>
                        <button type="submit" class="btn-typo">Update</button>
                    </form>
                   <div class="reset-pass text-center">
                    @if(empty( Auth::user()->provider))
                    <a href="{{ route('profile.change')}}" class="btn-typo">Reset password</a>
                    @endif
                </div>
            </div>
          </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
            function isNumberKey(txt, evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode == 46) {
            if (txt.value.indexOf('.') === - 1) {
            return true;
            } else {
            return false;
            }
            } else {
            if (charCode > 31
                    && (charCode < 48 || charCode > 57))
                    return false;
            }
            return true;
            }
        </script>

    <!-- include FilePond library -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<!-- include FilePond plugins -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
<!-- include FilePond jQuery adapter -->
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
    <script>
    FilePond.registerPlugin();
    var element = document.querySelector('meta[name="csrf-token"]');
    var csrf = element && element.getAttribute("content");
    FilePond.setOptions({
      server: {
            url: "{{ url('account/personal/upload')}}",
            process: {
                headers: {
                  'X-CSRF-TOKEN': csrf 
                },
            }
        }
    });
    const inputElement = document.querySelector('input[name="image"]');
    const pond = FilePond.create( inputElement );
    </script>

@endsection
@section('scripts')
<script src="https://unpkg.com/jquery-input-mask-phone-number@1.0.11/dist/jquery-input-mask-phone-number.js"></script>
<script type="text/javascript">
            $(document).ready(function () {
                  $('input[name="contact"]').usPhoneFormat();
            });
</script>
@endsection
