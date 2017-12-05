@extends('layouts.app')

@section('title')
  Formula - {{ config('configuration.site_name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-plus-circle"></i> Masukkan harga per kilogram pakan</h4>
                </div>
                    {!! Form::open(['url' => 'formula/calculate','class'=>'form-horizontal','id'=>'input']) !!}
                    <div class="panel-body">
                        @foreach ($feeds as $fee)
                            <div class="form-group">
                                {!! Form::label('var', $fee->feed_stuff, ['class' => 'col-sm-5 control-label']) !!}
                                <div class="col-md-7">
                                    <input type="number" name="feeds_price[]" class="form-control" placeholder="Rupiah/Kilogram" required="required">
                                    <input type="hidden" name="feeds_price_id[]" value="{{ $fee->id }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-5"><a href="/" class="pull-left btn btn-lg btn-default" id="next"><i class="fa fa-lg fa-arrow-circle-o-left"></i> Kembali</a></div>
                            <div class="col-md-7">
                                {{ Form::button('<span class="fa fa-lg fa-calculator"></span> Hitung Optimasi', array('class'=>'btn btn-success btn-lg pull-right', 'type'=>'submit')) }}
                            </div>
                        <div>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="loader"></div>
@endsection

@section('scripts')
<script src="/js/jquery.validate.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".loader").fadeOut("slow");
    });
    
    $(document).on('click','.btn-remove',function(e){
        e.preventDefault();
        $(this).parents('.feeds-container').remove();

        $('#input').validate({ // initialize the plugin
            ignore: [],
            rules: {
                'feeds_price[]': {
                    required: true
                }
            },
            message: {
                'feeds_price[]':{
                    required: "Harga pakan (Rupiah/Kg) harus diisi",
                }
            }
        });
    });

    $('#calculate').click(function(){
        if(!$("#input").valid())
        {
            return false;
        }        
    });
</script>
@endsection

