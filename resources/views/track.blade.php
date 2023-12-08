<x-content>
    <x-slot name="title">
        {{ __('Task') }}
    </x-slot>

    <div class="row p-4">
        <div class="col-12">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header bg-dark text-white">Project Name</div>
                        <div class="card-body">
                            <h5 class="card-title">Rp. 300.000</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="text-right">
                                <x-secondary-link-button href="#">{{ __('Detail') }}</x-secondary-link-button>
                                <x-primary-link-button href="#">{{ __('Track') }}</x-primary-link-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">Tugas</div>
                        <div class="card-body">
                            <h5 class="card-title">Tugas Mandiri 3 SKS</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="text-right">
                                <x-secondary-link-button href="#">{{ __('Detail') }}</x-secondary-link-button>
                                <x-primary-link-button href="#">{{ __('Track') }}</x-primary-link-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-content>

