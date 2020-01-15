@foreach($items as $key => $menu_item)
<li class="nav-item @if($key == 1) submenu-ul @endif">
    <a class="nav-link" href="{{url($menu_item->link()) }}">{{ $menu_item->title }}</a>
    @if($key == 1)
<ul class="submenu-li">
    <li><a href="{{ url('/') }}/service-detail">Clinical Trial Management & Retention</a></li>
    <li><a href="{{ url('/') }}/service-discovery-detail">Clinical Trial Discovery</a></li>
</ul>
@endif
</li>

@endforeach