@if($paginator->hasPages())
        <ul>
        @if ($paginator->onFirstPage())
            <li class="disabled"> <a href="#" rel="prev"> <span> &ensp;Prev </span> </a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><span class="flaticon-left222"></span>&ensp;Prev</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><a href="#" class="active">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next&ensp;<span class="flaticon-right11"></span></a></li>
        @else
            <li class="disabled"> <a href=""> <span>Next&ensp;</span> </a></li>
        @endif
        </ul>
@endif