<x-app-layout>
<style>
	#journal-scroll::-webkit-scrollbar {
		width: 4px;
		cursor: pointer;
		/*background-color: rgba(229, 231, 235, var(--bg-opacity));*/
	}
	#journal-scroll::-webkit-scrollbar-track {
		background-color: rgba(229, 231, 235, var(--bg-opacity));
		cursor: pointer;
		/*background: red;*/
	}
	#journal-scroll::-webkit-scrollbar-thumb {
		cursor: pointer;
		background-color: #a0aec0;
		/*outline: 1px solid slategrey;*/
	}
</style>
<div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
	<!-- Grafica -->
	@if (auth()->user()->is_admin)
		<div class="grid grid-cols-1 md:grid-cols-2 p-4 gap-4">
			<!-- Sección 1 - Gráfica de Usuarios -->
			<div class="bg-gray-900 bg-opacity-90 p-2 rounded-md">
				<div class="sm:flex sm:items-center sm:justify-between">
					<div class="flex items-center gap-x-3">
						<h2 class="text-lg font-medium text-gray-800 dark:text-gray-400">Tareas Por Departamento</h2>
					</div>   
					<div class="flex items-center mt-4 gap-x-3">
						<a href="/graph" class="w-4 mr-2 transform hover:scale-110" title="Ver mas">
							<svg class="h-5 w-5 text-gray-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />  <circle cx="12" cy="12" r="3" /></svg>
						</a>
					</div>
				</div>
				<div class="mx-auto w-3/5 overflow-hidden">
					<!-- El canvas para la gráfica -->
					<canvas id="demandsChart"></canvas>
				</div>
			</div>

			<!-- Sección 2 - Gráfica de Comercios -->
			<div class="bg-gray-900 bg-opacity-90 p-2 rounded-md">
				<div class="sm:flex sm:items-center sm:justify-between">
					<div class="flex items-center gap-x-3">
						<h2 class="text-lg font-medium text-gray-800 dark:text-gray-400">Usuarios</h2>
					</div>   
					<div class="flex items-center mt-4 gap-x-3">
						<a href="/graphusers" class="w-4 mr-2 transform hover:scale-110" title="Ver mas">
							<svg class="h-5 w-5 text-gray-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />  <circle cx="12" cy="12" r="3" /></svg>
						</a>
					</div>
				</div>
				<div class="mx-auto w-3/5 overflow-hidden">
					<!-- El canvas para la gráfica -->
					<canvas id="usersChart"></canvas>
				</div>
			</div>
		</div>
	@push('js')
		<script src="/js/graph.js"></script>
		<script src="/js/graphusers.js"></script>
	@endpush
	@endif
	<!-- /Grafica -->
	
	<!-- Task -->
	<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 p-4 gap-4 text-black dark:text-gray-400" id="shared">
			<div class="md:col-span-2 xl:col-span-1">
				<div class="rounded bg-gray-900 bg-opacity-90 p-3">
					<div class="flex justify-between py-1 text-gray-400">
						<h3 class="text-sm font-semibold">Tareas</h3>
						<a href="{{route('demands.create')}}" class="w-4 mr-2 transform hover:scale-110" title="Agregar Tarea">
							<svg class="h-4 w-4 text-white"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="12" y1="5" x2="12" y2="19" />  <line x1="5" y1="12" x2="19" y2="12" /></svg>
						</a>
					</div>
		
					<div class="flex max-h-[400px] w-full flex-col text-sm text-black dark:text-gray-50 mt-2 overflow-y-hidden hover:overflow-y-auto" id="journal-scroll">
						<ul class="" >
							@foreach ($demands_by_me as $demand)
								<li data-demand="{{ $demand->id }}" class="bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 p-2 rounded mt-1 border-b border-gray-100 dark:border-gray-600 cursor-pointer" title="Ver detalles">
									<div item-id="{{ $demand->id }}" class="list-group-item"><a class="text-gray-100">Titulo</a>  {{ $demand->title_short }} </div>
									<div class="text-gray-300"><a class="text-gray-100">Categoria</a>  
										@if (isset($demand->category->name))
											{{ $demand->category->name }}
										@else
											No Disponible
										@endif
									</div>
									<div class="text-gray-300"><a class="text-gray-100">Severidad</a>  {{ $demand->severity_full }}</div>
									<div class="text-right text-xs text-white leading-none">{{ $demand->created_at->diffForHumans(null, false, false) }}</div>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>

		@if (auth()->user()->is_clerk || auth()->user()->is_admin)
			<div>
				<div class="rounded bg-gray-900 bg-opacity-90 p-3">
					<div class="flex justify-between py-1 text-gray-400">
						<h3 class="text-sm font-semibold">Pendientes</h3>
					</div>
	
					<div class="flex max-h-[400px] w-full flex-col text-sm text-black dark:text-gray-50 mt-2 overflow-y-hidden hover:overflow-y-auto" id="journal-scroll">
						<ul id="pendingLeft" class="list-group connectedSortable" >
							@foreach ($pending_demands as $demand)
							@if ($demand->active)
								<li data-demand="{{ $demand->id }}" class="bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 p-2 rounded mt-1 border-b border-gray-100 dark:border-gray-600 cursor-pointer" title="Ver detalles">
									<div item-id="{{ $demand->id }}" class="list-group-item"><a class="text-gray-100">Titulo</a>  {{ $demand->title_short }} </div>
									<div class="text-gray-300"><a class="text-gray-100">Categoria</a>  
										@if (isset($demand->category->name))
											{{ $demand->category->name }}
										@else
											No Disponible
										@endif
									</div>
									<div class="text-gray-300"><a class="text-gray-100">Severidad</a>  {{ $demand->severity_full }} </div>
									<div class="text-right text-xs text-white leading-none">{{ $demand->created_at->diffForHumans(null, false, false) }}</div>
								</li>
							@endif
							@endforeach 
						</ul>
					</div>
				</div>
			</div>
				
			<div>
				<div class="rounded bg-gray-900 bg-opacity-90 p-3">
					<div class="flex justify-between py-1 text-gray-400">
						<h3 class="text-sm font-semibold">En Progreso</h3>
					</div>
		
					<div class="flex max-h-[400px] w-full flex-col text-sm text-black dark:text-gray-50 mt-2 overflow-y-hidden hover:overflow-y-auto" id="journal-scroll">
						<ul id="inProgressCenter" class="" >
							@foreach ($my_demands as $demand)
								@if (auth()->user()->id == $demand->clerk_id && $demand->active)
									<li data-demand="{{ $demand->id }}" class="bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 p-2 rounded mt-1 border-b border-gray-100 dark:border-gray-600 cursor-pointer" title="Ver detalles">
										<div item-id="{{ $demand->id }}" class="list-group-item"><a class="text-gray-100">Titulo</a>  {{ $demand->title_short }} </div>
										<div class="text-gray-300"><a class="text-gray-100">Categoria</a>  
											@if (isset($demand->category->name))
												{{ $demand->category->name }}
											@else
												No Disponible
											@endif
										</div>
										<div class="text-gray-300"><a class="text-gray-100">Severidad</a>  {{ $demand->severity_full }} </div>
										<div class="text-right text-xs text-white leading-none">{{ $demand->created_at->diffForHumans(null, false, false) }}</div>
									</li>
								@endif
							@endforeach 
						</ul>
					</div>
					
				</div>
			</div>
			<div>
				<div class="rounded bg-gray-900 bg-opacity-90 p-3">
					<div class="flex justify-between py-1 text-gray-400">
						<h3 class="text-sm font-semibold">Hecho</h3>
					</div>
		
					<div class="flex max-h-[400px] w-full flex-col text-sm text-black dark:text-gray-50 mt-2 overflow-y-hidden hover:overflow-y-auto" id="journal-scroll">
						<ul id="doneRight" class="" >
							@foreach ($my_demands as $demand)
								@if (auth()->user()->id == $demand->clerk_id && !$demand->active)
									<li data-demand="{{ $demand->id }}" class="bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 p-2 rounded mt-1 border-b border-gray-100 dark:border-gray-600 cursor-pointer" title="Ver detalles">
										<div item-id="{{ $demand->id }}" class="list-group-item"><a class="text-gray-100">Titulo</a>  {{ $demand->title_short }} </div>
										<div class="text-gray-300"><a class="text-gray-100">Categoria</a>  
											@if (isset($demand->category->name))
												{{ $demand->category->name }}
											@else
												No Disponible
											@endif
										</div>
										<div class="text-gray-300"><a class="text-gray-100">Severidad</a>  {{ $demand->severity_full }} </div>
										<div class="text-right text-xs text-white leading-none">{{ $demand->created_at->diffForHumans(null, false, false) }}</div>
									</li>
								@endif
							@endforeach 
						</ul>
					</div>
				</div>
			</div>
			@push('js')
				<script src="/js/Sortable.min.js"></script>
				<script src="/js/jquery-3.6.0.min.js"></script>
				<script>
					let inProgressCenter = Sortable.create(document.getElementById('inProgressCenter'), {
						group: 'shared',
						animation: 150
					});

					let pendingLeft = Sortable.create(document.getElementById('pendingLeft'), {
						group: 'shared',
						animation: 150
					});

					let doneRight = Sortable.create(document.getElementById('doneRight'), {
						group: 'shared',
						animation: 150
					});

					inProgressCenter.option('onSort', function() {
						let inProgress = $('#inProgressCenter .list-group-item').map(function() {
							return $(this).attr('item-id');
						}).get();

						let pending = $('#pendingLeft .list-group-item').map(function() {
							return $(this).attr('item-id');
						}).get();

						let done = $('#doneRight .list-group-item').map(function() {
							return $(this).attr('item-id');
						}).get();
						
						$.ajax({
							url: "{{ route('update.demands') }}",
							method: 'POST',
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							data: {inProgress:inProgress,pending:pending,done:done},
							success: function(data) {
							console.log('success');
							}
						});
					});

					pendingLeft.option('onSort', function() {
						let inProgress = $('#inProgressCenter .list-group-item').map(function() {
							return $(this).attr('item-id');
						}).get();

						let pending = $('#pendingLeft .list-group-item').map(function() {
							return $(this).attr('item-id');
						}).get();

						let done = $('#doneRight .list-group-item').map(function() {
							return $(this).attr('item-id');
						}).get();
						
						$.ajax({
							url: "{{ route('update.demands') }}",
							method: 'POST',
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							data: {inProgress:inProgress,pending:pending,pending,done:done},
							success: function(data) {
							console.log('success');
							}
						});
					});

					doneRight.option('onSort', function() {
						let inProgress = $('#inProgressCenter .list-group-item').map(function() {
							return $(this).attr('item-id');
						}).get();

						let pending = $('#pendingLeft .list-group-item').map(function() {
							return $(this).attr('item-id');
						}).get();

						let done = $('#doneRight .list-group-item').map(function() {
							return $(this).attr('item-id');
						}).get();
						
						$.ajax({
							url: "{{ route('update.demands') }}",
							method: 'POST',
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							data: {inProgress:inProgress,pending:pending,pending,done:done},
							success: function(data) {
							console.log('success');
							}
						});
					});
				</script>
			@endpush
		@endif
	</div>
	<!-- ./Task --> 
</div>
</x-app-layout>