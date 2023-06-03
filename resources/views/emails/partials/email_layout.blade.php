<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Email Template</title>
</head>

<body style="font-family: Arial, sans-serif; font-size: 14px">
    <table cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto; width: 600px; max-width: 100%">
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" width="100%"
                    style="
              background: radial-gradient(
                123.22% 129.67% at 100.89% -5.6%,
                #201d47 0%,
                #17153a 100%
              );
              border-radius: 10px;
            ">
                    <tr>
                        <td style="padding: 30px">
                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td style="text-align: center; padding-bottom: 20px">
                                        <img src="{{ asset('assets/images/whiteLogo.svg') }}" alt="Logo"
                                            style="
                          display: block;
                          margin: 0 auto;
                          width: 200px;
                          height: 70px;
                        " />
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="
                        text-align: center;
                        padding-bottom: 20px;
                        color: rgba(151, 150, 207, 1);
                        font-size: 14px;
                        font-family: Inter, sans-serif;
                      ">
                                        <p style="margin: 0">
                                            Unlock Your Store's Potential
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="
                        background: linear-gradient(
                          241.25deg,
                          rgba(41, 39, 85, 0.35) 4.4%,
                          rgba(41, 39, 84, 0.78) 61.77%,
                          rgba(27, 24, 66, 0.35) 119.94%
                        );
                        border-radius: 10px;
                        padding: 20px;
                      ">
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            @yield('content')
                                            <tr>
                                                <td>
                                                    <div style="height: 1px; background-color: #343261" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="
                              padding-top: 25px;
                              font-size: 14px;
                              line-height: 20px;
                              color: #9796cf;
                            ">
                                                    @yield('footer', View::make('emails.partials.email_footer_content'))
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
