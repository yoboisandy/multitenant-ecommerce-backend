@extends('emails.partials.email_layout')

@section('content')
    <tr>
        <td style="
padding-top: 20px;
color: rgba(112, 178, 255, 1);
font-size: 16px;
font-family: Inter, sans-serif;
">
            <p style="margin: 0">
                Activate Your Store on Mecomm
            </p>
        </td>
    </tr>
    <tr>
        <td style="
padding-top: 20px;
color: #fff;
font-size: 14px;
line-height: 20px;
text-align: justify;
">
            <p style="margin: 0">
                Thank you for signing up for Mecomm! We're
                excited to have you as a part of our community.
            </p>
            <p>
                To activate your store, please click on the
                link below:
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
                    Activate Now
                </button>
            </a>
        </td>
    </tr>
    <tr>
        <td style="
color: #ffffff;
padding-top: 15px;
padding-bottom: 25px;
line-height: 20px;
">
            <p>
                Thank you for joining Mecomm. We look forward to seeing you on the platform.
            </p>
        </td>
    </tr>
@endsection
