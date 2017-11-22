{!! Form::model($model, ['url' => $delete_url, 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message ]) !!}
    {!! Form::button('<span class="fa fa-trash"></span> Hapus', ['class'=>'btn btn-xs btn-danger','type'=>'submit']) !!}
{!! Form::close()!!}