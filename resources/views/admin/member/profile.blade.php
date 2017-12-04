@extends('layouts.app')

@section('title')
  Profil User - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
      @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li class="active">Member</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Member</h2>
          </div>
          <div class="panel-body">
            <table class="table table-stripped">
                <tr>
                    <td>Nama</td>
                    <td>{{ $member->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $member->email }}</td>
                </tr>
                
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection