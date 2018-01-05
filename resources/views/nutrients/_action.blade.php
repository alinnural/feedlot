{!! Form::model($model, ['url' => $delete_url, 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message ]) !!}
    <a href="{{ $edit_url }}" class="btn btn-xs btn-warning">Ubah</a>
    @if($model->id>9)
        {!! Form::submit('Hapus', ['class'=>'btn btn-xs btn-danger']) !!}
    @endif
{!! Form::close()!!}