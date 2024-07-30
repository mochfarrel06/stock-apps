<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary mb-2">{{ $title }}</h6>
        @if ($addRoute)
            <a href="{{ route($addRoute) }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-2">Tambah
                Data</a>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        @foreach ($headers as $key => $header)
                            <th>{{ is_numeric($key) ? $header : $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            @foreach ($headers as $key => $header)
                                @if ($header === 'No')
                                    <td class="index">{{ $loop->index + 1 }}</td>
                                @elseif (is_numeric($key))
                                    <td>{{ $item->$header ?? '' }}</td>
                                @else
                                    @php
                                        $keys = explode('.', $key);
                                        $value = $item;
                                        foreach ($keys as $k) {
                                            $value = $value->$k ?? '';
                                        }
                                    @endphp
                                    <td>{{ $value }}</td>
                                @endif
                            @endforeach
                            @if ($actions)
                                <td>
                                    @foreach ($actions as $action)
                                        <a href="{{ route($action['route'], $item->id) }}"
                                            class="btn btn-{{ $action['class'] }} mr-2 mb-2">
                                            <i class="fas {{ $action['icon'] }}"></i>
                                        </a>
                                    @endforeach
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
