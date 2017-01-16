@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Masukkan Harga Per kilogram Pakan</div>
                    {!! Form::open(['url' => 'calculate','class'=>'form-horizontal']) !!}
                    <div class="panel-body">
                        @foreach ($feeds as $fee)
                            <div class="form-group">
                                {!! Form::label('var', $fee->feed_stuff, ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-md-8">
                                    <input type="number" name="feeds_price[]" class="form-control" placeholder="Rupiah/Kilogram">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <input type="submit" class="pull-right btn btn-primary" value="Hitung Optimasi">
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
<script type="text/javascript">
    $(document).on('click','.btn-remove',function(e){
        e.preventDefault();
        $(this).parents('.feeds-container').remove();
    });
</script>
@endsection

