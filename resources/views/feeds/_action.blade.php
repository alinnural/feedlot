{!! Form::model($model, ['url' => $delete_url, 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message ]) !!}
    <a href="{{ $show_url }}" class="btn btn-xs btn-info">Detail</a>
    <a href="{{ $edit_url }}" class="btn btn-xs btn-warning">Ubah</a>
    {!! Form::submit('Hapus', ['class'=>'btn btn-xs btn-danger']) !!}
{!! Form::close()!!}