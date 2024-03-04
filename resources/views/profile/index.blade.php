<!-- resources/views/profile/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h3 class="text-center">Profile Page</h3>

    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4 mb-sm-5">
                    <div class="card card-style1 border-0">
                        <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-4 mb-lg-0">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="...">
                                </div>
                                <div class="col-lg-6 px-xl-10">
                                    <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                                        <h3 class="h2 text-white mb-0">John mark Doe Kyzer</h3>
                                        <span class="text-primary">Coach</span>
                                    </div>
                                    <ul class="list-unstyled mb-1-9">
                                        <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Position:</span> Coach</li>
                                        <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Experience:</span> 10 Years</li>
                                        <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Email:</span> edith@mail.com</li>
                                        <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Website:</span> www.example.com</li>
                                        <li class="display-28"><span class="display-26 text-secondary me-2 font-weight-600">Phone:</span> 507 - 541 - 4567</li>
                                    </ul>
                                    <ul class="social-icon-style1 list-unstyled mb-0 ps-0">
                                        <li><a href="#!"><i class="ti-twitter-alt"></i></a></li>
                                        <li><a href="#!"><i class="ti-facebook"></i></a></li>
                                        <li><a href="#!"><i class="ti-pinterest"></i></a></li>
                                        <li><a href="#!"><i class="ti-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </section>
<br>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<div class="container">
    <div class="row">
        <div class="col-12 mb-3 mb-lg-5">
            <div class="position-relative card table-nowrap table-card">
                <div class="card-header align-items-center">
                    <h5 class="mb-0">Latest Transactions</h5>
                    <p class="mb-0 small text-muted">1 Pending</p>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="small text-uppercase bg-body text-muted">
                            <tr>
                                <th>Transaction ID</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="align-middle">
                                <td>
                                    #57473829
                                </td>
                                <td>13 Sep, 2021</td>
                                <td>Renee Sims</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span><i class="fa fa-arrow-up" aria-hidden="true"></i></span>
                                        <span>$145</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge fs-6 fw-normal bg-tint-success text-success">Completed</span>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <td>
                                    #012458780
                                </td>
                                <td>19 Aug, 2021</td>
                                <td>Edith Koenig</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span><i class="fa fa-arrow-down" aria-hidden="true"></i></span>
                                        <span>$641.64</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge fs-6 fw-normal bg-tint-warning text-warning">Pending</span>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <td>
                                    #76444326
                                </td>
                                <td>03 April, 2021</td>
                                <td>Carrie Blount</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span><i class="fa fa-arrow-down" aria-hidden="true"></i></span>
                                        <span>$12,457</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge fs-6 fw-normal bg-tint-success text-success">Completed</span>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <td>
                                    #12498745
                                </td>
                                <td>15 March, 2021</td>
                                <td>Ander Durham</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span><i class="fa fa-arrow-down" aria-hidden="true"></i></span>
                                        <span>$785</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge fs-6 fw-normal bg-tint-success text-success">Completed</span>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <td>
                                    #87444654
                                </td>
                                <td>23 Jan, 2021</td>
                                <td>Netflix Inc.</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span><i class="fa fa-arrow-up" aria-hidden="true"></i></span>
                                        <span>$199</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge fs-6 fw-normal bg-tint-success text-success">Completed</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">
                    <a href="#!" class="btn btn-gray">View All Transactions</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
