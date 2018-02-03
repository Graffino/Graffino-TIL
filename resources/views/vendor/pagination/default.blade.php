@if ($paginator->hasPages())
    <ul class="list pagination -type-simple -type-inline">
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="list__item"><a class="link" href="{{ $paginator->nextPageUrl() }}" rel="next">&lsaquo; Older posts</a></a></li>
        @endif

        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <li class="list__item"><a class="link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Newer posts &rsaquo;</li>
        @endif
    </ul>
@endif
