<x-app-layout>
<!-- Tabla Usuario -->
<section class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
    @livewire('users-table')
</section>

@push('js')
    <script type="text/javascript" src="js/position-absolute.com_creation_print_jquery.printPage.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.btnprn').printPage();
        });
    </script>
@endpush
</x-app-layout>