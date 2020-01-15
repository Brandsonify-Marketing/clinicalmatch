@extends('layouts.dashboard-menu')

@section('content')

<div class="page-container">
    <div class="dashbrd-section">
        <div class="page-title-hdng">
            <h5>Update Research Sites</h5>
        </div>
        <div class="submit-paymnt back-btn">
            <a href="{{ route('clinicalTrialRetention.research-site',$id) }}">Back</a>
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

            <form method="post" action="{{ route('clinicalTrialRetention.update-research-sites', $id)}}" >
                @method('PATCH')
                @csrf
                @if(isset($researchSite) && !empty($researchSite))
                <div class="form-group">
                    <label for="address">Site address:</label>
                    <input type="text" class="form-control" name="address" value={{$researchSite->address}}>
                </div>
                <div class="form-group">
                    <label for="address">City:</label>
                    <input type="text" class="form-control" name="city" value={{$researchSite->city}}>
                </div>
                <div class="form-group">
                    <label for="address">State:</label>
                    <input type="text" class="form-control" name="state" value={{$researchSite->state}}>
                </div>
                <div class="form-group">
                    <label for="address">Zip Code:</label>
                    <input type="text" class="form-control" name="zipcode" value={{$researchSite->zipcode}}>
                </div>
                <div class="form-group">
                    <label for="address">Contact Name:</label>
                    <input type="text" class="form-control" name="contact_name" value={{$researchSite->contact_name}}>
                </div>
                <div class="form-group">
                    <label for="address">Email:</label>
                    <input type="text" class="form-control" name="contact_email" value={{$researchSite->contact_email}}>
                </div>
                <div class="form-group">
                    <label for="address">Phone:</label>
                    <input type="text" class="form-control" name="contact_phone" value={{$researchSite->contact_phone}}>
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
        if (txt.value.indexOf('.') === -1) {
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
