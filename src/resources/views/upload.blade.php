@extends('layouts.app')

@section('content')
    <form action="/upload" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" id="">
        <input type="submit" value="アップロード">
    </form>
@endsection