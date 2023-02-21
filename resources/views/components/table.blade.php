<table id="data-table" {{ $attributes->merge(['class' => 'table table-striped']) }}>
    @isset($thead)
        <thead class="bg-gradient-indigo text-center">
            {{ $thead }}
        </thead>
    @endisset
    <tbody>
        {{ $slot }}
    </tbody>
    @isset($tfoot)
        {{ $tfoot }}
    @endisset
</table>
