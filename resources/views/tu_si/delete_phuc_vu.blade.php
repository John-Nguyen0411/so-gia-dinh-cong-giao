<div wire:ignore.self class="modal fade" id="deletePhucVu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa lịch sử phục vụ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="card-header" style="margin-top: -15px;">Bạn có chắc chắn muốn xóa lịch sử phục vụ này không?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" wire:click.prevent="delete()" class="btn btn-outline-danger d-inline-block px-3">Xóa</button>
            </div>
        </div>
    </div>
</div>