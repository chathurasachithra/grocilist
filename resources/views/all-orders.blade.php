<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .currency-container {
            text-align: right;
        }
    </style>

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Admin Panel</a>
        </div>
        <!-- /.navbar-header -->


        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li>
                        <a href="#"><i class="fa fa-dashboard fa-fw"></i> All orders</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">All orders</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Order delivery and item details
                    </div>
                    <!-- /.panel-heading -->

                    @if (count($orders) > 0)
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                {{--<tr>--}}
                                    {{--<th>--}}
                                        {{--<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th width="10">ID</th>--}}
                                                {{--<th width="15">Name</th>--}}
                                                {{--<th width="15" align="right" class="currency-container">Total</th>--}}
                                                {{--<th width="15">Mobile</th>--}}
                                                {{--<th width="15">Address</th>--}}
                                                {{--<th width="15">Time slot</th>--}}
                                                {{--<th width="15">Instructions</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                        {{--</table>--}}
                                    {{--</th>--}}
                                {{--</tr>--}}
                                </thead>
                                <tbody>


                                @foreach($orders as $order)
                                    <tr class="odd gradeX">
                                        <td>
                                            <a href="#demo-{{$order->id}}" data-toggle="collapse">

                                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                    <thead>
                                                    <tr>
                                                        <th width="10" title="Order ID">{{$order->id}}</th>
                                                        <th width="15" title="Order owner name">{{$order->name}}</th>
                                                        <th width="15" title="Order total"  align="right"  class="currency-container">{{number_format($order->total, 2)}}</th>
                                                        <th width="15" title="Mobile number">{{$order->mobile}}</th>
                                                        <th width="15" title="Address">{{$order->address}}</th>
                                                        <th width="15" title="Time slot">{{$order->time_slot}}</th>
                                                        <th width="15" title="Instructions">{{$order->instructions}}</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </a>

                                            <div id="demo-{{$order->id}}" class="collapse">

                                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                    <thead>
                                                    <tr>
                                                        <th>Item</th>
                                                        <th class="currency-container">Unit price</th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order->orderDetails as $orderDetail)
                                                        <tr class="odd gradeX">
                                                            <td>{{$orderDetail->item->name}}</td>
                                                            <td class="currency-container">{{number_format($orderDetail->unit_price, 2)}}</td>
                                                            <td>{{$orderDetail->quantity}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            {{ $orders->links() }}
                        </div>
                        <!-- /.panel-body -->


                    @else
                        <div class="panel-body">
                            <p>No orders found</p>
                        </div>
                    @endif
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>


</body>

</html>
