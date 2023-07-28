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

<!-- Task -->
<div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 ">
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 p-4 gap-4 text-black dark:text-white">
	<div class="md:col-span-2 xl:col-span-3">
	  	<h3 class="text-lg font-semibold">Solicitudes</h3>
	</div>
	@if (auth()->user()->is_clerk)
		<div class="md:col-span-2 xl:col-span-1">
			<div class="rounded bg-gray-200 dark:bg-gray-800 p-3">
				<div class="flex justify-between py-1 text-black dark:text-white">
					<h3 class="text-sm font-semibold">Solicitudes para mi</h3>
					<svg class="h-4 fill-current text-gray-600 dark:text-gray-500 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5 10a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4zm7 0a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4zm7 0a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4z" /></svg>	
				</div>

				<div class="flex max-h-[400px] w-full flex-col text-sm text-black dark:text-gray-50 mt-2 overflow-y-hidden hover:overflow-y-auto" id="journal-scroll">
					@foreach ($my_demands as $demand)
						<tr>
							<div data-demand="{{ $demand->id }}" class="bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 p-2 rounded mt-1 border-b border-gray-100 dark:border-gray-900 cursor-pointer">
								<div class="text-gray-300"><a class="text-gray-100">Titulo</a>  {{ $demand->title_short }} </div>
								<div class="text-gray-300"><a class="text-gray-100">Categoria</a>  {{ $demand->category->name }} </div>
								<div class="text-gray-300"><a class="text-gray-100">Severidad</a>  {{ $demand->severity_full }} </div>
							</div>
						</tr>	
					@endforeach
				</div>
			</div>
		</div>
		<div>
			<div class="rounded bg-gray-200 dark:bg-gray-800 p-3">
				<div class="flex justify-between py-1 text-black dark:text-white">
					<h3 class="text-sm font-semibold">Solicitudes sin Asignar</h3>
					<svg class="h-4 fill-current text-gray-600 dark:text-gray-500 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5 10a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4zm7 0a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4zm7 0a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4z" /></svg>
				</div>

				<div class="flex max-h-[400px] w-full flex-col text-sm text-black dark:text-gray-50 mt-2 overflow-y-hidden hover:overflow-y-auto" id="journal-scroll">
					@foreach ($pending_demands as $demand)
						<tr>
							<div data-demand="{{ $demand->id }}" class="bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 p-2 rounded mt-1 border-b border-gray-100 dark:border-gray-900 cursor-pointer">
								<div class="text-gray-300"><a class="text-gray-100">Titulo</a>  {{ $demand->title_short }} </div>
								<div class="text-gray-300"><a class="text-gray-100">Categoria</a>  {{ $demand->category->name }} </div>
								<div class="text-gray-300"><a class="text-gray-100">Severidad</a>  {{ $demand->severity_full }} </div>
							</div>
						</tr>	
					@endforeach
				</div>
			</div>
		</div>
	@endif
	<div>
		<div class="rounded bg-gray-200 dark:bg-gray-800 p-3">
			<div class="flex justify-between py-1 text-black dark:text-white">
				<h3 class="text-sm font-semibold">Solicitudes reportadas por mi</h3>
				<button onclick="toggleModal('modal-id')" type="button" class="">
					<svg class="h-5 w-5 text-gray-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="12" y1="5" x2="12" y2="19" />  <line x1="5" y1="12" x2="19" y2="12" /></svg>
				</button>
			</div>

			<div class="flex max-h-[400px] w-full flex-col text-sm text-black dark:text-gray-50 mt-2 overflow-y-hidden hover:overflow-y-auto" id="journal-scroll">
				@foreach ($demands_by_me as $demand)
					<tr>
						<div data-demand="{{ $demand->id }}" class="bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 p-2 rounded mt-1 border-b border-gray-100 dark:border-gray-900 cursor-pointer">
							<div class="text-gray-300"><a class="text-gray-100">Titulo</a>  {{ $demand->title_short }} </div>
							<div class="text-gray-300"><a class="text-gray-100">Categoria</a>  {{ $demand->category->name }} </div>
							<div class="text-gray-300"><a class="text-gray-100">Severidad</a>  {{ $demand->severity_full }} </div>
						</div>
					</tr>	
				@endforeach
			</div>
		</div>
	</div>
</div>
</div>
<!-- ./Task -->

<!-- Main Chart -->
<div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 ">
	@if (auth()->user()->is_admin)
		<div class="bg-gray-900 bg-opacity-50 rounded-2xl p-5 grid grid-cols-2 lg:grid-cols-4">
			<canvas id="main-chart"></canvas>
		</div>
	@endif
</div>
<!-- END Main Chart -->

{{-- Modal Solicitud --}}
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
                <form method="post" action="{{ route('demands.store') }}" id="registerForm" class="space-y-6">
					@csrf
						<div>
							<label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoria</label>
							<select name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
								<option value="">Seleccione Categoria</option>
								@foreach($categories as $category)
									<option value="{{ $category->id }}">{{ $category->name }}</option>
								@endforeach
							</select>
						</div>
						<div>
							<label for="severity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Severidad</label>
							<select name="severity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
								<option value="">Seleccione Severidad</option>
								<option value="M">Menor</option>
								<option value="N">Normal</option>
								<option value="A">Alta</option>
							</select>
						</div>   
					
						<div>
							<label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
							<input type="text" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
							required minlength="10" maxlength="30"/>
						</div>
						<div>
							<label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
							<textarea name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
							required minlength="10" maxlength="250"></textarea>
						</div>
					
						<button  class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
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

<!-- Set up example charts -->
<script>
	function loadMainChart() {
	  // Set Global Chart.js configuration
	  Chart.defaults.global.defaultFontColor              = 'rgb(209,213,219)';
	  Chart.defaults.scale.gridLines.color                = "transparent";
	  Chart.defaults.scale.gridLines.zeroLineColor        = "transparent";
	  Chart.defaults.scale.ticks.beginAtZero              = true;
	  Chart.defaults.global.elements.line.borderWidth     = 2;
	  Chart.defaults.global.elements.point.radius         = 5;
	  Chart.defaults.global.elements.point.hoverRadius    = 7;
	  Chart.defaults.global.tooltips.cornerRadius         = 3;
	  Chart.defaults.global.legend.labels.boxWidth        = 12;
	  
	  // Init Chart
	  var ctx = document.getElementById('main-chart').getContext('2d');
	  var chart = new Chart(ctx, {
		type: 'bar',
		data: {
		  labels: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'],
		  datasets: [
			{
			  label: 'Unique Visits',
			  fill: true,
			  backgroundColor: 'rgba(6, 101, 208, .75)',
			  borderColor: 'rgba(6, 101, 208, 1)',
			  pointBackgroundColor: 'rgba(6, 101, 208, 1)',
			  pointBorderColor: '#fff',
			  pointHoverBackgroundColor: '#fff',
			  pointHoverBorderColor: 'rgba(6, 101, 208, 1)',
			  data: [3400, 4200, 6200, 7800, 8300, 5700, 6800]
			},
			{
			  label: 'Pageviews',
			  fill: true,
			  backgroundColor: 'rgba(108, 117, 125, .25)',
			  borderColor: 'rgba(108, 117, 125, .75)',
			  pointBackgroundColor: 'rgba(108, 117, 125, 1)',
			  pointBorderColor: '#fff',
			  pointHoverBackgroundColor: '#fff',
			  pointHoverBorderColor: 'rgba(108, 117, 125, 1)',
			  data: [13000, 16000, 12500, 16000, 18700, 11000, 14300]
			}
		]
		}
	  });
	}

	loadMainChart();
</script>
</x-app-layout>