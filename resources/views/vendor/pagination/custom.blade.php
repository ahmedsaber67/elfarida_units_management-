@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex items-center gap-2 text-sm font-medium">
        
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed">السابق</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" 
               class="px-3 py-1 rounded-lg bg-white border shadow-sm hover:bg-gray-100 transition">
                السابق
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-3 py-1 text-gray-500">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 rounded-lg bg-gradient-to-r from-[#6f4e37] to-[#a67c52] text-white shadow">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" 
                           class="px-3 py-1 rounded-lg bg-white border shadow-sm hover:bg-gray-100 transition">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" 
               class="px-3 py-1 rounded-lg bg-white border shadow-sm hover:bg-gray-100 transition">
                التالي
            </a>
        @else
            <span class="px-3 py-1 rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed">التالي</span>
        @endif
    </nav>
@endif
