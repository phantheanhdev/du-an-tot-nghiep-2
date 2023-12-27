@extends('admin.layout.content')
@section('main-content')
<div class="col-12 col-lg-9">
    <div class="ibox float-e-margins" id="boxOrder">
        <div class="ibox-content">
            <div class="sk-spinner sk-spinner-wave">
                <div class="sk-rect1"></div>
                <div class="sk-rect2"></div>
                <div class="sk-rect3"></div>
                <div class="sk-rect4"></div>
                <div class="sk-rect5"></div>
            </div>

            <h3 class="text-qrRest-dark text-center">Tất cả bàn</h3>
            <div class="text-center">
                <span class="badge badge-dark mr-2"><i class="fa fa-cutlery"></i> : Bàn có khách</span>
                <span class="badge badge-dark mr-2"> <i class="fa fa-minus"></i> : Bàn trống</span>
                <span class="badge badge-dark mr-2"> <i class="fa fa-bell"></i> : Có đơn mới</span>
            </div>
            <hr />
            <div class="col-md-12">
                <div class="row">
                    @foreach ($tables as $table)
                    <a href="{{ route('order-of-table', $table->id) }}" class="text-white">
                        <div id="table-{{ $table->name }}" class="widget p-lg text-center 
                        @if($table->orders->filter(function ($order) {
                            return $order->status == 0;
                        })->count() > 0)
                        yellow-bg
                        
                        @elseif($table->orders->filter(function ($order) {
                            return $order->status == 1;
                        })->count() > 0)
                        green-bg
                        
                        @else
                        black-bg
                        @endif
                         " style="height: 160px;">
                            <div class="m-b-md">
                                
                                @if (
                                $table->orders->filter(function ($order) {
                                return $order->status == 0 ;
                                })->count() > 0)
                                <i id="table-icon-2-{{$table->id}}" class="fa fa-bell fa-4x"></i>
                                <br />
                                <small id="table-notification-{{ $table->id }}">Có đơn mới</small>
                                @elseif (
                                $table->orders->filter(function ($order) {
                                return  $order->status == 1;
                                })->count() > 0)
                                <i id="table-icon-2-{{$table->id}}" class="fa fa-cutlery fa-4x"></i>
                                <br />
                                <small id="table-notification-{{ $table->id }}">Bàn có khách</small>
                                @else
                                <i id="table-icon-2-{{$table->id}}" class="fa fa-minus fa-4x"></i>
                                <br />
                                <small id="table-notification-{{ $table->id }}">Bàn trống</small>
                                @endif

                                <h3 class="font-bold no-margins">
                                    Bàn số: {{ $table->name }}
                                </h3>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script src="//js.pusher.com/3.1/pusher.min.js"></script>
<script type="text/javascript">
    var pusher = new Pusher('3f445aa654bdfac71f01', {
        encrypted: true,
        cluster: "ap1"
    });

    var channel = pusher.subscribe('development');

    channel.bind('App\\Events\\HelloPusherEvent', function(data) {
        let originClass = ''
        if (data.message.includes('có đơn mới')) {
            $('#table-' + data.id).addClass('yellow-bg');
            $('#table-notification-' + data.id).text('Có đơn mới');
            $('#table-icon-2-' + data.id).addClass('fa fa-bell fa-4x');
        } else {
            originClass = $('#table-' + data.id).attr('class');
            $('#table-' + data.id).addClass('red-bg').removeClass('green-bg').removeClass('yellow-bg');
        }

        Command: toastr["warning"](data.message)

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "20000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        var audio = new Audio('{{ asset('Doorbell.mp3 ') }}');
        audio.addEventListener('canplaythrough', function() {
            audio.play();
        });;

        setTimeout(function() {

            $('#table-' + data.id).addClass(originClass).removeClass('red-bg')
            if (data.message.includes('có đơn mới')) {
                $('#table-' + data.id).addClass('yellow-bg');
                $('#table-notification-' + data.id).text('Có đơn mới')
            }
        }, 20000);
    });
    
</script>
@endsection