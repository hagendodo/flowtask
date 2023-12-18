<x-content>
    <x-slot name="title">
        {{ __('Latest 5 Member BSO Dimensi Web') }}
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
                            {{ $loop->iteration }}
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
                            {{ $data->waktu_pendaftaran }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-content>

