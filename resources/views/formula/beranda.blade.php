@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                <h3>Selamat Datang di Sistem Formula Ransum Sapi Potong</h3>
                <br>
                Menggunakan ForSum Sapi Potong ini, Anda dapat merumuskan diet dengan <i class="font-color:red;font-style:solid">biaya minimum</i> untuk ternak serta untuk memprediksi kenaikan berat badan hewan.
                Anda juga bisa memberikan tabel komposisi pakan dan bahkan memberikan kontribusi dengan mengirimkan data pada komposisi pakan yang Anda inginkan!
                Pilih opsi yang diinginkan di bawah atau gunakan menu samping.
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