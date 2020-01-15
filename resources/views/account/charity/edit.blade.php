@extends('layouts.dashboard-menu')

@section('content')

<div class="page-container">
    <div class="dashbrd-section">
        <div class="page-title-hdng">
            <h5>My Account</h5>
            <h1>Update Non Profit Information</h1>
        </div>
          <div class="submit-paymnt back-btn">
                  <a href="{{ route('account.charity.index') }}">Back</a>
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

            <form method="post" action="{{ route('account.charity.update', $id)}}" >
                @method('PATCH')
                @csrf
                @if(isset($charity) && !empty($charity))
                <div class="form-group">
                    <label for="name">Charity Name:</label>
                    <input type="text" class="form-control" name="name" value={{$charity->name}}>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" name="address" value={{$charity->address}}>
                </div>
                <div class="form-group">
                    <label for="amount">Amount Donated:</label>
                    <input type="text" maxlength="10" class="form-control" name="amount" onkeypress="return isNumberKey(this, event);" value={{$charity->amount}}>
                </div>
                <div class="form-group">
                    <label for="ach">ACH</label>
                    <input type="text" class="form-control" name="ach" value={{$charity->ach}}>
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
    //Check if the text already contains the . character
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

@endsection
