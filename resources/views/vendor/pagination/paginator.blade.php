@if ($paginator->hasPages())
    <div class="absolute flex justify-between w-full">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <span class="mdi-arrow-left-drop-circle-outline text-[40px] text-gray-500 cursor-default mdi" aria-disabled="true"></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="mdi-arrow-left-drop-circle-outline text-[40px] hover:text-indigo-800 hover:scale-[1.1] cursor-pointer mdi" aria-label="{{ __('pagination.previous') }}"></a>
        @endif

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="mdi-arrow-right-drop-circle-outline text-[40px] hover:text-indigo-800 hover:scale-[1.1] cursor-pointer mdi" aria-label="{{ __('pagination.next') }}"></a>
        @else
            <span class="mdi-arrow-right-drop-circle-outline text-[40px] text-gray-500 cursor-default mdi" aria-disabled="true"></span>
        @endif
    </div>

    {{-- <div class="hidden sm:flex justify-between">
        <div>
            <p class="text-gray-700 dark:text-gray-400 text-sm leading-5">
                {!! __('Showing') !!}
                @if ($paginator->firstItem())
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                {!! __('of') !!}
                <span class="font-medium">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>
        </div>
    </div> --}}
@endif
