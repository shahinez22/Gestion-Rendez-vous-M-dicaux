<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Calendrier des Rendez-vous') }}</h2>
            <a href="{{ route('rendez-vous.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Liste
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @php
                        $now = now();
                        $currentMonth = $now->month;
                        $currentYear = $now->year;
                        $firstDay = $now->startOfMonth()->dayOfWeek;
                        $daysInMonth = $now->daysInMonth;
                    @endphp

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">
                            {{ $now->locale('fr')->translatedFormat('F Y') }}
                        </h3>
                    </div>

                    <div class="grid grid-cols-7 gap-px bg-gray-200 rounded-lg overflow-hidden">
                        @foreach(['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $day)
                            <div class="bg-gray-100 p-3 text-center text-sm font-semibold text-gray-600">
                                {{ $day }}
                            </div>
                        @endforeach

                        @for($i = 0; $i < $firstDay - 1; $i++)
                            <div class="bg-white p-3 min-h-[100px]"></div>
                        @endfor

                        @for($day = 1; $day <= $daysInMonth; $day++)
                            @php
                                $dateStr = sprintf('%s-%02s-%02s', $currentYear, $currentMonth, $day);
                                $dayRdv = $rendezVous->get($dateStr, collect());
                                $isToday = ($dateStr === now()->format('Y-m-d'));
                            @endphp
                            <div class="bg-white p-2 min-h-[100px] {{ $isToday ? 'bg-blue-50' : '' }}">
                                <div class="font-semibold text-sm mb-1 {{ $isToday ? 'text-blue-600' : 'text-gray-700' }}">
                                    {{ $day }}
                                </div>
                                @foreach($dayRdv as $rdv)
                                    <div class="text-xs bg-purple-100 text-purple-800 rounded px-1 py-0.5 mb-0.5 truncate" title="{{ $rdv->medecin->nom }} - {{ $rdv->patient->nom }}">
                                        {{ $rdv->medecin->nom }} - {{ $rdv->patient->nom }}
                                    </div>
                                @endforeach
                            </div>
                        @endfor
                    </div>

                    @if($rendezVous->isEmpty())
                        <p class="text-center text-gray-500 mt-6">Aucun rendez-vous pour ce mois.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
