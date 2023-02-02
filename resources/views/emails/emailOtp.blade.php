<table style="table-layout:fixed; border-spacing:0; border-collapse:collapse; background-color:#f7f7f7; width:100%; margin:0 auto; padding:0;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#f7f7f7;">
    <tbody>
    <tr>
        <td style="padding:25px 0;" align="center">
            <table style="table-layout:fixed; border-spacing:0; border-collapse:collapse; background-color:#fff; border-radius:10px; min-width: 320px; max-width:600px; margin:0 auto; box-shadow:0px 0px 14px -4px rgba(0,0,0,0.2);" width="650" cellspacing="0" cellpadding="0" bgcolor="#f7f7f7;">
                <tbody>
                <tr>
                    <td align="center">
                        <table style="background-color:#fff; padding:25px 25px; border-radius:10px 10px 0 0;" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                            <tr>
                                <td align="center">
                                    <img style="text-decoration:none; height:auto; border:0; width:100%; max-width:150px; display:block;"
                                         title="logo" alt="logo"
                                         src="{{ asset('assets/images/logo-light.png') }}" width="150" border="0" align="middle">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0;" align="center">
                        <p style="color:#000; font-family:'Roboto',Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; letter-spacing:0.5px; line-height:1.5; text-align:center; margin:0 0 0;">
                          Hello {{ $user->fullname }}  You have requested to have your password changed. <br> Please use the otp code below in
                            order to be able to proceed with your request.
                            <br>If this request did not originate from you, kindly disregard
                        </p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:16px 25px 20px;" align="center">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                            <tr>
                                <td style="padding:0;" align="center">
                                    <p
                                        style="color:#000; font-family:'Roboto',Arial, Helvetica, sans-serif; font-size:15px; font-weight:normal;
                                    letter-spacing:0.5px; line-height:1.5; text-align:center; margin:0 0 20px;">
                                        <span style="border:1px dashed
                                    #c8c8c8; border-radius:4px; padding:6px 10px; display:inline-block; background-color:#f7f7f7;">
                                            OTP: <strong style="color:#f4857b;">{{ $otp }}</strong>
                                        </span>
                                    </p>
                                    <p style="color:#000; font-family:'Roboto',Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; letter-spacing:0.5px; line-height:1.5; text-align:center; margin:0 0 0;">
                                        This code expires in 5 minutes
                                    </p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table style="background-color:#fff; padding:25px 25px; border-radius:0 0 10px 10px;" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                            <tr>
                                <td style="padding:0 0 10px;" valign="top" align="center">
                                    <a href="#"
                                       style="padding:0 5px; margin:0; text-decoration:none; display:inline-block;font-size:0;">
                                        <img
                                            style="text-decoration:none; height:auto; border:0; display:block;" title="facebook"
                                            src="{{ asset('images/facebook-black.png') }}"
                                            alt="Facebook" width="30" height="30">
                                    </a>
                                    <a href="#" style="padding:0 5px; margin:0; text-decoration:none; display:inline-block;font-size:0;">
                                        <img
                                            style="text-decoration:none; height:auto; border:0; display:block;" title="Twitter"
                                            src="{{ asset('images/twitter-black.png') }}" alt="Twitter" width="30" height="30">
                                    </a>
                                    <a href="#"
                                       style="padding:0 5px; margin:0; text-decoration:none; display:inline-block;font-size:0;">
                                        <img
                                            style="text-decoration:none; height:auto; border:0; display:block;" title="YouTube"
                                            src="{{ asset('images/youtube-black.png') }}" alt="YouTube" width="30" height="30">
                                    </a>
                                    <a href="#"
                                       style="padding:0 5px; margin:0; text-decoration:none; display:inline-block;font-size:0;">
                                        <img style="text-decoration:none; height:auto; border:0; display:block;" title="Instagram"
                                             src="{{ asset('images/instagram-black.png') }}" alt="Instagram" width="30" height="30">
                                    </a>
                                    <a href="#"
                                       style="padding:0 5px; margin:0; text-decoration:none; display:inline-block;font-size:0;">
                                        <img style="text-decoration:none; height:auto; border:0; display:block;" title="Linkedin"
                                             src="{{ asset('images/linkedin-black.png') }}" alt="Linkedin" width="30" height="30">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0 0;" valign="top" align="center">
                                    <a href="#" style="color:#000; font-family:'Roboto',Arial, Helvetica, sans-serif; padding:0 5px; margin:0; text-decoration:none; display:inline-block; font-size:13px;">About</a>
                                    <a href="#" style="color:#000; font-family:'Roboto',Arial, Helvetica, sans-serif; padding:0 5px; margin:0; text-decoration:none; display:inline-block; font-size:13px;">Contact</a>
                                    <a href="#" style="color:#000; font-family:'Roboto',Arial, Helvetica, sans-serif; padding:0 5px; margin:0; text-decoration:none; display:inline-block; font-size:13px;">Help</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:16px 25px 20px;" align="center">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="padding:0;" align="center">
                                                <p style="color:#000; font-family:'Roboto',Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; letter-spacing:0.5px; line-height:1.5; text-align:center; margin:0 0 0;">
                                                    &copy;2023 {{ config('app.name') }}
                                                </p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
