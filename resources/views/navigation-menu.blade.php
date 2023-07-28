<nav class="bg-gray-900 bg-opacity-30" x-data="{ open:false }">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-2">
        <div class="relative flex h-16 items-center justify-between">
  
            <!-- Mobile menu button-->
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <button x-on:click="open = true" type="button" class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!--
                        Icon when menu is closed.
          
                        Menu open: "hidden", Menu closed: "block"
                    -->
                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!--
                        Icon when menu is open.
          
                        Menu open: "block", Menu closed: "hidden"
                    -->
                    <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
  
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                  <!-- logo-->
                <div class="flex flex-shrink-0 items-center">
                    <a href="/home">
                        <img class="h-12 w-auto" src="https://ronalca.com/wp-content/uploads/2019/11/Logo-UNEG.png" alt="">
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">

                        <form action="#" method="GET" class="hidden lg:block lg:pl-2">
                            <label for="topbar-search" class="sr-only">Search</label>
                            <div class="relative mt-1 lg:w-96">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input type="text" name="email" id="topbar-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search">
                            </div>
                        </form>

                        @if (auth()->check())
                            <select id="list-of-departments" class="bg-gray-500 text-white rounded-md px-10 py-2 text-sm font-medium">
                                @foreach (auth()->user()->list_of_departments as $department)
                                    <option value="{{ $department->id }}" @if($department->id==auth()->user()->selected_department_id) selected @endif>{{ $department->name }}</option>
                                @endforeach
                            </select>
                        @endif

                        @if (auth()->user()->is_admin)
                        <button class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium" onclick="openDropdown(event,'dropdown-id')">Administrador</button>
                            <div class="hidden bg-gray-900 text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1" style="min-width:12rem" id="dropdown-id">
                                <a href="{{ route('departments.index') }}" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-100 hover:bg-gray-700 hover:text-white">
                                    Departamentos
                                </a>
                                <a href='/users' class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap text-slate-100 hover:bg-gray-700 hover:text-white">
                                    Usuarios
                                </a>
                                <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
                                <a href="" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-300 hover:bg-gray-700 hover:text-white">
                                    Configuration
                                </a>
                            </div>
                        @endif 
                    </div>
                </div>
            </div>
  
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <button type="button" class="rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                    <span class="sr-only">View notifications</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                </button>
      
                <!-- Profile dropdown -->
                <div class="relative ml-3" x-data="{ open:false }">
                    <div>
                        <button x-on:click="open = true" type="button" class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->profile_photo_url }}" alt="">
                        </button>
                    </div>
          
                    <div x-show="open" x-on:click.away="open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-gray-900 py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <!-- Active: "bg-gray-100", Not Active: "" -->
                        <a href="{{ route('profile.show') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-4 py-2 text-sm font-medium" role="menuitem" tabindex="-1" id="user-menu-item-0">Tu Perfil</a>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a href="{{ route('logout') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-4 py-2 text-sm font-medium" role="menuitem" tabindex="-1" id="user-menu-item-2" @click.prevent="$root.submit();">
                                Finalizar sesión
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu" x-show="open" x-on:click.away="open = false">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="#" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Dashboard</a>
            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Team</a>
            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Projects</a>
            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Calendar</a>
        </div>
    </div>
</nav>
  
  <script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>
  <script>
      function openDropdown(event,dropdownID){
      let element = event.target;
      while(element.nodeName !== "BUTTON"){
          element = element.parentNode;
      }
      var popper = Popper.createPopper(element, document.getElementById(dropdownID), {
          placement: 'bottom-start'
      });
      document.getElementById(dropdownID).classList.toggle("hidden");
      document.getElementById(dropdownID).classList.toggle("block");
      }
  </script>








 