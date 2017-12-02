@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Input Value</div>

                    {!! Form::open(['url' => 'sample/calculate','class'=>'form-horizontal']) !!}
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-4 control-label">
                                Pilih Persamaan
                            </div>
                            <div class="col-md-8">
                                {{ Form::radio('category', 'minimization', true) }} Minimization
                                {{ Form::radio('category','maximization') }} Maximization
                            </div>
                        </div>  
                        <input name="numbers" type="hidden" value="{{ $data['var'] }},{{ $data['cons'] }}">  
                        <br>
                        <div class="form-group">
                            <div class="col-md-4 control-label">
                                Fungsi Objektif
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    @for ($i = 1;$i<=intval($data['var']); $i++)
                                    <div class="col-md-2">
                                        {!! Form::text('var'.$i.'', '',['class'=>'form-control','placeholder'=>'X'.$i.'']) !!}
                                    </div>
                                    @if($i != intval($data['var']))
                                    <div class="col-md-1">
                                    +
                                    </div>
                                    @endif
                                @endfor
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                Constraints
                            </div>
                            <div class="col-md-12">
                                @for($k=1; $k<=intval($data['cons']); $k++)
                                    <div class="row" style="padding-top:5pt;">
                                        <div class="col-md-12">
                                        @for($j=1; $j<=intval($data['var']); $j++)
                                            <div class="col-md-2">
                                                {!! Form::text('cons'.$k.'_'.$j.'', '',['class'=>'form-control','placeholder'=>'X'.$j.'']) !!}
                                            </div>
                                            @if($i != intval($data['var']))
                                            <div class="col-md-1">
                                            +
                                            </div>
                                            @endif
                                        @endfor
                                        <div class="col-md-2">
                                            <select name='sign{{ $k }}'>
                                            <option value='lessThan'><=</option>
                                            <option value='greaterThan'>>=</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            {!! Form::text('answer'.$k.'','',['class'=>'form-control']) !!}
                                        </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                {!! Form::submit('Lanjut',['class'=>'btn btn-primary']) !!}
                            </div>
                        <div>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
