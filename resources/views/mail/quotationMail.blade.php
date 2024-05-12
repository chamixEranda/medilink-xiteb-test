<x-mail::message>
# Introduction

<h1>{{ $quotation->id }}</h1>

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
