<div class="d-flex justify-content-between mt-4">
    <p>Menampilkan {{ $model->firstItem() }} s/d {{ $model->lastItem() }} dari {{ $model->total() }} data</p>

    {{ $model->links('pagination::bootstrap-4') }}
    {{-- {{ $model->links() }} //konfigurasi bootstrapnya ada du AppServiceProvider.php --}}
</div>
