<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>jQuery UI Draggable - Default functionality-rathorji.in</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-5">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="shared">
        <div class="bg-gray-700 p-3 rounded shadow-lg">
            <ul class="list-group connectedSortable" id="example2Left">
                {{-- @if(!empty($panddingItem) && $panddingItem->count())
                    @foreach($panddingItem as $key=>$value)
                        <li class="list-group-item bg-gray-200 p-2 rounded shadow-md" item-id="{{ $value->id }}">{{ $value->title }}</li>
                    @endforeach
                @endif --}}
                    @foreach($panddingItem as $value)
                        <li class="list-group-item bg-gray-200 p-2 rounded shadow-md" item-id="{{ $value->id }}">{{ $value->title }}</li>
                    @endforeach
            </ul>
        </div>
        <div class="bg-gray-700 p-3 rounded shadow-lg">
            <ul class="list-group connectedSortable" id="example2Right">
                {{-- @if(!empty($completeItem) && $completeItem->count())
                    @foreach($completeItem as $key=>$value)
                        <li class="list-group-item bg-gray-200 p-2 rounded shadow-md" item-id="{{ $value->id }}">{{ $value->title }}</li>
                    @endforeach
                @endif --}}
                    @foreach($completeItem as $value)
                        <li class="list-group-item bg-gray-200 p-2 rounded shadow-md" item-id="{{ $value->id }}">{{ $value->title }}</li>
                    @endforeach
            </ul>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>
    let example2Left = Sortable.create(document.getElementById('example2Left'), {
        group: 'shared',
        animation: 150
    });

    let example2Right = Sortable.create(document.getElementById('example2Right'), {
        group: 'shared',
        animation: 150
    });

    example2Left.option('onSort', function() {
        let pending = $('#example2Left .list-group-item').map(function() {
            return $(this).attr('item-id');
        }).get();

        let accept = $('#example2Right .list-group-item').map(function() {
            return $(this).attr('item-id');
        }).get();
        
        $.ajax({
            url: "{{ route('update.items') }}",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {pending:pending,accept:accept},
            success: function(data) {
            console.log('success');
            }
        });
    });

    example2Right.option('onSort', function() {
        let pending = $('#example2Left .list-group-item').map(function() {
            return $(this).attr('item-id');
        }).get();

        let accept = $('#example2Right .list-group-item').map(function() {
            return $(this).attr('item-id');
        }).get();
        
        $.ajax({
            url: "{{ route('update.items') }}",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {pending:pending,accept:accept},
            success: function(data) {
            console.log('success');
            }
        });
    });
</script>
</body>
</html>