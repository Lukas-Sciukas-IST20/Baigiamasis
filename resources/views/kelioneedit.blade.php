
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div>
            <form method="POST" action="{{route('keliones.update',$kelione->id)}}">
            @method('PUT')
            @csrf
            <!-- pradzia šalis -->
            <div class="mt-4">
                <x-input-label for="pradzia_salis" :value="__('Kelionės pradžios šalis')" />
                <x-text-input id="pradzia_salis" class="block mt-1 w-full" type="text" name="pradzia_salis" value="{{$kelione->pradzia_salis}}" required />
            </div>
            <!-- pradzia miestas -->
            <div class="mt-4">
                <x-input-label for="pradzia_miestas" :value="__('Kelionės pradžios miestas')" />
                <x-text-input id="pradzia_miestas" class="block mt-1 w-full" type="text" name="pradzia_miestas" value="{{$kelione->pradzia_miestas}}" required />
            </div>
            <!-- pradzia stotelė -->
            <div class="mt-4">
                <x-input-label for="stotis" :value="__('Kelionės pradžios stotelė')" />
                <x-text-input id="stotis" class="block mt-1 w-full" type="text" name="stotis" value="{{$kelione->stotis}}" required />
            </div>
            <!-- tikslo šalis -->
            <div class="mt-4">
                <x-input-label for="tikslas_salis" :value="__('Kelionės tikslo šalis')" />
                <x-text-input id="tikslas_salis" class="block mt-1 w-full" type="text" name="tikslas_salis" value="{{$kelione->tikslas_salis}}" required />
            </div>
            <!-- tikslo miestas -->
            <div class="mt-4">
                <x-input-label for="tikslas_miestas" :value="__('Kelionės tikslo miestas')" />
                <x-text-input id="tikslas_miestas" class="block mt-1 w-full" type="text" name="tikslas_miestas" value="{{$kelione->tikslas_miestas}}" required />
            </div>
            <!-- kelionės pavadinimas -->
            <div class="mt-4">
                <x-input-label for="pavadinimas" :value="__('kelionės pavadinimas')" />
                <x-text-input id="pavadinimas" class="block mt-1 w-full" type="text" size="20" name="pavadinimas" value="{{$kelione->pavadinimas}}" required />
            </div>
            <!-- kelionės aprašymas -->
            <div class="mt-4">
                <x-input-label for="aprasymas" :value="__('Aprašymas')" />
                <x-text-input id="aprasymas" class="block mt-1 w-full" type="text" size="20" name="aprasymas" value="{{$kelione->aprasymas}}" required />
            </div>
            <!-- Vairuotojai -->
            Vairuotojas
            <div class="mt-4">
                <select id="vairuotojo_id" class="block mt-1 w-full" type="text" name="vairuotojo_id" value="{{$kelione->vairuotojo_id}}" required>
                    @foreach($vairuotojai as $vairuotojas)
                        <option value='{{$vairuotojas->id}}'>{{$vairuotojas->name}} {{$vairuotojas->pavarde}} {{$vairuotojas->telefonas}}</option>
                    @endforeach
                </select>
            </div>
            <!-- Transportas -->
            Transportas
            <div class="mt-4">
                <select id="transporto_id" class="block mt-1 w-full" type="text" name="transporto_id" value="{{$kelione->transporto_id}}" required>
                    @foreach($transportas as $automobilis)
                        <option value='{{$automobilis->id}}'>vietos: {{$automobilis->vietos}} {{$automobilis->modelis}} {{$automobilis->identif}}</option>
                    @endforeach
                </select>
            </div>
            <!-- Kaina vaikams -->
            <div class="mt-4">
                Kaina vaikams
                <label for="kaina_vaikam" :value="__('Kaina vaikams')">
                <input id="kaina_vaikam" class="block mt-1 w-full" type="number" name="kaina_vaikam" value="{{$kelione->kaina_vaikam}}" required />
            </div>
            <!-- Kaina suaugusiems -->
            <div class="mt-4">
                Kaina suaugusiems
                <label for="kaina_suaug" :value="__('Kaina suaugusiems')" >
                <input id="kaina_suaug" class="block mt-1 w-full" type="number" name="kaina_suaug" value="{{$kelione->kaina_suaug}}" required />
            </div>
            <!-- išvykimas -->
            išvykimo laikas
            <div class="mt-4">
                <label for="isvykimas" :value="__('Išvykimo laikas')" >
                <input id="isvykimas" class="block mt-1 w-full" type="datetime-local" name="isvykimas" value="{{$kelione->isvykimas}}" required />
            </div>
            <!-- Parvykimo laikas -->
            Parvykimo laikas
            <div class="mt-4">
                <label for="gryzimas" :value="__('Parvykimo laikas')" >
                <input id="gryzimas" class="block mt-1 w-full" type="datetime-local" name="gryzimas" value="{{$kelione->gryzimas}}" required />
            </div>
            <!-- matomumas -->
            Matomumas
            <div class="mt-4">
                <select id="visibility" class="block mt-1 w-full" type="text" name="visibility" :value="old('visibility')" required>
                    <option value='matomas'>Viešas</option>
                    <option value='nematomas'>Nematomas</option>
                </select>
            </div>
            <div>
                <button type="submit">Išsaugoti</button>
            </div>

        </form>
    </div>
</x-app-layout>