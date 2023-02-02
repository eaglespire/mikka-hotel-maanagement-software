<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="d-flex justify-content-between">
                            <h5 class="mt-0 font-18 mb-4"><i class="ti-agenda text-primary mr-2"></i>FAQ</h5>
                            <button wire:click.prevent="$emit('open-modal')" class="btn btn-primary">
                                <i class="typcn typcn-plus"></i> Add Faq
                            </button>
                        </div>
                        <hr>
                        <div class="accordion" id="accordionExample">
                            @if($items->total() > 0)
                                @foreach($items as $item)
                                    <div class="card mb-0">
                                        <div class="d-lg-flex" style="cursor: pointer">
                                            <i wire:click.prevent="$emit('open-edit-modal',{{ $item['id'] }},'{{ $item['question'] }}','{{
                                            $item['answer'] }}')" class="typcn
                                            typcn-edit text-primary" style="font-size: 30px"></i>
                                            <i wire:click.prevent="DeleteFaq({{ $item['id'] }})" class="typcn typcn-delete text-danger"
                                               style="font-size:
                                            30px"></i>
                                        </div>
                                        <a data-toggle="collapse" href="#collapse{{ $loop->iteration }}" class="faq" aria-expanded="true"
                                           aria-controls="collapseOne">
                                            <div class="card-header text-light" id="headingOne">
                                                <h6 class="m-0 faq-question">{{ $item['question'] }}</h6>
                                            </div>
                                        </a>

                                        <div id="collapse{{ $loop->iteration }}" class="collapse "
                                             aria-labelledby="headingOne"
                                             data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p class="text-muted mb-0 faq-ans">
                                                    {{ $item['answer'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- collapse one end -->
                                @endforeach
                            @endif
                            <div class="py-2">
                                {{ $items->links() }}
                            </div>
                        </div>
                        <!-- end accordian -->
                    </div>
                </div>
                <!-- end row -->

            </div>
        </div>
    </div>
    <!-- modal -->
    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display:
    none;"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    @if(!empty($_id))
                        <h5 class="modal-title mt-0">Edit FAQ</h5>
                    @else
                        <h5 class="modal-title mt-0">Add FAQ</h5>
                    @endif
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="" class="form-label">
                                Question
                            </label>
                            <textarea wire:model.defer="question" cols="30" rows="5" class="form-control @error('question') is-invalid @enderror"
                                      placeholder="question"></textarea>
                            @error('question')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">
                                Answer
                            </label>
                            <textarea wire:model.defer="answer" cols="30" rows="5" class="form-control @error('answer') is-invalid @enderror"
                                      placeholder="answer"></textarea>
                            @error('answer')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        @if(!empty($_id))
                            @include('includes.processing', ['action' => 'SaveEditFaq'])
                            <div wire:loading.block wire:target="SaveEditFaq">Processing</div>
                            <button wire:click.prevent="SaveEditFaq" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        @else
                            @include('includes.processing', ['action' => 'AddFaq'])
                            <button wire:click.prevent="AddFaq" class="btn btn-primary">Add</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        @endif

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- END OF MODAL -->
</div>

@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', function (){
            @this.on('open-modal', event => {
                $('.bs-example-modal-center').modal('show')
            })
            @this.on('open-edit-modal',( id,question,answer )=> {
                $('.bs-example-modal-center').modal('show')
                @this.emitSelf('setId',id,question,answer)
            })
            @this.on('changes-saved', event => {
                Swal.fire({
                    icon:'success',
                    title:'Success',
                })
            })
            @this.on('changes-not-saved', event => {
                Swal.fire({
                    icon:'warning',
                    title:'Error',
                })
            })
            $('.bs-example-modal-center').on('hide.bs.modal', function () {
                @this.call('resetInputFields')
            })
        })
    </script>
@endpush


