
<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Reset Password Email</title>
    <meta name="description" content="Reset Password Email Template.">
    <style type="text/css">
        a:hover {text-decoration: underline !important;}
        .mail_logo{
            position: absolute;
            width: 128px;
            height: 51px;
            left: 3px;
            top: -50px;
        }

        .rectangle_image{
            position: absolute;
            width: 551px;
            height: 91px;
            left: 0px;
            top: 0px;
            background: #0056B0;
        }
        .bottom_logo{
            position: absolute;
            left: -8.07%;
            right: 84.2%;
            top: 60.34%;
            bottom: 19.6%;

            /*background: #ABC7E5;*/
        }
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
<!--100% body table-->
<table style="margin-top: -30px" cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
       style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;">
    <tr>
        <td>
            <table style="background-color: white; max-width:670px;  margin:0 auto;" width="100%" border="0"
                   align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="height:80px;">&nbsp;</td>
                </tr>
                <tr>
                    <td class="mail_logo">
                        <a href="https://rakeshmandal.com" title="logo" target="_blank">
                            {{--                            <img src="https://res.cloudinary.com/sprintcorp/image/upload/v1624538400/wesonline/email/WESONLINE_no_back_kfqjaf.png" title="logo" alt="logo">--}}
                        </a>
                    </td>
                </tr>
                <tr>
                    {{--                    <td class="rectangle_image"><img src="https://res.cloudinary.com/sprintcorp/image/upload/v1624538403/wesonline/email/Rectangle_1459_h5yrb7.png" title="logo" alt="logo"></td>--}}
                </tr>
                <tr>
                    <td>
                        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                               style="background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                            <tr>
                                <td style="height:40px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="padding:0 35px;">
                                    <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;">You have
                                        requested to reset your password</h1>
                                    <span
                                        style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                        We cannot simply send you your old password. A unique link to reset your
                                        password has been generated for you. To reset your password, click the
                                        following link and follow the instructions.
                                    </p>

                                    <a href="{{ env('APP_URL').'/api/auth/user-password?token='.$user['remember_token']}}"
                                       style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Reset Password</a>
                                </td>
                            </tr>
                            {{--                            <tr class="bottom_logo">--}}
                            {{--                                <td style="height:40px;"> <img src="https://res.cloudinary.com/sprintcorp/image/upload/v1624539548/wesonline/email/Vector_bz9gxg.png"/></td>--}}
                            {{--                            </tr>--}}
                        </table>
                    </td>
                <tr>
                    <td style="height:20px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>{{env('APP_NAME')}}</strong></p>
                    </td>
                </tr>
                <tr>
                    <td style="height:80px;">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<!--/100% body table-->
</body>

</html>
