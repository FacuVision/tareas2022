<x-app-layout>
    <x-slot name="header">
        <div class="pt-16" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bienvenido: {{Auth::user()->name}}
        </h2>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-12 bg-white">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                      <div class="lg:text-left">
                        <h2 class="text-base text-indigo-600 font-bold tracking-wide uppercase">Mensaje del dia</h2>
                            <x-mensaje-component/>
                      </div>

                      <div class="mt-10 pt-10">
                        <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">

                          <div class="relative">
                            <dt>
                              <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/globe-alt -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                              </div>
                              <p class="ml-16 text-lg leading-6 font-bold text-gray-900">Disponible desde cualquier dispositivo</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                              Puedes acceder a la plataforma virtual desde cualquier navegador web con acceso a internet.
                            </dd>
                          </div>

                          <div class="relative">
                            <dt>
                              <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/scale -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                </svg>
                              </div>
                              <p class="ml-16 text-lg leading-6 font-bold text-gray-900">Adquiere nuevos logros cumpliendo con tus tareas</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                Cumple con todas tus tareas dejadas por el profesor y adquiere logros que demuestran tu esfuerzo dentro de tu asignatura.
                            </dd>
                          </div>

                          <div class="relative">
                            <dt>
                              <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/lightning-bolt -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                              </div>
                              <p class="ml-16 text-lg leading-6 font-bold text-gray-900">Elabora tus tareas con rapidez</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                              Podras elaborar tus tareas de manera online y enviarselas al docente en tiempo real.
                            </dd>
                          </div>

                          <div class="relative">
                            <dt>
                              <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/annotation -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                              </div>
                              <p class="ml-16 text-lg leading-6 font-bold text-gray-900">Mantente al dia en tus tareas gaaaaaaaaa</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                              Podras visualizar todas tus tareas pendientes, hechas y por hacer dentro de la plataforma.
                            </dd>
                          </div>
                        </dl>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</x-app-layout>
