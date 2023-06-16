@extends('layouts.app')


@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="date-table">
    <div class="date-table__heading">
        @foreach ($formattedRecords as $data)
        <h2>
            <a href="javascript:void(0);" onclick="showTable('{{ $data['name'] }}')">
                {{ $data['name'] }}
            </a>
        </h2>
        @endforeach
    </div>


    @foreach ($formattedRecords as $data)
    <div id="attendanceTable-{{ $data['name'] }}" style="display: none;">
    <table class="date-table__inner">
        <tr class="date-table__row">
            <th class="date-table__header">勤務日</th>
            <th class="date-table__header">勤務開始</th>
            <th class="date-table__header">勤務終了</th>
            <th class="date-table__header">休憩時間</th>
            <th class="date-table__header">勤務時間</th>
        </tr>
            @foreach ($data['records'] as $record)
        <tr class="date-table__row">
            <td class="date-table__item">{{ $record['date'] }}</td>
            <td class="date-table__item">{{ $record['start_time']}}</td>
            <td class="date-table__item">{{ $record['end_time']}}</td>
            <td class="date-table__item">{{ $record['total_break_time'] }}</td>
            <td class="date-table__item">{{ $record['total_attendance_time'] }}</td>
        </tr>
        @endforeach
    </table>
    </div>
        @endforeach
        {{ $data['records']->links('vendor.pagination.tailwind') }}
</div>

<script>
    function showTable(name) {
        // すべてのテーブルを非表示にする
        var tables = document.querySelectorAll('[id^="attendanceTable-"]');
        for (var i = 0; i < tables.length; i++) {
            tables[i].style.display = 'none';
        }

        // 対応するテーブルを表示する
        var tableId = 'attendanceTable-' + name;
        document.getElementById(tableId).style.display = 'block';
    }
</script>
@endsection