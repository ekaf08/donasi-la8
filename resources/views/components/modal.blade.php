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
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                @isset($title)
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $title }}</h4>
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
            </form>
        </div>
    </div>
</div>
