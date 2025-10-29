@vite('resources/css/modules/custom-paginator.css')
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{!! __('Pagination Navigation') !!}" class="paginator-cont">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="paginator-navigation paginator-navigation-dis">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="paginator-navigation paginator-previous-page">
                {!! __('pagination.previous') !!}
            </a>
        @endif
        <span>
            Displaying page {{ $paginator->currentPage() }} of total pages {{ $paginator->lastPage() }}
        </span>
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="paginator-navigation paginator-next-page">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="paginator-navigation paginator-navigation-dis">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
