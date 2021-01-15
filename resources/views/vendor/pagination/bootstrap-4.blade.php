@if ($paginator->hasPages())
    <ul class="list pagination -type-simple -type-inline">
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="list__item"><a class="link" href="{{ ViewHelper::getUrl($paginator->nextPageUrl()) }}" rel="next">&lsaquo; Older posts</a></li>
        @endif

        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <li class="list__item"><a class="link" href="{{ ViewHelper::getUrl($paginator->previousPageUrl()) }}" rel="prev">Newer posts &rsaquo;</a></li>
        @endif
    </ul>
@endif
