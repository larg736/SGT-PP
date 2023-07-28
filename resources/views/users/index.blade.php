<x-app-layout>

{{-- Table users --}}
<div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
    {{-- Button New Users --}}
    <div class="max-w-6xl mx-auto py-3 sm:px-6 lg:px-8">  
        <button class="px-6 py-2 text-sm transition-colors duration-300 rounded rounded-full shadow-xl text-violet-100 bg-violet-500 hover:bg-violet-600 shadow-violet-400/30" type="button" onclick="toggleModal('modal-id')">
            <svg class="h-5 w-5 text-white"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>              
        </button>
    </div>
    <div class="bg-gray-400 rounded shadow-lg p-4 px-4 md:p-8 mb-6">
        <table class="stripe hover" id="users" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Email Verified At</th>
                    <th>Roles</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="bg-gray-400">
                            {{ $user->id }}
                        </td>
                        <td scope="row" class="bg-gray-400 text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->name }}
                        </td>
                        <td class="bg-gray-400">
                            {{ $user->email }}
                        </td>
                        <td class="bg-gray-400">
                            {{ $user->email_verified_at }}
                        </td>
                        <td class="bg-gray-400">
                            @foreach ($user->roles as $role)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-500 text-gray-50">
                                    {{ $role->title }}
                                </span>
                            @endforeach
                        </td>
                        <td class="bg-gray-400">
                            <a href="{{ route('users.show', $user->id) }}" class="text-blue-300 hover:text-blue-900 mb-2 mr-2">Ver</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="text-purple-600 hover:text-purple-900 mb-2 mr-2">Editar</a>
                            <form class="inline-block formulario-eliminar" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="text-blue-600 hover:text-blue-900 mb-2 mr-2" value="Borrar">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Users --}}
<div id="modal-id" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center">
    <div class="relative w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="toggleModal('modal-id')">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Nuevo Usuario</h3>
                <form method="post" action="{{ route('users.store') }}"  id="registerForm" class="space-y-6">
                @csrf
                    <div>
                        <label for="nameInput" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                        <input type="text" name="name" id="nameInput" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        value="{{ old('name', '') }}" required minlength="3" maxlength="45"/> 
                    </div>
                    <div>
                        <label for="emailInput" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="emailInput" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        value="{{ old('email', '') }}" required/>
                    </div>
                    <div>
                        <label for="roles" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rol</label>
                        <select name="roles[]" id="roles" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            <option value="">Seleccione rol</option>
                            @foreach($roles as $id => $role)
                                <option value="{{ $id }}"{{ in_array($id, old('roles', [])) ? ' selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="passwordInput" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                        <input type="password" name="password" id="passwordInput" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        value="{{ old('password', '') }}" required/>
                    </div>
                    <button type="submit" id="boton" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>
<script type="text/javascript">
    function toggleModal(modalID){
    document.getElementById(modalID).classList.toggle("hidden");
    document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
    document.getElementById(modalID).classList.toggle("flex");
    document.getElementById(modalID + "-backdrop").classList.toggle("flex");
    }
</script>

@push('script')
<script>
        $('#registerForm').submit(function (e) {
            e.preventDefault();
            let formData = $(this).serializeArray();
            $(".invalid-feedback").children("strong").text("");
            $("#registerForm input").removeClass("is-invalid");
            $.ajax({
                method: "POST",
                url: "{{ route('users.store') }}",
                data: formData,
                success: function (data){
                    Swal.fire({
                        title: '¡Usuario Registrado con Exito!',
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.assign("{{ route('users.index') }}");
                        }
                    });
                },
                error: function (response) {
                    if(response.status === 422) {
                        let errors = response.responseJSON.errors;
                        Object.keys(errors).forEach(function (key) {
                            $("#" + key + "Input").addClass("is-invalid");
                            $("#" + key + "Error").children("strong").text(errors[key][0]);
                        });
                    } else {
                        window.location.assign("{{ route('users.index') }}");
                    }
                }
            });
        });
</script>
@endpush

<script>
    $(document).ready(function() {
        var table = $('#users').DataTable({
                responsive: true,
                dom:'B<lf<t>ip>',
                buttons: [
                    {
                    extend:    'print',
                    text:      '<svg class="h-5 w-5 text-white"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z" />  <polyline points="13 2 13 9 20 9" /></svg>',
                    title:'Usuarios',
                    titleAttr: 'Imprimir',
                    className: 'p-2 rounded-lg bg-red-400 hover:bg-red-500 font-bold text-white',
                    exportOptions: {
                        columns: [ 0, 1, 4]
                    }
                }
                ]
			})
			.columns.adjust()
			.responsive.recalc();
		});
</script>

</x-app-layout>



  
  