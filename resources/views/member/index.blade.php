<x-content>
    <x-slot name="title">
        {{ __('Member BSO Dimensi Web') }} ({{ $total }} Orang Terdaftar)
    </x-slot>
    <div class="row p-4">
        <div class="col-12 mb-4">
            <table class="table">
                <thead>
                <tr class="text-center">
                    <th scope="col" class="w-20">
                        No
                    </th>
                    <th scope="col" class="text-capitalize">
                        No Whatsapp
                    </th>
                    <th scope="col" class="text-capitalize">
                        Nama
                    </th>
                    <th scope="col">
                        NIM
                    </th>
                    <th scope="col">
                        Harapan
                    </th>
                    <th scope="col">
                        Bidang
                    </th>
                    <th scope="col">
                        Waktu Pendaftaran
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td class="text-center">
                            {{ ($datas->currentPage() - 1) * $datas->perPage() + $loop->index + 1 }}
                        </td>
                        <td>
                            {{ $data->nowa }}
                        </td>
                        <td>
                            {{ $data->nama }}
                        </td>
                        <td>
                            {{ $data->nim }}
                        </td>
                        <td>
                            {{ $data->harapan }}
                        </td>
                        <td>
                            {{ $data->bidang }}
                        </td>
                        <td>
                            {{ $data->created_at }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-end">
                {{ $datas->links() }}
            </div>
        </div>
    </div>
</x-content>

