<table {{ $attributes->merge(['class' => 'table table-striped table-hover mt-3']) }}
    {{ $attributes->merge(['id' => '']) }}>
    @isset($thead)
        <thead class="bg-navy text-center">
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
