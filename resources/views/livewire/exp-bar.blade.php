<div wire:poll>
    <div
        class="mt-8 p-6 max-w-full bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">

        <div class="inline-flex">
            <div class="p-4">
                {{ __('Nivel Actual: ') }}
            </div>
            <div class="inline-flex p-4 text-2xl text-center font-bold bg-blue-300 rounded-full text-white">
                Lv. {{ $level->level}}
            </div>
        </div>

        <div class="inline-flex p-4">
            <div class="mr-2">
                {{ __('Puntos en Total:') }}
            </div>
            <span
                class="inline-flex items-center p-2 mr-2 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full dark:bg-blue-200 dark:text-blue-800">
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
    </div>
</div>
