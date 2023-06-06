@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="attendance__alert">
  @if (session('message'))
  <div class="attendance__alert--success">
    {{ session('message') }}
  </div>
  @endif
  @if (session('error'))
  <div class="attendance__alert--error">
    {{ session('error') }}
  </div>
  @endif

<div class="form__content">
    <div class="form__heading">
        <h2>{{ $name }}さんお疲れ様です！</h2>
    </div>
    <div class="attendance__group">
        <div class="form__group">
            <form class="form" action='/start_worktime' method="post">
            @csrf
            <div class="form__group-button" id="start_worktime-button">
                <button type="submit" name="start_time" class="form__button">勤務開始</button>
            </div>
            </form>
        </div>
        <div class="form__group">
            <form class="form" action='/end_worktime' method=post>
            @csrf
            <div class="form__group-button" id="end_worktime-button">
                <button type="submit" class="form__button" name="end_time">勤務終了</button>
            </div>
            </form>
        </div>
    </div>

    <div class="breaktime__group">
        <div class="form__group">
            <form class="form" action='/start_breaktime' method=post>
            @csrf
            <div class="form__group-button" id="start_breaktime-button">
                <button type="submit" class="form__button" name="start_time">休憩開始</button>
            </div>
            </form>
        </div>
        <div class="form__group">
            <form class="form" action='/end_breaktime' method=post>
            @csrf
            <div class="form__group-button" id="end_breaktime-button">
                <button type="submit" class="form__button" name="end_time">休憩終了</button>
            </div>
            </form>
        </div>
    </div>

</div>
@endsection