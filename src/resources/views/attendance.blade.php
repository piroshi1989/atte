@extends('layouts.app')


@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="date-table">
    <div class="date-table__heading">
        @foreach ($formattedRecords as $data)
        <h2>{{ $data['date'] }}</h2>
{{ $formattedRecords->links('vendor.pagination.simple-tailwind') }}
    </div>
    <table class="date-table__inner">
        <tr class="date-table__row">
            <th class="date-table__header">名前</th>
            <th class="date-table__header">勤務開始</th>
            <th class="date-table__header">勤務終了</th>
            <th class="date-table__header">休憩時間</th>
            <th class="date-table__header">勤務時間</th>
        </tr>
            @foreach ($data['records'] as $record)
        <tr class="date-table__row">
            <td class="date-table__item">{{ $record['name'] }}</td>
            <td class="date-table__item">{{ $record['start_time']}}</td>
            <td class="date-table__item">{{ $record['end_time']}}</td>
            <td class="date-table__item">{{ $record['total_break_time'] }}</td>
            <td class="date-table__item">{{ $record['total_attendance_time'] }}</td>
            @endforeach
        @endforeach
        </tr>
    </table>
        {{ $data['records']->links('vendor.pagination.tailwind') }}
</div>
@endsection