@extends('layouts.app')


@section('content')
<form action=" {!! route('resendEmail') !!}" method="POST">
    <label for="email">Your email</label>
    <input type="text" id="email" name="email" value="example@email.com">
    <input type="submit" value="Submit">
</form>
    @stop
