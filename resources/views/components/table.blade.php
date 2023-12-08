<!-- resources/views/components/table.blade.php -->

@props(['headers', 'datas', 'action' => false])

<table class="table">
    <thead>
    <tr class="text-center">
        <th scope="col" class="w-20">
            No
        </th>
        @foreach ($headers as $header)
            <th scope="col" class="text-capitalize">
                {{ $header }}
            </th>
        @endforeach
        @if($action)
            <th scope="col">
                Aksi
            </th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach ($datas as $data)
        <tr>
            <td>
                {{ $loop->iteration }}
            </td>
            @foreach ($headers as $key)
                <td>
                    {{ $data->{$key} }}
                </td>
            @endforeach

            @if($action == "detail")
                <td>
                    <a>Detail</a>
                </td>
            @elseif($action == "full")
                <td>
                    <a>Detail</a> |
                    <a>Edit</a> |
                    <a>Hapus</a>
                </td>
            @else
                <td>
                    <a>Edit</a> |
                    <a>Hapus</a>
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
