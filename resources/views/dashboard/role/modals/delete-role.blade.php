<!-- Edit Role Modal -->
<div class="modal fade"  id="removeRole_{{ $role->id }}" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="p-3 text-center">
                    <h2>Are You Sure?</h2>
                    <h5>This action cannot be undone</h5>
                    <form id="delete-form" method="post" action="{{ route('b-delete-role') }}" class="d-inline my-2" id="delete-role-form">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $role->id }}">
                        <button id="deleteButton" type="submit" class="btn btn-danger">
                            Yes,Delete
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Cancel</button>
                    </form>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



