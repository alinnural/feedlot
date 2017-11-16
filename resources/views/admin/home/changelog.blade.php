@extends('admin/app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                   <h2>Pembaruan Sistem</h2>
                    @foreach($res as $release)
                    <div class="col-md-1"><a href="{{ $release->html_url}}"><h2><i class="fa fa-tag"></i></h2></a></div>
                    <div class="col-md-11">
                    <h2><a href="{{ $release->html_url}}"> {{ $release->tag_name }}</a></h2>
                    <blockquote>
                        <h4>{{ $release->name }}</h4>
                        <a href="{{ $release->zipball_url }}"><i class="fa fa-file-archive-o"></i> Souce Code (zip)</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ $release->tarball_url }}"><i class="fa fa-file-archive-o"></i> Souce Code (tar.gz)</a>
                        <br>
                        <br>
                        <div class="published">Published at {{ $release->published_at }}</div>
                    </blockquote>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

