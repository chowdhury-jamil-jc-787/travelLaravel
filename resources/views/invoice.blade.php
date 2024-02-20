<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        margin: 20px;
        font-size: 12px;
      }
      .logo{
        position: absolute;
        width: 130px;
        margin-top: -10px;
      }
      .logo img{
        width: 100%;
        height: 100%;
      }
      .header-text {
        text-align: center;
        color: rgba(100, 100, 200);
      }
      .underline {
        width: 100%;
        height: 3px;
        background-color: rgba(100, 100, 200);
      }

      .section-1 {
        /* padding: 20px; */
        margin-top: 40px;
        display: flex;
        justify-content: space-between;
      }

      .header p:nth-child(1) {
        margin: 0;
        font-size: 18px;
        font-weight: bold;
      }
      .bill-to {
        width: 33%;
        /* background-color: blue; */
      }
      .bill-to p {
        width: flex-1;
        margin: 0;
        font-weight: bold;
        padding: 5px 10px;
        background-color: rgba(100, 100, 200, 0.4);
      }
      .section-2 {
        margin-top: 20px;
      }
      .section-2 table th {
        background-color: rgba(100, 100, 200, 0.4);
      }
      .section-2 table,
      .section-1 table {
        width: 100%;
        border-collapse: collapse;
      }
      .section-2 th,
      .section-2 td,
      .section-1 th,
      .section-1 td {
        border: 1px solid #ccc;
        padding: 5px;
        text-align: left;
      }
      .invoice-details {
        width: 33%;
      }
      .travel-details {
        margin-top: 10px;
      }
      .invoice-no table th,
      .travel-details table th {
        background-color: rgba(100, 100, 200, 0.4);
      }
      .sec-table {
        margin-top: 10px;
      }
    </style>
  </head>
  <body>
    <div class="logo">
        <img src="/frontend/assets/images/logo-go-lombok____.png" alt="logo" />
    </div>
    <h1 class="header-text">TRAVEL AGENCY INVOICE</h1>
    <div class="underline"></div>
    <div class="section-1">
      <div class="header">
        <p>Travel Agency Name</p>
        <p>Street Address</p>
        <p>City, State ZIP Code</p>
        <p>Phone</p>
        <p>Website Address</p>
      </div>
      <div class="bill-to">
        <p>Bill To:</p>
        <table>
          <tr>
            <th>Name:</th>
            <td>{{ $name }}</td>
          </tr>
          <tr>
            <th>Address:</th>
            <td>{{ $address }}</td>
          </tr>
          <tr>
            <th>Email:</th>
            <td>{{ $email }}</td>
          </tr>
          <tr>
            <th>Phone:</th>
            <td>{{ $phone }}</td>
          </tr>
        </table>
      </div>
      <div class="invoice-details">
        <div class="invoice-no">
          <table>
            <tr>
              <th>Invoice No:</th>
              <td>INV-456-004</td>
            </tr>
          </table>
          <table class="sec-table">
            <tr>
              <th>Invoice Date:</th>
              <td><?php echo date('d-M-Y'); ?></td>
            </tr>
          </table>
        </div>
        <div class="travel-details">
          <table>
            <tr>
              <th>Destination:</th>
              <td>{{ $travelPackage->location }}</td>
            </tr>
            <tr>
              <th>Travel Date:</th>
              <td><?php echo date('d-M-Y'); ?></td>
            </tr>
            <tr>
              <th>No. of travelers:</th>
              <td>2</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="section-2">
        <table>
            <tr>
                <th>Package</th>
                <th>Transport</th>
                <th>Package Price</th>
                <th>Transport Cost</th>
                <th>Total</th>
            </tr>
            @if(isset($travelPackage) && isset($car))
                <tr>
                    <td>{{ $travelPackage->name }}</td>
                    <td>{{ $car->name }}</td>
                    <td>{{ $travelPackage->price }}</td>
                    <td>{{ $car->price }}</td>
                    <td>{{ $travelPackage->price + $car->price }}</td>
                </tr>
            @elseif(isset($travelPackage) && is_null($car))
                <tr>
                    <td>{{ $travelPackage->name }}</td>
                    <td>0</td>
                    <td>{{ $travelPackage->price }}</td>
                    <td>0</td>
                    <td>{{ $travelPackage->price }}</td>
                </tr>
            @endif
            <tr style="font-weight: bold;">
                <td colspan="4" style="text-align:right;">Subtotal</td>
                <td>
                    @if(isset($travelPackage) && isset($car))
                        {{ $travelPackage->price + $car->price }}
                    @elseif(isset($travelPackage) && is_null($car))
                        {{ $travelPackage->price }}
                    @else
                        $0
                    @endif
                </td>
            </tr>
        </table>
    </div>



    </div>
  </body>
</html>
