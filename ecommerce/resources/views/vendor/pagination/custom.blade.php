@if ($paginator->hasPages())
    <ul class="pagination justify-content-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Anterior">&laquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link" style="background:#000;color:#fff;border-radius:8px;">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}" style="border-radius:8px;">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Próxima">&raquo;</a>
            </li>
        @else
            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
        @endif
    </ul>
@endif

<style>
.pagination .page-link {
    color: #000;
    background-color: #fff;
    border: 1px solid #dee2e6;
    margin: 0 2px;
    transition: background 0.2s, color 0.2s;
}
.pagination .page-item.active .page-link {
    background-color: #000;
    color: #fff;
    border-color: #000;
}
.pagination .page-link:hover {
    background-color: #222;
    color: #fff;
    border-color: #000;
}
.pagination .page-item.disabled .page-link {
    color: #aaa;
    background: #f8f9fa;
    border-color: #dee2e6;
}
</style> 