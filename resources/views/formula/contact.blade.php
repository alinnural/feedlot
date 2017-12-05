@extends('layouts.app')

@section('title')
  Kontak - {{ config('configuration.site_name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-sm-5">
                        <h2>Kontak</h2>
                        <ul class="list-icons list-unstyled">
                            <li><i class="fa fa-phone"></i> Phone: 085222828740</li>
                            <li><i class="fa fa-envelope"></i> Email: <a href="mailto:ihsan_arif@apps.ipb.ac.id">ihsan_arif@apps.ipb.ac.id</a></li>
                            <li><i class="fa fa-check-square-o"></i> Website: <a href=""> ihsanarif.com</a></li>
                        </ul>
                        <div class="spacer"></div>
                        <div class="social-icons">
                                            <a href="http://facebook.com/ihsan.arif.rahman" class="social-icon"><i class="fa fa-facebook" target="_blank"></i></a>
                                            <a href="http://twitter.com/ihsanarifr" class="social-icon"><i class="fa fa-twitter" target="_blank"></i></a>
                                            <a href="http://linkedin.com/ihsanarif" class="social-icon"><i class="fa fa-linkedin" target="_blank"></i></a>
                                            <a href="http://www.instagram.com/ihsanarifr" class="social-icon"><i class="fa fa-instagram" target="_blank"></i></a>
                                        </div> <!-- end .social-icons -->
                        <div class="spacer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        $(".loader").fadeOut("slow"); 
    });
</script>
@endsection