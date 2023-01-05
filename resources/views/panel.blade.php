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
    <x-feature title="Set Webhook" method="setWebhook" params="{{ $webhook_url }}">
        sets webhook url to {{ $webhook_url }}
    </x-feature>
    <x-feature title="Delete Webhook" method="deleteWebhook">
        deletes webhook settings
    </x-feature>
@endsection
