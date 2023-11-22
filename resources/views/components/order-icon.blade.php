@props(['orderBy', 'orderAsc', 'sortField'])

@if( $orderBy == $sortField)
    @if( !$orderAsc)
        <svg class="h-4 w-4 text-gray-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="18 15 12 9 6 15" /></svg>
    @endif

    @if( $orderAsc)
        <svg class="h-4 w-4 text-gray-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="6 9 12 15 18 9" /></svg>
    @endif
@endif