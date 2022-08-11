@if($menu)
    <div class="headings-title">
        <h4><span>Subcategories for {{$category}}</span></h4>
    </div>
    <nav class="submenu">
        {!! $menu !!}
    </nav>
@endif
