@extends('admin.layout.content')
@section('main-content')
    <div class="col-12 col-lg-9">
        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content">
                <div class="row">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?data=http://127.0.0.1:8000/restaurant-manager&amp;size=200x200"
                        alt="" title="" />
                </div>
                <div class="row mt-5">
                    <a href="https://api.qrserver.com/v1/create-qr-code/?data=http://127.0.0.1:8000/restaurant-manager&amp;size=200x200"
                        download="qr-code.png">
                        <button class="btn btn-primary">Tải qr code</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
