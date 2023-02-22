<x-layouts.panel>
    <div class="row">
        <h2>INICIO - Bienvenido</h2>
        <hr>
    </div>
    <strong>Usuario:</strong> {{ strToUpper(Auth::user()->name) }}
</x-layouts.panel>
