<div wire:poll>
    <div class="w-full grid grid-cols-3 gap-2">

        <div class="text-center border rounded border-blue-300 p-2">
            <div class="pr-4 pb-2">
                {{ __('Nivel Actual: ') }}
            </div>
            <div class="inline-flex text-center">
                <div
                    class="w-12 h-12 pt-2 text-xl  font-bold bg-blue-300 border border-s border-blue-500 rounded-full text-white">
                    {{$level->level}}
                </div>
            </div>
        </div>
        <div class="text-center border rounded border-blue-300 p-2">
            <div class="pb-2">
                {{ __('Total puntos:') }}
            </div>
            <span
                class="inline-flex items-center p-2 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full dark:bg-blue-200 dark:text-blue-800">
                {{ $level->exp_ac }} Pts.
            </span>
        </div>
        <div class="text-center border rounded border-blue-300 p-2">
            <div class="pb-2">
                {{ __('Progreso:') }}
            </div>

            <div class="w-full mt-2 bg-gray-300 rounded-full dark:bg-gray-700">
                <div class="bg-blue-300 text-m font-medium text-white text-center p-0.5 leading-none rounded-full"
                    style="width: {{ $avg }}%">{{ $level->exp }}/{{ $limite }}</div>
            </div>
        </div>

        </div>
        {{-- <div
        class="mt-4 p-6 max-w-full bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">

        <div class="inline-flex mt-4">
            <div class="p-4">
                {{ __('Nivel Actual: ') }}
            </div>
            <div class="pb-8 pt-4 h-16 w-16  text-xl text-center font-bold bg-blue-300 border border-s border-blue-500 rounded-full text-white">
                {{$level->level}}
            </div>
        </div>

        <div class="inline-flex mt-4">
            <div class="p-4">
                {{ __('Puntos en Total:') }}
            </div>
            <span
                class="inline-flex items-center p-2 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full dark:bg-blue-200 dark:text-blue-800">
                {{$level->exp_ac}} Pts.
            </span>
        </div>
        <div class="mt-4">
            {{ __('Progreso del Nivel') }}
            <div class="w-full mt-2 bg-gray-300 rounded-full dark:bg-gray-700">
                <div class="bg-blue-300 text-m font-medium text-white text-center p-0.5 leading-none rounded-full"
                    style="width: {{ $avg }}%">{{ $level->exp }}/{{ $limite }}</div>
            </div>
        </div>
    </div> --}}
    </div>
