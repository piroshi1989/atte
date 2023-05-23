@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="form__content">
    <div class="form__heading">
        <h2>会員登録</h2>
    </div>
    <form class="form">
        <div class="form__group">
            <div class="form__group-content">
                <input type="text" name="name" placeholder="名前">
            </div>
            <div class="form__error">
                {{-- バリデーション実装 --}}
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <input type="email" name="email" placeholder="メールアドレス">
            </div>
            <div class="form__error">
                {{-- バリデーション実装 --}}
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <input type="text" name="password" placeholder="パスワード">
            </div>
            <div class="form__error">
                {{-- バリデーション実装 --}}
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <input type="text" name="password" placeholder="確認用パスワード">
            </div>
            <div class="form__error">
                {{-- バリデーション実装 --}}
            </div>
        </div>
        <button class="form__button-submit" type="submit">会員登録</button>
    </form>
    <div class="login__container">
    <span class=login__text>アカウントをお持ちの方はこちらから</span>
    <a class="login__link" href="/register">ログイン</a>
    </div>

</div>
@endsection