@foreach($items as $menu_item)
<li>
    <a href="{{url($menu_item->link()) }}" target="_blank">
        <i class="{{ $menu_item->title }}" aria-hidden="true"></i>
    </a>
</li>
@endforeach