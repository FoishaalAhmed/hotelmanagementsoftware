

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hotel Software</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="shortcut icon" href="{{asset('public/images/fav.jpg')}}">
        <style>
            .table td, .table th {
            padding: 0rem; 
            }
        </style>
    </head>
    <body onload="window.print()">
        <div class="container">
            <div class="box" style="border: 1px solid black;" >
                <h2 style="text-align: center; font-weight: 700; " >
                    Salary Sheet 
                </h2>
                <p style="margin: 0px; text-align: center;font-weight: 700;" >Month of {{$month}} - {{date('Y')}}</p>
            </div>
        </div>
        <br>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <p> <span style="font-weight: 800;">Name :</span> <span>{{$employee_info->name}}</span> </p>
                        <p style="margin: 0px; margin-right: 150px; " ><span>ID No :</span> {{$employee_info->employee_id}} </p>
                        <p style="margin: 0px; margin-right: 150px; " ><span>Section :</span> {{$department}} </p>
                    </div>
                    <!---<div class="col-md-5" style="float: right; text-align: right; " >
                        <p > <span style="font-weight: 800;">Refarence :</span> <span> Jafor Ahammed </span> </p>
                        <p style="margin: 0px; margin-right: 150px; " ><span>Contract :</span>  </p>
                        <p style="margin: 0px; margin-right: 150px; " > <span>Mobile :</span> </p>
                        <p style="margin: 0px; margin-right: 150px; " >Address :</p>
                        </div> ---->
                </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Date :</th>
                        <th scope="col">In Time</th>
                        <th scope="col">Out Time</th>
                        <th scope="col">Late</th>
                        <th scope="col">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $item)
                    <tr>
                        <th scope="row">{{date('d M, Y', strtotime($item->date))}}</th>
                        <td>{{$item->in_time}}</td>
                        <td>{{$item->out_time}}</td>
                        <td>{{$item->late_time}} </td>
                        <td> {{$item->remarks}} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p> Absent Of This Month : <span>{{$salary->absent}}</span><span>Days</span></p>
                    <p> Total Late Of This Month : <span>{{$salary->late}}</span><span>Days</span></p>
                    <p> Leaves Of This Month : <span>{{$salary->leave_days}}</span><span>Days</span></p>
                    <p> Total Attendanse Of This Month : <span>{{$salary->present}}</span><span>Days</span></p>
                </div>
                <div class="col-md-6">
                    <p> Take Lone/Advance Of This Month : <span>{{$loan_advances}}</span> &nbsp; <span>/=</span></p>
                    <p> Late Fine Of This Month : <span>{{$salary->late_fine}}</span> &nbsp; <span>/=</span></p>
                    <p> Gross Salary : <span>{{$employee_info->salary}}</span> &nbsp; <span>/=</span></p>
                    <p> Rady to Pay : <span>{{$salary->amount}}</span> &nbsp; <span>/=</span></p>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top: 100px;">
            <div class="row">
                <div class="col-md-4">
                    Employee Signature
                </div>
                <div class="col-md-4" style="text-align: center">
                    Accountant Signature
                </div>
                <div class="col-md-4" style="text-align: right">
                    CEO Signature
                </div>
            </div>
        </div>
        <br><br><br>
        <div class="container-fluid" style="width: 95%;">
            <div class="row">
                <div class="col-md-6">
                    Copyright & rights reserved by_ <a href="#">© Blue_Dream</a>
                </div>
                <div class="col-md-6" style="text-align: end;" >
                    © Design And Developed By_ <a href="https://ictbanglabd.com" target="_blank">ictbanglabd.com</a>
                </div>
            </div>
            <br>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>

