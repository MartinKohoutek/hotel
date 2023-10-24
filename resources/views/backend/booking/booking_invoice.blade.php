<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .font {
            font-size: 15px;
        }

        .authority {
            /*text-align: center;*/
            float: right
        }

        .authority h5 {
            margin-top: -10px;
            color: green;
            /*text-align: center;*/
            margin-left: 35px;
        }

        .thanks p {
            color: green;
            ;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
    </style>

</head>

<body>

    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top">
                <!-- {{-- <img src="" alt="" width="150"/> --}} -->
                <h2 style="color: green; font-size: 26px;"><strong>CheapHotel</strong></h2>
            </td>
            <td align="right">
                <pre class="font">
               CheapHotel Head Office
               Email:support@cheaphotel.com <br>
               Mob: 732 561 453 <br>
               Praha 7, U stadionu 127 <br>
            </pre>
            </td>
        </tr>
    </table>

    <table width="100%" style="background:white; padding:2px;"></table>
    <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
        <thead>
            <tr>
                <th>Room Type</th>
                <th>Number of Rooms</th>
                <th>Price</th>
                <th>Check In/Out Date</th>
                <th>Total Nights</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $booking['room']['roomtype']['name'] }}</td>
                <td style="text-align: right;">{{ $booking->number_of_rooms }}</td>
                <td>${{ $booking->actual_price }}</td>
                <td>
                    <span>{{ $booking->check_in }}</span> -
                    <span>{{ $booking->check_out }}</span>
                </td>
                <td style="text-align: right;">{{ $booking->total_night }}</td>
                <td>${{ $booking->actual_price * $booking->total_night }}</td>
            </tr>
        </tbody>
    </table>
    <br />
    <table class="table table-bordered test_table" style="float: left; background: #F7F7F7; width: 100%;">
        <tr>
            <th style="text-align: left;">Subtotal</th>
            <td style="text-align: left;">${{ $booking->subtotal }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Discount</th>
            <td style="text-align: left;">- ${{ $booking->discount }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Total Price</th>
            <td style="text-align: left;">${{ $booking->total_price }}</td>
        </tr>
    </table>
    <table class="table test_table" style="float:right; border:none"></table>

    <div class="thanks mt-3">
        <p>Thanks For Your Booking..!!</p>
    </div>
    <div class="authority float-right mt-5">
        <p>-----------------------------------</p>
        <h5>Authority Signature:</h5>
    </div>
</body>

</html>