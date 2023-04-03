@extends('layouts.email')

@section('content')
    <p style="font-size: 14px;">{{ $inviter }} would like to chat with you on {{ config('app.name') }}.</p>
    <div style="text-align: center; margin-top: 2rem;">
        <a href="{{ $accept_url }}" class="email-button">Accept</a>
        <p>or</p>
        <a href="{{ $decline_url }}" class="email-button">Decline</a>
    </div>
@endsection
