@if ($paginator->hasPages())
    <nav class="pagination">
        <ul>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li><button wire:click="" id="prev"><span class="">«</span></button></li>
            @else
                <li><button id="prev" wire:click="previousPage" rel="prev" class="pagination-clickable">«</button></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><button class="disabled" aria-disabled="true"><span>{{ $element }}</span></button></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><button id="page-{{$page}}" wire:click="" aria-current="page" class="pagination-active">{{ $page }}</span></button></li>
                        @else
                            <li><button id="page-{{$page}}" wire:click="gotoPage({{$page}})" wire:loading.attr="disabled" class="pagination-clickable">{{ $page }}</button></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><button id="next" wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="pagination-clickable">»</button></li>
            @else
                <li><button wire:click="" id="next"><span class="">»</span></button></li>
            @endif
        </ul>
    </nav>
@endif