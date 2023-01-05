@extends('layout')
@section('body')
    <x-feature title="Get Me" method="getMe">
        gets bot's information and works as a simple test
    </x-feature>
    <x-feature title="Get Updates" method="getUpdates">
        gets messages received by the bot
    </x-feature>
    <x-feature title="Get Webhook" method="getWebhookInfo">
        gets webhook settings
    </x-feature>
@endsection
