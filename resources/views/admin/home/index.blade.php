@extends('admin/app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1>Selamat Datang, {{ Auth::user()->name }}</h1>
                    <hr>
                    <div class="row">
                        <div class="col-sm-2">
                        <!-- small box -->
                            <div class="well well-sm">
                                <div class="inner">
                                    <h2 class="text-right">{{ $post }}</h2>
                                    <a href="{{ route('post.index') }}"><p class="text-right">Semua Berita</p></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                        <!-- small box -->
                            <div class="well well-sm">
                                <div class="inner">
                                    <h2 class="text-right">{{ $page }}</h2>
                                    <a href="{{ route('page.index') }}"><p class="text-right">Semua Halaman</p></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                        <!-- small box -->
                            <div class="well well-sm">
                                <div class="inner">
                                    <h2 class="text-right">{{ $menu }}</h2>
                                    <a href="{{ route('menu.index') }}"><p class="text-right">Semua Menu</p></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                        <!-- small box -->
                            <div class="well well-sm">
                                <div class="inner">
                                    <h2 class="text-right">{{ $album }}</h2>
                                    <a href="{{ route('album.index') }}"><p class="text-right">Semua Album</p></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                        <!-- small box -->
                            <div class="well well-sm">
                                <div class="inner">
                                    <h2 class="text-right">{{ $image }}</h2>
                                    <a href="{{ route('album.index') }}"><p class="text-right">Semua Photo</p></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                        <!-- small box -->
                            <div class="well well-sm">
                                <div class="inner">
                                    <h2 class="text-right">{{ $social }}</h2>
                                    <a href="{{ route('social.index') }}"><p class="text-right">Semua Social Media</p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>                                        
                    <canvas id="canvas" height="200" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<script>
    var data_chart = {};
    
    function respondCanvas() {
        var ctx = document.getElementById("canvas").getContext("2d");
        //Call a function to redraw other content (texts, images etc)
        var myLineChart = Chart.Line(ctx,{
            data: {
                datasets: data_chart,
            },
            options: {
                scales: {
                    xAxes: [{
                        type: 'time',
                        time: {
                            displayFormats: {
                                month: 'MMM YYYY'
                            },
                            unit : 'month',
                        }
                    }]
                }
            }

        });
    }

    var GetChartData = function () {
        $.ajax({
            url: '{{ url('admin/ajax/getVisitorAndViews') }}',
            method: 'GET',
            dataType: 'json',
            success: function (d) {
                data_chart = d;
                console.log(d);
                respondCanvas();
            }
        });
    };

    $(document).ready(function() {
        GetChartData();
    });
</script>

@endsection

