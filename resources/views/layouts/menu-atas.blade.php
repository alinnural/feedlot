@php
$menu = App\Menu::IsParentParentID()->orderBy('position','asc')->get();
@endphp

@foreach($menu as $m)
    @if($m['have_child'])
        <li class="dropdown">
            <a href="{{ url($m['url']) }}" class="dropdown-toggle" data-toggle="dropdown">{{ $m['name'] }} <span class="caret"></span></a>
            
            <ul class="dropdown-menu">
                @php $child = App\Menu::Where('parent_id',$m['id'])->orderBy('position','asc')->get(); @endphp
                @foreach($child as $c)
                    <li class="menu-item"><a href="{{ url($c['url']) }}">{{ $c['name'] }}</a></li>
                @endforeach
            </ul>
        </li>
    @else
        <li class="menu-item"><a href="{{ url($m['url']) }}">{{ $m['name'] }}</a></li>
    @endif
@endforeach