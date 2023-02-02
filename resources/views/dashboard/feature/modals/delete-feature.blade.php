<!-- Delete Room Feature Modal -->
<div class="modal fade"  id="removeFeature_{{ $feature->id }}" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="py-5 text-center">
                    <h3>Are You Sure <br><i class="ion ion-ios-help" style="font-size: 5rem"></i></h3>
                    <h5>This action cannot be undone</h5>
                    <form id="delete-feature" method="post" action="{{ route('b-delete-room-feature',$feature->id) }}" class="d-inline my-2" id="delete-role-form">
                        @csrf
                        @method('DELETE')
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



