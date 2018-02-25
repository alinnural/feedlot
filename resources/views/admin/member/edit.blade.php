@extends('layouts.app')

@section('title')
  Edit Member - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
      @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/member') }}">Member</a></li>
          <li class="active">Ubah Members</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Ubah Member</h2>
</div>
          <div class="panel-body">
            {!! Form::model($member, ['url' => route('member.update', $member->id),'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!} 
                @include('admin.member._form')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection