@extends('admin.layout.base')

@section('page-css')

@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
        <div class="row row-cards">
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card ">
                    <div class="card-body sales-relative">
                        <h5 class="text-muted">Total profit</h5>
                        <h1 class="text-success">$13,25,987</h1>
                        <a href="#" class="text-success border-bottom">View Statement</a>
                        <i class="fa fa-money fa-2x icon-absolute bg-success text-white" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card ">
                    <div class="card-body sales-relative">
                        <h5 class="text-muted">Balance Available</h5>
                        <h1 class="text-primary">$3,24,927</h1>
                        <a href="#" class="text-grey border-bottom">View Statement</a>
                        <i class="fa fa-credit-card-alt fa-2x icon-absolute bg-primary text-white" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card ">
                    <div class="card-body sales-relative">
                        <h5 class="text-muted">Today Income</h5>
                        <h1 class="text-info">$13,987</h1>
                        <a href="#" class="text-info border-bottom">View Statement</a>
                        <i class="fa fa-usd fa-2x icon-absolute bg-info text-white" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card ">
                    <div class="card-body sales-relative">
                        <h5 class="text-muted">Due Today</h5>
                        <h1 class="text-danger">$8,526</h1>
                        <a href="#" class="text-danger border-bottom">Pay Now</a>
                        <i class="fa fa-paper-plane fa-2x icon-absolute bg-danger text-white" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-deck">
            <div class="col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Sales</div>
                    </div>
                    <div class="card-body">
                        <div class="chats-wrap">
                            <div class="chat-details mb-2 p-3">
                                <h4 class="mb-0">
                                    <b>2,365</b>
                                    <span class="float-right p-1 bg-primary btn btn-sm text-white">
													<b>10</b>%</span>
                                </h4>
                                <p class="m-0">
                                    Total customers
                                    <small>This Year</small>
                                </p>
                            </div>
                            <div class="chat-details mb-2 p-3">
                                <h4 class="mb-0">
                                    <b>25,325</b>
                                    <span class="float-right p-1 bg-secondary  btn btn-sm text-white">
														<b>50</b>%</span>
                                </h4>
                                <p class="m-0">
                                    Total Sales
                                    <small>of This year</small>
                                </p>
                            </div>
                            <div class="chat-details mb-2 p-3">
                                <h4 class="mb-0">
                                    <b>80%</b>
                                    <span class="float-right p-1 bg-teal btn btn-sm text-white">
														<b>15%</b>
													</span>
                                </h4>
                                <p class="m-0">
                                    Business Growth
                                    <small>of This year</small>
                                </p>
                            </div>
                            <div class="chat-details p-3">
                                <h4 class="mb-0">
                                    <b>3,563</b>
                                    <span class="float-right p-1 btn btn-sm bg-danger text-white">
														<b>5%</b>
													</span>
                                </h4>
                                <p class="m-0">
                                    visit our site
                                    <small>daily</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="card ">
                    <div class="card-header">
                        <div class="card-title">Visitors List</div>
                    </div>
                    <div class="card-body">
                        <div class="visitor-list">
                            <div class="media m-0">
                                <div class="avatar brround avatar-md mr-3" style="background-image: url(../images/profile.jpg)"></div>
                                <div class="media-body">
                                    <a href="" class="text-default font-weight-medium">Tonia Rotella</a>
                                    <p class="text-muted ">Software Designer</p>
                                </div>
                                <!-- media-body -->
                                <a href="" class="btn btn-primary btn-sm mr-1">Add Friend</a>
                                <a href="" class="btn btn-danger btn-sm  d-none d-sm-block">Delete</a>
                            </div>
                            <!-- media -->
                            <div class="media mt-2 ">
                                <div class="avatar brround avatar-md mr-3" style="background-image: url(../images/profile.jpg)"></div>
                                <div class="media-body">
                                    <a href="" class="text-default font-weight-medium">Justin</a>
                                    <p class="text-muted">Sales Representative</p>
                                </div>
                                <!-- media-body -->
                                <a href="" class="btn btn-primary btn-sm mr-1">Add Friend</a>
                                <a href="" class="btn btn-danger btn-sm  d-none d-sm-block">Delete</a>
                            </div>
                            <!-- media -->
                            <div class="media mt-2 ">
                                <div class="avatar brround avatar-md mr-3" style="background-image: url(../images/profile.jpg)"></div>
                                <div class="media-body">
                                    <a href="" class="text-default font-weight-medium">Leo Amy</a>
                                    <p class="text-muted">Architect</p>
                                </div>
                                <!-- media-body -->
                                <a href="" class="btn btn-primary btn-sm mr-1">Add Friend</a>
                                <a href="" class="btn btn-danger btn-sm  d-none d-sm-block">Delete</a>
                            </div>
                            <!-- media -->
                            <div class="media mt-2">
                                <div class="avatar brround avatar-md mr-3" style="background-image: url(../images/profile.jpg)"></div>
                                <div class="media-body">
                                    <a href="" class="text-default font-weight-medium">Dyan Cullins</a>
                                    <p class="text-muted">Accountant</p>
                                </div>
                                <!-- media-body -->
                                <a href="" class="btn btn-primary btn-sm mr-1">Add Friend</a>
                                <a href="" class="btn btn-danger btn-sm  d-none d-sm-block">Delete</a>
                            </div>
                            <!-- media -->
                            <div class="media mt-2">
                                <div class="avatar brround avatar-md mr-3" style="background-image: url(../images/profile.jpg)"></div>
                                <div class="media-body">
                                    <a href="" class="text-default font-weight-medium" >Palmer Hoar</a>
                                    <p class="text-muted m-0">Marketing Manager</p>
                                </div>
                                <!-- media-body -->
                                <a href="" class="btn btn-primary btn-sm mr-1">Add Friend</a>
                                <a href="" class="btn btn-danger btn-sm  d-none d-sm-block">Delete</a>
                            </div>
                            <!-- media -->
                        </div>
                        <!-- media-list -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row mg-t-20">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title ">Clients feedback</h3>
                    </div>
                    <div class="">
                        <div class="table-responsive border-top">
                            <table class="table card-table table-striped table-vcenter text-nowrap">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th colspan="2">User</th>
                                    <th>Feed back</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>2345</td>
                                    <td><span class="avatar brround " style="background-image: url(../images/profile.jpg)"></span></td>
                                    <td>Megan Peters</td>
                                    <td>please check pricing Info </td>
                                    <td class="text-nowrap">July 13, 2018</td>
                                    <td class="w-1"><a href="#" class="icon"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>4562</td>
                                    <td><span class="avatar brround" style="background-image: url(../images/profile.jpg)"></span></td>
                                    <td>Phil Vance</td>
                                    <td>New stock</td>
                                    <td class="text-nowrap">June 15, 2018</td>
                                    <td><a href="#" class="icon"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>8765</td>
                                    <td><span class="avatar brround">AS</span></td>
                                    <td>Adam Sharp</td>
                                    <td>Daily updates</td>
                                    <td class="text-nowrap">July 8, 2018</td>
                                    <td><a href="#" class="icon"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>2665</td>
                                    <td><span class="avatar brround" style="background-image: url(../images/profile.jpg)"></span></td>
                                    <td>Samantha Slater</td>
                                    <td>available item list</td>
                                    <td class="text-nowrap">June 28, 2018</td>
                                    <td><a href="#" class="icon"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1245</td>
                                    <td><span class="avatar brround" style="background-image: url(../images/profile.jpg)"></span></td>
                                    <td>Joanne Nash</td>
                                    <td>Provide Best Services</td>
                                    <td class="text-nowrap">July 2, 2018</td>
                                    <td><a href="#" class="icon"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')

@endsection
