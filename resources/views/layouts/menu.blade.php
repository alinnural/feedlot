<div class="col-md-3">
    <div class="row">
        <div class="col-md-12">
            {{--  <div class="list-group">
                {!! Html::smartNav(url('/'), 'Beranda','fa-home') !!}
                {!! Html::smartNav(url('/formula'), 'Formulasi Ransum','fa-calculator') !!}
                {!! Html::smartNav(url('/laktasi'), 'Kebutuhan Nutrien Laktasi','fa-check') !!}
                {!! Html::smartNav(route('ransums.index'),'Ransum','fa fa-list-ul ') !!}
                {!! Html::smartNav(url('/simulasi'), 'Simulasi Linear Programming','fa-code') !!}
                {!! Html::smartNav(url('/changelog'),'Perubahan Versi','fa-code-fork') !!}
            </div>  --}}
            
            <div class="panel panel-primary">
                <div class="panel-heading">{{ config('configuration.site_name') }}</div>
                <div class="panel-body">
                    {!! wordwrap(config('configuration.site_description'), 32, "<br />\n") !!}
                    <br>
                </div>
            </div>
            

            @role('admin')
            <div class="list-group">
                {!! Html::smartNav(route('groupfeeds.index'), 'Kelompok Pakan','fa fa-circle-o') !!}
                {!! Html::smartNav(route('feeds.index'), 'Pakan','fa fa-circle-o') !!}
                {!! Html::smartNav(route('units.index'),'Unit Nutrien','fa fa-circle-o') !!}
                {!! Html::smartNav(route('nutrients.index'),'Nutrien','fa fa-circle-o') !!}
                {!! Html::smartNav(route('requirements.index'),'Kebutuhan Ternak','fa fa-circle-o') !!}
            </div>
            @endrole
            

            <div class="list-group">
                <a href="#" class="list-group-item active">Pakan Ternak</a>
                {!! Html::smartNav(route('feeds.explore'),'Semua Pakan','fa fa-rss') !!}
                @php 
                    $groupfeed = App\GroupFeed::all();
                @endphp
                @foreach($groupfeed as $g)
                    {!! Html::smartNav(route('feeds.group_by_id',$g->id), $g->name.' ('.$g->getTotalFeedAttribute().')','fa fa-rss-square') !!}
                @endforeach
            </div>

            <div class="panel panel-primary">
                <div class="panel-body">
                    <iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;ctz=Asia%2FJakarta" style="border-width:0" width="220" height="200" frameborder="0" scrolling="no"></iframe>    
                </div>
            </div>
            
            <div class="list-group">
                <a href="#" class="list-group-item active">Berita Terbaru</a>
                @php 
                    $recentpost = App\Post::orderBy('created_at', 'desc')->paginate(3);
                @endphp
                @foreach($recentpost as $g)
                    {!! Html::smartNav(url('post',$g->slug), str_limit($g->title,29),'fa fa-newspaper-o') !!}
                @endforeach
            </div>
        </div>
    </div>
</div>