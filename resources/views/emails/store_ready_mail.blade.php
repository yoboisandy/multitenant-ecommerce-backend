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
            <p style="margin: 0">
                Hi {{ $store->user_name }},
            </p>
            <p>
                Your setup for store with subdomain <b>{{ $store->subdomain }}</b>
            has been completed. Please click the button below to visit your site.
            </p>
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
width: 120px;
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
                    Visit Site
                </button>
            </a>
        </td>
    </tr>
@endsection
