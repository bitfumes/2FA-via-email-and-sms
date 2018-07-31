@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Enter OTP</div>

                <div class="card-body">
                    <form action="/verifyOTP" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="otp">Your OTP</label>
                            <input type="text" name="otp" id="otp" class="form-control" required>
                        </div>
                        <input type="submit" value="Verify" class="btn btn-info">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection