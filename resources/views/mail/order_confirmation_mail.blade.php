<head>
    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,700italic,900);
        body { font-family: 'Roboto', Arial, sans-serif !important; }
        a[href^="tel"]{
            color:inherit;
            text-decoration:none;
            outline:0;
        }
        a:hover, a:active, a:focus{
            outline:0;
        }
        a:visited{
            color:#FFF;
        }
        span.MsoHyperlink {
            mso-style-priority:99;
            color:inherit;
        }
        span.MsoHyperlinkFollowed {
            mso-style-priority:99;
            color:inherit;
        }
    </style>
</head>

<body style="margin: 0; padding: 0;background-color:#EEEEEE;">
<div style="display:none;font-size:1px;color:#333333;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">
    Shopping Details
</div>
<table cellspacing="0" style="margin:0 auto; width:100%; border-collapse:collapse; background-color:#EEEEEE; font-family:'Roboto', Arial !important">
    <tbody>
    <tr>
        <td align="center" style="padding:20px 23px 0 23px">
            <table width="600" style="background-color:#FFF; margin:0 auto; border-radius:5px; border-collapse:collapse; border: 2px solid black">
                <tbody>
                <tr>
                    <td align="center">
                        <table width="500" style="margin:0 auto">
                            <tbody>


                            </tr>
                            <tr>
                                <td align="center" style="font-family:'Roboto', Arial !important">
                                    <img src="https://i1.wp.com/www.sajhadeal.com/wp-content/uploads/2018/12/cropped-sajhadeal-logo.png?w=468&amp;ssl=1" style="max-height: 40px" alt="company logo">
                                    <!--<a class="email-masthead_name">SajhaDeal</a>-->
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="padding:15px 0 20px 0; font-family:'Roboto', Arial !important">
                                    <p style="margin:0; font-size:18px; color:#000; line-height:24px; font-family:'Roboto', Arial !important">
                                        Thank You For Shopping With Us !

                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="padding:15px 0 20px 0; font-family:'Roboto', Arial !important">
                                    <p style="margin:0; font-size:18px; color:#000; line-height:24px; font-family:'Roboto', Arial !important">

                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="padding-bottom:30px">
                                    <table style="width:255px; margin:0 auto;">
                                        <tbody>
                                        <tr>
                                            <td width="255" style="background-color:#008AF1; text-align:center; border-radius:5px; vertical-align:middle; padding:13px 0">
                                                <a style="color:white" href="{{ env('APP_URL') }}/order_track">Track Order</a>
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
                <tr>
                    <td align="center" cellspacing="0" style="padding:0 0 30px 0; vertical-align:middle">
                        <table width="550" style="border-collapse:collapse; background-color:#FaFaFa; margin:0 auto; border:1px solid #E5E5E5">
                            <tbody>

                            <tr>
                                <td width="276" style="vertical-align:top; border-right:1px solid #E5E5E5">
                                    <table style="width:100%; border-collapse:collapse">
                                        <tbody>
                                        <tr>
                                            <td style="vertical-align:top; padding:18px 18px 8px 23px; font-family:'Roboto', Arial !important">
                                                <p style="font-size:16px; color:#333333; text-transform:uppercase; font-weight:900; margin:0; font-family:'Roboto', Arial !important">
                                                    Order Details
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="">
                                            <td style="vertical-align:top; padding:0 18px 18px 23px">
                                                <table width="100%" style="border-collapse:collapse">
                                                    <tbody>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0; font-family:'Roboto', Arial !important">
                                                                Order Code :
                                                            </p>
                                                        </td>
                                                        <td align="left" style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0; font-family:'Roboto', Arial !important">
                                                                {{ $content['order']->order_track }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0; font-family:'Roboto', Arial !important">
                                                                Subtotal :
                                                            </p>
                                                        </td>
                                                        <td align="left" style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0; font-family:'Roboto', Arial !important">
                                                                Rs.{{ $content['order']->subtotal }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0; font-family:'Roboto', Arial !important">
                                                                Shipping Price:
                                                            </p>
                                                        </td>
                                                        <td align="left" style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0; font-family:'Roboto', Arial !important">
                                                                Rs.{{ $content['order']->shipping->shipping_price }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 10px 0; font-family:'Roboto', Arial !important">
                                                                Total:
                                                            </p>
                                                        </td>
                                                        <td align="left" style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 10px 0; font-family:'Roboto', Arial !important">
                                                                Rs.{{ $content['order']->final_total }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="font-family:'Roboto', Arial !important;" colspan="2">
                                                            <p style="font-size:16px; color:#bc0101; margin:0;padding:0; font-weight:bold; font-family:'Roboto', Arial !important">
                                                                @if($content['order']->discount > 0 )
                                                                    You saved Rs.{{$content['order']->discount}}!
                                                                @endif
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
                                <td style="vertical-align:top">
                                    <table width="100%" style="border-collapse:collapse">
                                        <tbody>
                                        <tr>
                                            <td style="vertical-align:top; padding:18px 18px 8px 23px; font-family:'Roboto', Arial !important">
                                                <p style="font-size:16px; color:#333333; text-transform:uppercase; font-weight:900; margin:0; font-family:'Roboto', Arial !important">
                                                    Shipping Details:
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align:top; padding:0 18px 18px 23px; font-family:'Roboto', Arial !important">
                                                <table width="100%" style="border-collapse:collapse">
                                                    <tbody>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0; font-family:'Roboto', Arial !important">
                                                                {{ $content['order']->address }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important">
                                                            <p style="font-size:16px; color:#000; margin:0 0 5px 0; font-family:'Roboto', Arial !important">
                                                                [{{ $content['order']->shipping->shipping_location }}]
                                                            </p>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td style="font-family:'Roboto', Arial !important;">
                                                            <p style="font-size:16px; color:#000; margin:0;padding:0; font-family:'Roboto', Arial !important">
                                                                Phone : {{ $content['order']->phone }}
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
                <tr>
                    <td align="center" cellspacing="0" style="padding:0; vertical-align:middle">
                        <table width="550" style="border-collapse:collapse; background-color:#FaFaFa; margin:0 auto; border-bottom:1px solid #E5E5E5">
                            <tbody>
                            <tr>
                                <td width="380" align="left" style="padding:15px 0 15px 25px; font-family:'Roboto', Arial !important">
                                    <p style="text-transform:uppercase;font-size:16px; color:#333333; margin:0; font-weight:400; font-family:'Roboto', Arial !important; ">
                                        <span style="font-weight: 900;">  Items</span>
                                    </p>
                                </td>
                                <td width="60" align="right" style="font-family:'Roboto', Arial !important">
                                    <p style="margin:0; font-size:14px; color:#333333;padding:0;font-family:'Roboto', Arial !important;text-align:center;">
                                        Quantity</p>
                                </td>
                                <td width="80" align="right" style="font-family:'Roboto', Arial !important;padding-right:10px;">
                                    <p style="margin:0; font-size:14px; color:#333333;padding:0;font-family:'Roboto', Arial !important;text-align:right;">
                                        Price</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                @foreach($content['order']->order_details as $order_detail)
                <tr>
                    <td style=" font-family:'Roboto', Arial !important;padding:0;" align="center">
                        <table width="550" style="border-collapse:collapse;margin: 0 auto;border-bottom: 1px solid #EBEBEB">
                            <tbody>
                            <tr>
                                <td width="117" align="right" style="padding:24px 0 24px 10px; text-align:left;">
                                    <a href="https://supplify.de/" target="_blank" style="text-decoration:none; color:#000; outline:0;">
                                        <img src="{{ asset($order_detail->product->get_main_image($order_detail->product_id)) }}" style="max-height: 300px; max-width: auto;"  border="0">
                                    </a>
                                </td>
                                <td width="270" style="vertical-align:middle; padding:0 0 0 10px; font-family:'Roboto', Arial !important;">
                                    <p style="font-size:16px; margin:0; color:#000; line-height:20px; font-family:'Roboto', Arial !important">
                                        <a href="https://www.chewy.com/dp/117261?utm_medium=email&amp;utm_source=transactional&amp;utm_campaign=OrderConfirmation" target="_blank" style="text-decoration:none; color:#000; outline:0;">
                                            {{ $order_detail->product->title }}
                                        </a>
                                    </p>
                                </td>
                                <td align="center" width="60" style="vertical-align:middle; font-family:'Roboto', Arial !important;padding:0;">
                                    <p style="font-size:18px; color:#000; margin:0; font-family:'Roboto', Arial !important;text-align:center;">
                                        {{ $order_detail->quantity }}
                                    </p>
                                </td>
                                <td align="center" width="80" style="font-family:'Roboto', Arial !important;padding:0 10px 0 0;">
                                    <p style="font-size:18px; color:#bc0101; margin:0; font-family:'Roboto', Arial !important;text-align:center;font-weight:bold;text-align: right;">
                                        Rs. {{ $order_detail->price }}
                                    </p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                @endforeach
                <!--<tr>-->
                <!--<td style=" font-family:'Roboto', Arial !important;padding:0;" align="center">-->
                <!--<table width="550" style="border-collapse:collapse;margin: 0 auto;border-bottom: 1px solid #EBEBEB">-->
                <!--<tbody>-->
                <!--<tr>-->
                <!--<td width="117" align="right" style="padding:24px 0 24px 10px; text-align:left;">-->
                <!--<a href="https://www.chewy.com/dp/117248?utm_medium=email&amp;utm_source=transactional&amp;utm_campaign=OrderConfirmation" target="_blank" style="text-decoration:none; color:#000; outline:0;">-->
                <!--<img src="https://img.chewy.com/is/catalog/89528_MAIN._AC_SS115_V1452725780_.jpg" border="0">-->
                <!--</a>-->
                <!--</td>-->
                <!--<td width="270" style="vertical-align:middle; padding:0 0 0 10px; font-family:'Roboto', Arial !important;">-->
                <!--<p style="font-size:16px; margin:0; color:#000; line-height:20px; font-family:'Roboto', Arial !important">-->
                <!--<a href="https://www.chewy.com/dp/117248?utm_medium=email&amp;utm_source=transactional&amp;utm_campaign=OrderConfirmation" target="_blank" style="text-decoration:none; color:#000; outline:0;">-->
                <!--Megageile Dinge, 120 St&uumlck-->
                <!--</a>-->
                <!--</p>-->
                <!--<p style="font-size:14px;font-weight:bold;font-family:'Roboto', Arial !important;padding:0; margin:10px 0 0px 0;">-->
                <!--<a href="https://www.chewy.com/dp/117248?utm_medium=email&amp;utm_source=transactional&amp;utm_campaign=OrderConfirmation" target="_blank" style="text-decoration:none; color:#000; outline:0;">-->
                <!--<img src="https://www.chewy.com/static/cms/lp/email/autoship_icon.png" border="0">-->
                <!--</a>-->
                <!--</p>-->
                <!--</td>-->
                <!--<td align="center" width="60" style="vertical-align:middle; font-family:'Roboto', Arial !important;padding:0;">-->
                <!--<p style="font-size:18px; color:#000; margin:0; font-family:'Roboto', Arial !important;text-align:center;">-->
                <!--1-->
                <!--</p>-->
                <!--</td>-->
                <!--<td align="center" width="80" style="font-family:'Roboto', Arial !important;padding:0 10px 0 0;">-->
                <!--<p style="font-size:18px; color:#000; margin:0; font-family:'Roboto', Arial !important;text-align:center;text-decoration:line-through;text-align: right;">-->
                <!--EUR4.99-->
                <!--</p>-->
                <!--<p style="font-size:18px; color:#bc0101; margin:0; font-family:'Roboto', Arial !important;text-align:center;font-weight:bold;text-align: right;">-->
                <!--EUR4.74-->
                <!--</p>-->
                <!--</td>-->
                <!--</tr>-->
                <!--</tbody>-->
                <!--</table>-->
                <!--</td>-->
                <!--</tr>-->

                <!--<tr>-->
                <!--<td style=" font-family:'Roboto', Arial !important;padding:0;" align="center">-->
                <!--<table width="550" style="border-collapse:collapse;margin: 0 auto;border-bottom: 1px solid #EBEBEB">-->
                <!--<tbody>-->
                <!--<tr>-->
                <!--<td width="117" align="right" style="padding:24px 0 24px 10px; text-align:left;">-->
                <!--<a href="https://www.chewy.com/dp/39491?utm_medium=email&amp;utm_source=transactional&amp;utm_campaign=OrderConfirmation" target="_blank" style="text-decoration:none; color:#000; outline:0;">-->
                <!--<img src="https://img.chewy.com/is/catalog/54378._AC_SS115_V1460478783_.jpg" border="0">-->
                <!--</a>-->
                <!--</td>-->
                <!--<td width="270" style="vertical-align:middle; padding:0 0 0 10px; font-family:'Roboto', Arial !important;">-->
                <!--<p style="font-size:16px; margin:0; color:#000; line-height:20px; font-family:'Roboto', Arial !important">-->
                <!--<a href="https://www.chewy.com/dp/39491?utm_medium=email&amp;utm_source=transactional&amp;utm_campaign=OrderConfirmation" target="_blank" style="text-decoration:none; color:#000; outline:0;">-->
                <!--Affengeile Dinge, 1 St&uumlck-->
                <!--</a>-->
                <!--</p>-->
                <!--</td>-->
                <!--<td align="center" width="60" style="vertical-align:middle; font-family:'Roboto', Arial !important;padding:0;">-->
                <!--<p style="font-size:18px; color:#000; margin:0; font-family:'Roboto', Arial !important;text-align:center;">-->
                <!--1-->
                <!--</p>-->
                <!--</td>-->
                <!--<td align="center" width="80" style="font-family:'Roboto', Arial !important;padding:0 10px 0 0;">-->
                <!--<p style="font-size:18px; color:#bc0101; margin:0; font-family:'Roboto', Arial !important;text-align:center;font-weight:bold;text-align: right;">-->
                <!--EUR4.99-->
                <!--</p>-->
                <!--</td>-->
                <!--</tr>-->
                <!--</tbody>-->
                <!--</table>-->
                <!--</td>-->
                <!--</tr>-->

                <hr>
                <tr>
                    <td align="center" style="padding-top:24px; padding-bottom:20px">
                        <table width="520" style="border-collapse:collapse">
                            <tbody>
                            <tr>



                            <tr>
                                <td align="right" style="padding-bottom:15px; font-family:'Roboto', Arial !important">
                                    <p style="font-size:18px; color:#000; font-weight:900; margin:0; font-family:'Roboto', Arial !important">
                                        Sum:
                                    </p>
                                </td>
                                <td align="right" style="padding-bottom:15px; font-family:'Roboto', Arial !important">
                                    <p style="font-size:18px; color:#bc0101; font-weight:bold; margin:0; font-family:'Roboto', Arial !important">
                                        {{ $content['order']->final_total }}
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
</body>