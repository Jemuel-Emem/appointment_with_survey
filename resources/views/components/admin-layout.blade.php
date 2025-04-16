<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BMHC</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css"
    rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
     @wireUiScripts
    @livewireStyles
</head>

<body class="font-sans antialiased relative bg-green-800">
  <x-notifications position="top-right" />
    <x-dialog z-index="z-50" blur="md" align="center" />
    <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
        aria-controls="sidebar-multi-level-sidebar" type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="sidebar-multi-level-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen bg-green-500 transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto  ">
            <ul class="space-y-2 font-medium ">
                <a href="">
                    <div class="flex  flex-col items-center h-full px-3  overflow-y-auto  ">
                        <div class="">
                            <img src="{{ asset('images/app-removebg-preview.png') }}" alt="Violation Photo" class="w-12 h-12 ">
                        </div>
                          <div class="text-center mt-2">
                             <label for="" class="font-black text-blue-800 text-xl">BMHC</label>
                          </div>
                     </div>
                </a>
                <li>
                    <a href="{{route('Admindashboard')}}"
                        class="flex items-center p-2 text-white hover:text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="ri-dashboard-fill text-green-700"></i>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.appointments')}}"
                        class="flex items-center p-2 text-white hover:text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="ri-file-paper-fill text-green-700"></i>
                        <span class="ms-3">Appointments</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.staffs')}}"
                        class="flex items-center p-2 text-white hover:text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="ri-account-box-fill text-green-700"></i>
                        <span class="ms-3">Staffs</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.patients')}}"
                        class="flex items-center p-2 text-white hover:text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="ri-team-fill text-green-700"></i>
                        <span class="ms-3">Patients</span>
                    </a>
                </li>
      <li>
                    <a href="{{route('admin.childrec')}}"
                        class="flex items-center p-2 text-white hover:text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="ri-team-fill text-green-700"></i>
                        <span class="ms-3">Childbirth Records</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.resident')}}"
                        class="flex items-center p-2 text-white hover:text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="ri-team-fill text-green-700"></i>
                        <span class="ms-3">Residents</span>
                    </a>
                </li>








                <li>
                    <a href="{{route('admin.survey')}}"
                        class="flex items-center p-2 text-white hover:text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="ri-survey-fill text-green-700"></i>
                        <span class="ms-3">Create Survey</span>
                    </a>
                </li>


                <li>
                    <a href="{{route('admin.trashbin')}}"
                        class="flex items-center p-2 text-white hover:text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="ri-delete-bin-fill text-green-700"></i>
                        <span class="ms-3">Trash Bin</span>
                    </a>
                </li>

            </ul>


        </div>


    </aside>


    <div class="flex justify-end text-black  mr-10 mt-4">
        <div>


               <a href="{{route('logout')}}"
                    class="flex items-center p-2 text-white hover:text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="ri-logout-circle-fill text-red-500"></i>
                    <span class="ms-3">Logout</span>
                </a>


        </div>
      </div>
    <div class="p-4 sm:ml-64">
        <div class="p-4  bg-gray-200 ">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>



</body>

</html>
