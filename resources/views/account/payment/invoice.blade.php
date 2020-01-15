@extends('layouts.dashboard-menu')

@section('content')
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<div class="container">
<table>
    <a href="{{route('charge')}}">Charge Invoice </a>
    <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Date</th>
            <th>Total</th>
            <th>PDF</th>
            <th>Amount</th>
            <th>Item</th>
            <th>PDF Download</th>
        </tr>
    @foreach ($invoices as $invoice)   
    <tr>
        <td>{{ $invoice->lines->data[0]->id }}</td>
        <td>{{ $invoice->customer_email }}</td>
        <td>{{ $invoice->date()->toFormattedDateString() }}</td>
        <td>{{ $invoice->total() }}</td>
        <td><a href="{{ $invoice->hosted_invoice_url }}">PDF</a></td>
        <td>{{ $invoice->billing }}</td>
        <td>{{ $invoice->lines->data[0]->description }}</td>
        <td><a href="{{ route('invoicedetail', $invoice->id) }}">Download</a></td>
    </tr>
    @endforeach
</table>
</div>
@endsection