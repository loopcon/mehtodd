<div class="modal fade lessionAddModal" id="profileditModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.lesson') }}</h2>
                <button data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="lesson-container">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">{{ __('messages.loading') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
