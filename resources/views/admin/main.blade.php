
@extends('layouts.master')

@section('content')


        @if($orders)
            <table>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->customer_name}}</td>
                    <td>{{$order->customer_email}}</td>
                    <td>{{$order->customer_phone_number}}</td>
                    <td>{{$order->user->name}}</td>
                    <td>{{$order->is_self_delivery}}</td>
                    <td>{{$order->warehouse}}</td>
                    <td>{{$order->payment_id}}</td>
                    <td>{{$order->shipping_price}}</td>
                    <td><button type="button" class="admin-remove-order" data-id="{{$order->id}}">Удалить</button></td>


                </tr>
            @endforeach
            </table>
        @else
            <h1>Заказов не найдено:(</h1>
        @endif



@endsection