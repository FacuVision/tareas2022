<div class="w-full fixed">

    <nav class="bg-gray-800" x-data="{open:false}">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button x-on:click="open=true" type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu" aria-expanded="false">
                        {{-- <span class="sr-only">Open main menu</span> --}}



                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>



                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    {{-- Logotipo --}}
                    <div class="flex-shrink-0 flex items-center">
                        <img class="block lg:hidden h-8 w-auto"
                            src="{{asset('vendor/adminlte/dist/img/JoseJesusLogo.jpg')}}" alt="José Jesús">
                        <img class="hidden lg:block h-8 w-auto"
                            src="{{asset('vendor/adminlte/dist/img/JoseJesusLogo.jpg')}}"
                            alt="José Jesús">
                            <span class="text-xl pl-2 text-white">I.E.P José Jesús</span>
                    </div>
                    {{-- Logotipo --}}

                    {{-- MENU LG --}}
                    <div class="hidden sm:block sm:ml-6">
                        <div class="flex space-x-4">

                            {{-- SE VERA EN CASO ESTES LOGUEADO --}}

                            @if(Auth::user())
                                <a href="{{ route('dashboard')}}" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                    aria-current="page">Dashboard</a>
                            @else
                                <a href="{{route('login')}}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
                            @endif

                            {{-- SE VERA EN CASO ESTES LOGUEADO --}}

                            <a href="#"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Visita nuestra página web</a>
                        </div>
                    </div>
                    {{-- MENU LG --}}
                </div>

                @auth


                @else
                <div>
                    {{-- <a href="{{route('login')}}"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a> --}}
                    @endauth
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="sm:hidden" id="mobile-menu" x-show="open" x-on:click.away="open=false">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

                    @if(Auth::user())
                    <a href="{{ route('dashboard')}}" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                        aria-current="page">Dashboard</a>
                    @else
                        <a href="{{route('login')}}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
                    @endif


                    <a href="#"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Visita nuestra página web</a>

                </div>
            </div>
    </nav>

</div>
