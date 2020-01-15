@extends('layouts.dashboard-menu')

@section('content')

<div class="page-container">
        <div class="dashbrd-section">
            <div class="page-title-hdng">
              <h5>My Account</h5>
              <h1>Update Payment Information</h1>
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

                    <form method="post" action="{{ route('account.payment.update', $id)}}" >
                        @method('PATCH')
                        @csrf
                        @if(isset($paydetail) && !empty($paydetail))
                        <div class="form-group">
                                <label for="credit_card_info">Credit Card Number:</label>
                                <input type="text" maxlength="14" class="form-control" onkeypress="return isNumberKey(this, event);" name="credit_card_info" value={{$paydetail->credit_card_info}}>
                            </div>
                            <div class="form-group">
                                <label for="ach_info">ACH Information</label>
                                <input type="text" class="form-control" name="ach_info" value={{$paydetail->ach_info}}>
                            </div>
                        @endif
                        <button type="submit" class="btn-typo">Update</button>
                    </form>
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
    function show1(){
      $('#div1').show();
    }
    function show2(){
      $('#div1').hide();
    }
    function show_medical(){
      $('#upload_file').show();
      $('#upload_medical').show();
    }
    function hide_medical(){
      $('#upload_file').hide();
      $('#upload_medical').hide();
    }
</script>    
@endsection
