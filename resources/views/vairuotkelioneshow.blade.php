<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div>
        <a class="btn-secondary p-0.5" href="{{url()->previous()}}">Atgal</a>
        <form method="GET" action="{{route('PDF.index')}}"> 
            @csrf
            <input type="hidden" name="keliones_id" value="{{$kelione->id}}">
            <input class="btn btn-success" type="submit" value="PDF">

        </form>
        <div class="overflow-hidden m-5 bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-base font-semibold leading-6 text-gray-900">{{$kelione->pradzia_miestas}} - {{$kelione->tikslas_miestas}}</h3>
                <br>
            </div>
            <div class="border-t border-gray-200">

                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-900">Išvyksta: {{$kelione->isvykimas}}</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">Grįžta: {{$kelione->gryzimas}}</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-900">Išvykti iš </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$kelione->pradzia_miestas}}, {{$kelione->stotis}}</dd>
                </div>
                </dl>
            </div>
        </div>
    </div>
    <table class='table'>
        <tr>
        <th>Vardas</th>  <th>Pavrdė</th> <th>Umzokeščio tipas</th> <th>kaina</th><th> Mokantysis asmuo</th>
        </tr>
    @foreach($keleiviai as $keleivis)
        <tr>
        <td>{{$keleivis->vardas}}</td>  <td>{{$keleivis->pavarde}}</td> <td>{{$keleivis->uzmokest_tipas}}</td> <td>{{$keleivis->kaina}}</td>
        @if($keleivis->vardas." ".$keleivis->pavarde != $keleivis->mokantysis)
            <td> {{$keleivis->mokantysis}}</td>
            @else
            <td></td>
        @endif
        </tr>
    @endforeach
</x-app-layout>