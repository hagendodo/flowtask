<x-content>
    <x-slot name="title">
        {{ __('Label') }}
    </x-slot>
    <script>
        function convertMinutesToHoursAndMinutes(minutes) {
            if (isNaN(minutes) || minutes < 0) {
                return 'Invalid input';
            }

            const hours = Math.floor(minutes / 60);
            const remainingMinutes = minutes % 60;

            const hoursText = hours > 0 ? `${hours}h` : '';
            const minutesText = remainingMinutes > 0 ? `${remainingMinutes}m` : '';

            document.writeln(`${hoursText}${minutesText}`);
        }
    </script>
    <div class="row p-4">
        <div class="col-12 mb-4">
            <div class="mb-3 text-right">
                <x-primary-link-button href="{{ route('label.create') }}">Tambah Data</x-primary-link-button>
            </div>

            <table class="table">
                <thead>
                <tr class="text-center">
                    <th scope="col" class="w-20">
                        No
                    </th>
                    <th scope="col" class="text-capitalize">
                        Label
                    </th>
                    <th scope="col" class="text-capitalize">
                        Deskripsi
                    </th>
                    <th scope="col" class="text-capitalize">
                        Estimasi
                    </th>
                    <th scope="col">
                        Aksi
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $data->name }}
                        </td>
                        <td>
                            {{ $data->description }}
                        </td>
                        <td>
                            <script>convertMinutesToHoursAndMinutes({{ $data->history[0]->estimation }})</script>
                        </td>
                        <td class="text-center">
                            <x-close-primary-button data-toggle="modal" data-target="#detail_{{$data->id}}" style="display:inline;">
                                <i class="bi bi-eye"></i>
                            </x-close-primary-button>
                            <x-secondary-link-button href="{{route('label.edit', $data->id)}}" style="display:inline;">
                                <i class="bi bi-pencil-square"></i>
                            </x-secondary-link-button>
                            <form action="{{ route('label.destroy', $data->id) }}" method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <x-danger-button>
                                    <i class="bi bi-trash"></i>
                                </x-danger-button>
                            </form>
                            <div class="modal fade" id="detail_{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                {{ $data->name }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>History estimation of this label</p>
                                            <table class="table">
                                                <thead>
                                                <tr class="text-center">
                                                    <th scope="col" class="w-20">
                                                        No
                                                    </th>
                                                    <th scope="col" class="text-capitalize">
                                                        Tanggal
                                                    </th>
                                                    <th scope="col" class="text-capitalize">
                                                        Estimasi
                                                    </th>
                                                    <th scope="col" class="text-capitalize">
                                                        Reality
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($data->history as $history)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $history->created_at }}</td>
                                                        <td><script>convertMinutesToHoursAndMinutes({{ $history->estimation }})</script></td>
                                                        <td><script>convertMinutesToHoursAndMinutes({{ $history->reality }})</script></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <x-close-primary-button data-dismiss="modal">
                                                Close
                                            </x-close-primary-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-content>

