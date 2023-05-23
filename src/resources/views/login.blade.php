@extends('layouts.app')
@section('content')
<div class="form__content">
    <div class="form__heading">
        <h2>ログイン</h2>
    </div>
    <form class="form">
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
        <button class="form__button-submit" type="submit">ログイン</button>
    </form>
    <div class="signup__container">
    <span class=signup__text>アカウントをお持ちでない方はこちらから</span>
    <a class="signup__link" href="/register">会員登録</a>
    </div>

</div>
@endsection