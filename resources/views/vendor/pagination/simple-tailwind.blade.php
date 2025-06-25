@if ($paginator->hasPages())
    <nav id="pagination-nav" role="navigation" aria-label="Pagination Navigation" class="flex justify-between gap-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="place-content-center grid bg-indigo-400 rounded-full w-[20px] h-[20px] scale-[0.95]">
                <span class="fa-arrow-left text-[8px] text-white fa-solid"></span>
            </span>
        @else
            <a rel="prev" href="{{ $paginator->previousPageUrl() }}" class="place-content-center grid bg-indigo-900 rounded-full w-[20px] h-[20px] animate-pulse">
                <span class="fa-arrow-left text-[8px] text-white fa-solid"></span>
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a rel="next" href="{{ $paginator->nextPageUrl() }}" class="place-content-center grid bg-indigo-900 rounded-full w-[20px] h-[20px] animate-pulse">
                <span class="fa-arrow-right text-[8px] text-white fa-solid"></span>
            </a>
        @else
            <span class="place-content-center grid bg-indigo-400 rounded-full w-[20px] h-[20px] scale-[0.95]">
                <span class="fa-arrow-right text-[8px] text-white fa-solid"></span>
            </span>
        @endif
    </nav>

  {{--   <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('scroll')) {
                document.getElementById('pagination-nav').scrollIntoView({ behavior: 'smooth' });
            }
        });
    </script> --}}
@endif
