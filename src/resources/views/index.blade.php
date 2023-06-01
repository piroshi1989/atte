@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="form__content">
    <div class="form__heading">
        <h2>名前さんお疲れ様です！</h2>
        {{-- あとで修正　{{ $content['name']  }}とか？ --}}
    </div>
    <form class="form">
        <div class="form__group">
            <div class="form__group-button">
       <button class="form__button" type="button" value="">勤務開始</button>
       {{-- js?開始を押したらボタンをグレーにし、終了を押すまで押せなくなる --}}
            </div>
            <div class="form__group-button">
       <button class="form__button" type="button" value="">勤務終了</button>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-button">
       <button class="form__button" type="button" value="">休憩開始</button>
            </div>
            <div class="form__group-button">
       <button class="form__button" type="button" value="">休憩終了</button>
            </div>
        </div>
    </form>

</div>
@endsection