<html>
    <head>
        <title>Employee Payslip</title>
        <style>
            .payslip-header {
                text-align: center;
                width: 100%;
            }
            .table-header {
                text-align: center;
                width: 100%;
            }
            .logo {
                width: 20%;
            }
            .company-info {
                width: 80%;
            }
            .logo, .company-info{
                border: 1px solid black;
            }
            .text-center{
                text-align: center;
            }

            .container {
                width: 100%;
                margin-top: 20px;
            }

            .sub-header {
                width: 100%;
            }

            .sub-header td {
                padding: 10px;
            }

            .background-gray {
                background-color: #e0e0e0;
            }

            .table-detail {
                width: 100%;
                border-collapse: collapse;
            }

            .table-detail th, .table-detail td {
                border: 1px solid black;
                padding: 10px;
            }

            .text-right {
                text-align: right;
            }

            .amount_col {
                width: 20%;
            }

        </style>
    </head>
    <body>
        <div class="payslip-header">
            <table class="table-header">
                <tr>
                    <td class="logo">
                        <?php
                            echo '<img src="data:image/png;base64,' . $logo_image . '" width="100px"/>';
                        ?>
                    </td>
                    <td class="company-info">
                        <h1 class="text-center">UPH</h1>
                        <span class="text-center">NIM  : 03081200004</span><br/>
                        <span class="text-center">NAMA : CARLOS</span><br/>
                        <span class="text-center">KELAS: 20SI2</span><br/>
                    </td>
                </tr>
            </table>
        </div>

        <div class="container">
            <table class="sub-header">
                <tr>
                    <td>
                        <span>Pay Period</span>
                        <span>:</span>
                        <span>{{ $payslip_data -> date_from }} to {{ $payslip_data -> date_to }}</span>
                    </td>
                    <td>
                        <span>Employee</span>
                        <span>:</span>
                        <span>{{ $payslip_data -> employee_name }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Work Day</span>
                        <span>:</span>
                        <span>{{ $payslip_detail['work_day'] }}</span>
                    </td>

                    <td>
                        <span>Bank Account</span>
                        <span>:</span>
                        <span>{{ $payslip_data -> bank_number }} ({{$payslip_data -> bank_name}})</span>
                    </td>
                </tr>
            </table>

            <table class="table table-detail">
                <tr>
                    <th class="background-gray">Salary Type</th>
                    <th class="background-gray amount_col">Amount</th>
                </tr>
                <tr>
                    <td>Basic Salary</td>
                    <td class="amount_col">{{$payslip_detail["currency"]}}{{ $payslip_detail['total_earned_wages'] }}</td>
                </tr>
                <tr>
                    <td>Transport Allowance</td>
                    <td class="amount_col">{{$payslip_detail["currency"]}}{{ $payslip_detail['transport'] }}</td>
                </tr>
                <tr>
                    <td>Meal Allowance</td>
                    <td class="amount_col">{{$payslip_detail["currency"]}}{{ $payslip_detail['food'] }}</td>
                </tr>
                <tr>
                    <td>Bonus</td>
                    <td class="amount_col">{{$payslip_detail["currency"]}}{{ $payslip_data -> bonus }}</td>
                </tr>
                <tr>
                    <td>Deduction</td>
                    <td class="amount_col">- {{$payslip_detail["currency"]}}{{ $payslip_data  -> deduction }}</td>
                </tr>
                <tr>
                    <td>Medical Bill</td>
                    <td class="amount_col">- {{$payslip_detail["currency"]}}{{ $payslip_detail['bpjs_cost'] }}</td>
                </tr>
                <tr>
                    <td>Pph 21</td>
                    <td class="amount_col">- {{$payslip_detail["currency"]}}{{ $payslip_detail['pph21'] }}</td>
                </tr>
                <tr>
                    <td class="text-right">Total</td>
                    <td class="amount_col">{{$payslip_detail["currency"]}}{{ $payslip_data -> total }}</td>
                </tr>
            </table>
        </div>

    </body>
</html>