<!-- Edit Role Modal -->
<div class="modal fade"  id="assignPermission" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="p-3 text-center">
                    <h2>Do you want to assign these permissions to this role?</h2>
                    <button onclick="event.preventDefault(); document.getElementById('permissions-form').submit();" id="deleteButton" type="submit" class="btn btn-danger">
                        Yes,Proceed
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Cancel</button>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



