@extends('layouts.app')

@section('title')
  Tentang Sistem - {{ config('configuration.site_name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Formula Ransum Sapi Potong</h3>
                    <br>
                    <p>
                        Sistem Formula Ransum sapi potong yang bisa melakukan formulasi dari kumpulan bahan pakan sapi potong untuk diformulasikan dengan menghasilkan harga yang paling minimum. 
                        Sistem ini menggunakan <strong><i>Linear Programming</i></strong> untuk mengkombinasikan semua pakan sapi sesuai dengan kebutuhan dari sapi tersebut.
                    </p>
                    <p>
                        Bahan pakan ternak dan kebutuhan sapi potong yang digunakan diperoleh dari <strong><i>National Research Council (1996) dalam buku Nutrient Requirements of Beef Cattle: Seventh Revised Edition.</i></strong>
                    </p>
                    <p>
                        Fokus penelitian ini adalah menghasilkan formula ransum yang optimal untuk memenuhi kebutuhan nutrisi hewan ternak dan mempertimbangkan harga termurah. Kebutuhan nutrisi ternak ditentukan berdasarkan jenis, berat badan, dan penambahan total berat badan perhari atau Average Daily Gain (ADG). Kandungan Nutrisi pakan ternak yang diformulasikan pada penelitian ini adalah Total Digestible Nutrient (TDN), protein kasar (CP), kalsium (C) dan posfor (P).
                    </p>
                </div>
            </div>
        </div>
        @mobile
            @include('layouts.menu-mobile')
        @endmobile
    </div>
@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        $(".loader").fadeOut("slow"); 
    });
</script>
@endsection