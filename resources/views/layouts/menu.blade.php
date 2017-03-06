<div class="col-md-3">
    <div class="list-group">
        {!! Html::smartNav(url('/'), 'Beranda','fa-home') !!}
        {!! Html::smartNav(url('/formula'), 'Formulasi Ransum','fa-calculator') !!}
        @role('admin')
            {!! Html::smartNav(route('groupfeeds.index'), 'Kelompok Pakan Sapi','fa fa-home') !!}
            {!! Html::smartNav(route('feeds.index'), 'Bahan Pakan Sapi','fa fa-home') !!}
            {!! Html::smartNav(route('requirements.index'),'Kebutuhan Nutrien Sapi','fa fa-home') !!}
        @endrole
        {!! Html::smartNav(url('/about'), 'Tentang Sistem','fa-cog') !!}
        {!! Html::smartNav(url('/contact'), 'Kontak Kami','fa-user') !!}
        {!! Html::smartNav(url('/changelog'),'Perubahan Versi','fa-code-fork') !!}
    </div>
</div>