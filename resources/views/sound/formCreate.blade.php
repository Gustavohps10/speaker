@extends('layouts.app')


@section('content')
    <form action={{route('sound.store')}} method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="sound">
        <input type="submit" value="ENVIAR">
    </form>
@endsection