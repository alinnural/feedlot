@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Masukkan harga per kilogram pakan</div>
                    {!! Form::open(['url' => 'calculate','class'=>'form-horizontal','id'=>'input']) !!}
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
                            <div class="col-md-5"><a href="/input" class="pull-left btn btn-default" id="next">Kembali</a></div>
                            <div class="col-md-7">
                                <input type="submit" class="btn btn-success" id="calculate" value="Hitung Optimasi">
                            </div>
                        <div>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
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

