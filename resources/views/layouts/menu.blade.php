<div class="col-md-3">
    <div class="list-group">
        {!! Html::smartNav(url('/'), 'Beranda','fa-home') !!}
        {!! Html::smartNav(url('/formula'), 'Formulasi Ransum','fa-calculator') !!}
        @role('admin')
            {!! Html::smartNav(route('groupfeeds.index'), 'Kelompok Pakan','fa fa-home') !!}
            {!! Html::smartNav(route('feeds.index'), 'Pakan','fa fa-home') !!}
            {!! Html::smartNav(route('units.index'),'Unit Nutrien','fa fa-home') !!}
            {!! Html::smartNav(route('nutrients.index'),'Nutrien','fa fa-home') !!}
            {!! Html::smartNav(route('feednutrients.index'),'Nutrien Pakan','fa fa-home') !!}
            {!! Html::smartNav(route('requirements.index'),'Kebutuhan Ternak','fa fa-home') !!}
        @endrole
        {!! Html::smartNav(url('/changelog'),'Perubahan Versi','fa-code-fork') !!}
    </div>
</div>