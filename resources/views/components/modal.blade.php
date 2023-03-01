<!-- Modal -->
<div
    {{ $attributes->merge([
        'class' => 'modal fade',
        'id' => 'modal-form',
        'data-backdrop' => 'static',
        'data-keyboard' => 'false',
        // 'tabindex' => '1',
        'aria-labelledby' => 'staticBackdropLabel',
        'aria-hidden' => 'true',
    ]) }}>
    <div class="modal-dialog {{ isset($size) ? $size : 'modal-lg' }}">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                @isset($title)
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $title }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endisset
                <div class="modal-body">
                    {{ $slot }}
                </div>
                @isset($footer)
                    <div class="modal-footer">
                        {{ $footer }}
                    </div>
                @endisset
            </div>
        </form>
    </div>
</div>
