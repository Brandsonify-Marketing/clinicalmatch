@extends('layouts.dashboard-menu')
@section('content')
<div class="page-container">
    <div class="dashbrd-section">
        <div class="page-title-hdng">
            <h5>My Account</h5>
            <h1>Update Banking Information</h1>
        </div>
        <div class="submit-paymnt back-btn">
                  <a href="{{ route('account.bank.index') }}">Back</a>
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
            <form method="post" action="{{ route('account.bank.update', $id)}}" >
                @method('PATCH')
                @csrf
                @if(isset($bankdetail) && !empty($bankdetail))
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" value={{$bankdetail->name}}>
                </div>
                <div class="form-group">
                    <label for="account_number">Account Number:</label>
                    <input type="text" maxlength="14" class="form-control" name="account_number" onkeypress="return isNumberKey(this, event);" value={{$bankdetail->account_number}}>
                </div>
                <div class="form-group">
                    <label for="routing_number">Routing Number:</label>
                    <input type="text" maxlength="14" class="form-control" name="routing_number" onkeypress="return isNumberKey(this, event);" value={{$bankdetail->routing_number}}>
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" class="form-control" name="location" value={{$bankdetail->location}}>
                </div>
                <div class="form-group">
                    <label for="account_type">Account Type:</label>
                    <input type="text" class="form-control" name="account_type" value={{$bankdetail->account_type}}>
                </div>
                <div class="form-group">
                    <label for="account_info">Account Information:</label>
                    <input type="text" class="form-control" name="account_info" value={{$bankdetail->account_info}}>
                </div>
                <div class="form-group">
                    <label for="ach">Status:</label>
                    <input type="text" class="form-control" name="status" value={{$bankdetail->status}}>
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
