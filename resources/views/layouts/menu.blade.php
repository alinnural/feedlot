<div class="col-md-3">
    <div class="list-group">
        {!! Html::smartNav(url('/'), 'Beranda','fa-home') !!}
        {!! Html::smartNav(url('/formula'), 'Formulasi Ransum','fa-calculator') !!}
        @role('admin')
            {!! Html::smartNav(route('ransums.index'),'Ransum','fa fa-home') !!}
        @endrole
        {!! Html::smartNav(url('/changelog'),'Perubahan Versi','fa-code-fork') !!}
    </div>

    <div class="list-group">
        @role('admin')
            {!! Html::smartNav(route('groupfeeds.index'), 'Kelompok Pakan','fa fa-home') !!}
            {!! Html::smartNav(route('feeds.index'), 'Pakan','fa fa-home') !!}
            {!! Html::smartNav(route('units.index'),'Unit Nutrien','fa fa-home') !!}
            {!! Html::smartNav(route('nutrients.index'),'Nutrien','fa fa-home') !!}
            {!! Html::smartNav(route('requirements.index'),'Kebutuhan Ternak','fa fa-home') !!}
        @else
            {!! Html::smartNav(route('feeds.explore'),'Semua Pakan','fa fa-rss') !!}
            @php 
                $groupfeed = App\GroupFeed::all();
            @endphp
            @foreach($groupfeed as $g)
                {!! Html::smartNav(route('feeds.group_by_id',$g->id), $g->name.' ('.$g->getTotalFeedAttribute().')','fa fa-rss-square') !!}
            @endforeach
        @endrole
    </div>
</div>