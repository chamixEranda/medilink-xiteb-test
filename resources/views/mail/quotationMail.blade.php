<x-mail::message>
Dear {{ $quotation->user->name }},

I hope this email finds you well. We are pleased to provide you with a quotation for the requested prescription outlined below:

<h2>Quotation No: {{ $quotation->id }}</h2>

<x-mail::table>
| Drug       | Amount         | Total  |
| ------------- |:-------------:| --------:|
@foreach ($quotation->details as $detail)
| {{ $detail->drug_name }}      | {{ number_format($detail->net_unit_cost,2) .' x '. $detail->qty }}      | {{ number_format($detail->total,2) }}      |
@endforeach
| ------------- |:-------------:| --------:|
|  Total Cost     |       | {{ number_format($quotation->total_cost,2) }}      |
</x-mail::table>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
