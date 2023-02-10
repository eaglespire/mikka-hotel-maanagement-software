<div class="row">
    <div class="col-lg-12">
        @can(\App\Services\Permissions::CAN_CREATE_BLOG)
            <x-back-button header-title="FAQ">
                <a wire:click.prevent="OpenModal" href="" class="btn btn-success">
                    <i class="ion ion-md-create"></i> New
                </a>
            </x-back-button>
        @endcan
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="accordion" id="accordionExample">
                            @if($items->total() > 0)
                                @foreach($items as $item)
                                    <div class="card mb-0">
                                        @can(\App\Services\Permissions::CAN_UPDATE_BLOG && \App\Services\Permissions::CAN_DELETE_BLOG)
                                            <div class="d-lg-flex" style="cursor: pointer">
                                                <i wire:click.prevent="OpenModal(1,'{{ $item['id'] }}')" class="typcn
                                            typcn-edit text-primary" style="font-size: 30px"></i>
                                                <i wire:click.prevent="DeleteFaq({{ $item['id'] }})" class="typcn typcn-delete text-danger"
                                                   style="font-size:
                                            30px"></i>
                                            </div>
                                        @endcan
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
    <x-custom :modal-header="$modalHeader">
        <form>
            <div class="form-group">
                <label for="" class="form-label"> Question  </label>
                <textarea wire:model.defer="question" cols="30" rows="5" class="form-control @error('question') is-invalid @enderror"
                          placeholder="question"></textarea>
                @error('question')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="" class="form-label">Answer </label>
                <textarea wire:model.defer="answer" cols="30" rows="5" class="form-control @error('answer') is-invalid @enderror"
                          placeholder="answer"></textarea>
                @error('answer')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div wire:loading.block wire:target="SaveEditFaq" class="alert alert-info">Processing</div>
            @if($mode == 0)
                <button wire:click.prevent="AddFaq" class="btn btn-primary">{{ $btnText }}</button>
            @else
                <button wire:click.prevent="SaveEditFaq" class="btn btn-primary">{{ $btnText }}</button>
            @endif


        </form>
    </x-custom>

</div>

@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', function (){
            @this.on('success', message => {
                Swal.fire({
                    icon:'success',
                    title:'Success',
                    text: message
                })
            })
            @this.on('fail', message => {
                Swal.fire({
                    icon:'warning',
                    title:'Error',
                    text: message
                })
            })
        })
    </script>
@endpush


