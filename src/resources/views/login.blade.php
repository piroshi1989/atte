@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="form__content">
    <div class="form__heading">
        <h2>ログイン</h2>
    </div>
    <form class="form" action="/login" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-content">
                <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
            </div>
            <div class="form__error">
            @error('email')
            {{ $message }}
            @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <input type="password" name="password" placeholder="パスワード">
            </div>
            <div class="form__error">
            @error('password')
            {{ $message }}
            @enderror
            </div>
        </div>
        <button class="form__button-submit" type="submit">ログイン</button>
    </form>
    <div class="signup__container">
    <span class=signup__text>アカウントをお持ちでない方はこちらから</span>
    <a class="signup__link" href="/register">会員登録</a>
    </div>

</div>
@endsection