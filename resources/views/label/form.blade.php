<x-content>
    <x-slot name="title">
        {{ isset($data)?__('Edit Label'):__('Tambah Label') }}
    </x-slot>

    <div class="row p-4">
        <div class="col mb-2">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ isset($data)?route('label.update', $data->id):route('label.store') }}">
                        @csrf
                        @if(isset($data))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="exampleInputEmail1">Label Name</label>
                            <input required name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Label Name" value="{{ isset($data) ? old('name', $data->name) : old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea name="description" rows="4" class="form-control" id="exampleInputEmail1" placeholder="Description" required>{{ isset($data) ? old('description', $data->description) : old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Estimation Time (Minutes)</label>
                            <input oninput="estHour()" min="0" name="estimation" type="number" class="form-control" id="estimation" placeholder="Estimation Time" value="{{ isset($data) ? old('estimation', $data->history[0]->estimation) : old('estimation') }}" required>
                            <p class="py-2 text-muted" id="est"></p>
                        </div>

                        @if(isset($data))
                            <div class="form-group">
                                <label for="exampleInputEmail1">Reality Time (Minutes)</label>
                                <input oninput="estHour()" min="0" name="reality" type="number" class="form-control" id="reality" placeholder="Reality Time" value="{{ isset($data) ? old('reality', $data->history[0]->reality) : old('reality') }}" required>
                                <p class="py-2 text-muted" id="realy"></p>
                            </div>
                        @endif
                        <div class="text-right">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function convertMinutesToHoursAndMinutes(minutes) {
            if (isNaN(minutes) || minutes < 0) {
                return 'Invalid input';
            }

            const hours = Math.floor(minutes / 60);
            const remainingMinutes = minutes % 60;

            const hoursText = hours > 0 ? `${hours}h` : '';
            const minutesText = remainingMinutes > 0 ? `${remainingMinutes}m` : '';

            return `Konversi Jam : ${hoursText}${minutesText}`;
        }

        function estHour(){
            const est = document.getElementById("estimation").value;
            document.getElementById("est").innerText = convertMinutesToHoursAndMinutes(est);

            const realy = document.getElementById("reality").value;
            if(realy){
                document.getElementById("realy").innerText = convertMinutesToHoursAndMinutes(realy);
            }
        }

        @if(isset($data))
            estHour();
        @endif
    </script>
</x-content>
