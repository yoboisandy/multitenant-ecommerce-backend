@extends('emails.partials.email_layout')

@section('content')
    <tr>
        <td style="
padding-top: 20px;
color: #fff;
font-size: 14px;
line-height: 20px;
text-align: justify;
">
            <div style="margin: 0;display: flex;justify-content: space-between;align-items: center">
                <p style="font-weight: bold;font-size: 20px">
                    @if (tenant())
                        {{ ucWords(tenant('store_name')) }}
                    @endif
                </p>
                <p style="font-size: 16px">
                    {{ date('jS M Y') }}
                </p>
            </div>
            <p>
                Hi, {{ $order->customer_name }},
            </p>
            <p>
                This email is to confirm that we have received your order {{ $order->order_number }} and is being processed.
            </p>
            <div style="border:solid 1px #ddd;padding:10px 20px;border-radius:6px;color:white;margin-bottom:12px">
                <p style="font-size:14px;margin:0 0 6px 0"><span
                        style="font-weight:bold;display:inline-block;min-width:150px">Order status</span><b
                        style="color:green;font-weight:normal;margin:0">Received</b></p>
                <p style="font-size:14px;margin:0 0 6px 0"><span
                        style="font-weight:bold;display:inline-block;min-width:146px">Order number</span>
                    {{ $order->order_number }}</p>

                <p style="font-size:14px;margin:0 0 6px 0"><span
                        style="font-weight:bold;display:inline-block;min-width:146px">Name</span>
                    {{ $order->customer_name }} </p>

                <p style="font-size:14px;margin:0 0 6px 0"><span
                        style="font-weight:bold;display:inline-block;min-width:146px">Phone</span>
                    {{ $order->customer_phone }}</p>

                <p style="font-size:14px;margin:0 0 6px 0"><span
                        style="font-weight:bold;display:inline-block;min-width:146px">Address</span>
                    {{ $order->customer_address_area }}</p>

                <p style="font-size:14px;margin:0 0 6px 0"><span
                        style="font-weight:bold;display:inline-block;min-width:146px">City</span>
                    {{ $order->customer_address_city }}</p>

                <p style="font-size:14px;margin:0 0 0 0"><span
                        style="font-weight:bold;display:inline-block;min-width:146px">Landmark</span>
                    {{ $order->customer_address_nearby_landmark }} </p>
            </div>
            <div style="margin-bottom:10px">
                @if (!empty($order->products))
                    <div style="font-size:16px;margin-bottom:6px">Ordered Products</div>
                    <div style="display: flex;flex-direction:column;gap:8px">
                        @foreach ($order->products as $product)
                            @php
                                $product = (object) $product;
                                $image =
                                    (!empty($product->variant)
                                        ? collect($product->product?->product_images)
                                            ?->where('variant', $product->variant?->name)
                                            ->first()?->image
                                        : null) ?? collect($product->product?->product_images)->first()?->image;
                            @endphp
                            <div style="display:flex;gap:10px">
                                <div>
                                    <img src="{{ $image }}" style="width:60px;height:60px;object-fit:cover">
                                </div>
                                <div style="display:flex;flex-direction:column">
                                    <span
                                        style="font-size:16px;margin-bottom:1px;font-weight:bold">{{ $product->product->name }}</span>
                                    @if (!empty($product->variant))
                                        <span style="font-size:12px;margin-bottom:1px;">Variant:
                                            {{ $product->variant->name }}</span>
                                    @endif
                                    <span style="font-size:12px;margin-bottom:1px">Rs. {{ $product->price }} x
                                        {{ $product->quantity }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div style="border:solid 1px #ddd;padding:10px 20px;border-radius:6px;color:white;margin-bottom:12px">
                <p style="font-size:14px;margin:0 0 6px 0"><span
                        style="font-weight:bold;display:inline-block;min-width:146px">Subtotal</span> Rs.
                    {{ $order->total_price - $order->delivery_charge }}</p>
                <p style="font-size:14px;margin:0 0 6px 0"><span
                        style="font-weight:bold;display:inline-block;min-width:146px">Deiivery Charge</span> Rs.
                    {{ $order->delivery_charge }}</p>
                <p style="font-size:14px;margin:0 0 6px 0"><span
                        style="font-weight:bold;display:inline-block;min-width:146px">Total</span> Rs.
                    {{ $order->total_price }}</p>
            </div>
            <div>
                <p>We are working our best to fulfill your order. You can track your order by clicking the button below:</p>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <a href="{{ $url }}">
                <button
                    style="
outline: 0;
border: 0;
text-decoration: none;
width: 180px;
height: 36px;
cursor: pointer;
background: linear-gradient(90deg, #059DFF 0%, #6549D5 20.31%, #E33FA1 49.03%, #FB5343 86.46%);
border-radius: 4px;
font-weight: 700;
font-size: 14px;
line-height: 16px;
text-transform: uppercase;

color: #ffffff;
">
                    Track Your Order
                </button>
            </a>
        </td>
    </tr>
    <tr style="color:#fff">
        <td style="
        font-size: 14px;
line-height: 20px;
text-align: justify;">
            @php
                $store = tenant('store_id');
                $phone = tenancy()->central(fn() => App\Models\Store::find($store)->phone);
            @endphp
            <p>If you have any questions or need assistance, please contact us at {{ $phone }}</p>
        </td>
    </tr>
@endsection
