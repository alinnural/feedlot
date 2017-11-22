@extends('layouts.app')

@section('title')
  Detail Member - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/members') }}">Member</a></li>
          <li class="active">Detail {{ $member->name }}</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Detail {{ $member->name }}</h2>
        </div>
          <div class="panel-body">
            <h2 class="">{{ $member->name }}</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection