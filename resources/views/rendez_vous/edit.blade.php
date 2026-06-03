<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Modifier un Rendez-vous') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('rendez-vous.update', $rendezVou) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="date_rdv" class="block text-sm font-medium text-gray-700">Date du rendez-vous</label>
                            <input type="date" name="date_rdv" id="date_rdv" value="{{ old('date_rdv', $rendezVou->date_rdv->format('Y-m-d')) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('date_rdv') border-red-500 @enderror">
                            @error('date_rdv')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="medecin_id" class="block text-sm font-medium text-gray-700">Médecin</label>
                            <select name="medecin_id" id="medecin_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('medecin_id') border-red-500 @enderror">
                                @foreach($medecins as $medecin)
                                    <option value="{{ $medecin->id }}" {{ old('medecin_id', $rendezVou->medecin_id) == $medecin->id ? 'selected' : '' }}>
                                        {{ $medecin->nom }} - {{ $medecin->specialite }}
                                    </option>
                                @endforeach
                            </select>
                            @error('medecin_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="patient_id" class="block text-sm font-medium text-gray-700">Patient</label>
                            <select name="patient_id" id="patient_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('patient_id') border-red-500 @enderror">
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ old('patient_id', $rendezVou->patient_id) == $patient->id ? 'selected' : '' }}>
                                        {{ $patient->nom }} - {{ $patient->telephone }}
                                    </option>
                                @endforeach
                            </select>
                            @error('patient_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Mettre à jour
                            </button>
                            <a href="{{ route('rendez-vous.index') }}" class="text-gray-600 hover:text-gray-900">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
