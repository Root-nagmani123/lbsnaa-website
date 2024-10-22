@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row justify-content-center">
            <div class="col-lg-4 col-sm-6">
                <div class="stats-box card bg-white border-0 rounded-10 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-1">
                            <div class="flex-grow-1 me-3">
                                <h3 class="body-font fw-bold fs-3 mb-2">$25,890</h3>
                                <span>Total Sales</span>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="icon transition">
                                    <i class="flaticon-donut-chart"></i>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="svg-success me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-trending-up">
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                    <polyline points="17 6 23 6 23 12"></polyline>
                                </svg>
                            </div>
                            <p class="fw-semibold"><span class="text-success">1.3%</span> Up from past week
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="stats-box card bg-white border-0 rounded-10 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-1">
                            <div class="flex-grow-1 me-3">
                                <h3 class="body-font fw-bold fs-3 mb-2">$24,890</h3>
                                <span>Total Order</span>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="icon transition">
                                    <i class="flaticon-goal"></i>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="svg-danger me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-trending-down">
                                    <polyline points="23 18 13.5 8.5 8.5 13.5 1 6"></polyline>
                                    <polyline points="17 18 23 18 23 12"></polyline>
                                </svg>
                            </div>
                            <p class="fw-semibold"><span class="text-danger">1.3%</span> Down from past week
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="stats-box card bg-white border-0 rounded-10 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-1">
                            <div class="flex-grow-1 me-3">
                                <h3 class="body-font fw-bold fs-3 mb-2">183.35M</h3>
                                <span>Total Customers</span>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="icon transition">
                                    <i class="flaticon-award"></i>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="svg-success me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-trending-up">
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                    <polyline points="17 6 23 6 23 12"></polyline>
                                </svg>
                            </div>
                            <p class="fw-semibold"><span class="text-success">1.3%</span> Up from past week
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-bold fs-18 mb-0">Last Activity</h4>
                    <div class="dropdown action-opt">
                        <button class="btn bg-transparent p-0" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-more-horizontal">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="19" cy="12" r="1"></circle>
                                <circle cx="5" cy="12" r="1"></circle>
                            </svg>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                            <li>
                                <a class="dropdown-item" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-clock">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    Today
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-pie-chart">
                                        <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                                        <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                                    </svg>
                                    Last 7 Days
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-rotate-cw">
                                        <polyline points="23 4 23 10 17 10"></polyline>
                                        <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                                    </svg>
                                    Last Month
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-calendar">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    Last 12 Months
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-bar-chart">
                                        <line x1="12" y1="20" x2="12" y2="10"></line>
                                        <line x1="18" y1="20" x2="18" y2="4"></line>
                                        <line x1="6" y1="20" x2="6" y2="16"></line>
                                    </svg>
                                    All Time
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    View
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-trash">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                    </svg>
                                    Delete
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="default-table-area recent-orders">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-primary">Name</th>
                                    <th scope="col">Login Id</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">IP Adress</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-semibold">#SK258</td>
                                    <td>Colin Firth</td>
                                    <td>$289.50</td>
                                    <td>Boetic Fashion</td>
                                    <td>2024-12-19</td>
                                    <td>
                                        <span
                                            class="badge bg-primary bg-opacity-10 text-primary py-2 px-3 fw-semibold">Pending</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">#AA257</td>
                                    <td>Alina Smith</td>
                                    <td>$876.55</td>
                                    <td>Camera</td>
                                    <td>02-12-2024</td>
                                    <td>
                                        <span
                                            class="badge bg-danger bg-opacity-10 text-danger py-2 px-3 fw-semibold">Out
                                            of Stock</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">#BB256</td>
                                    <td>James Andy</td>
                                    <td>$654.76</td>
                                    <td>Wireless</td>
                                    <td>03-12-2024</td>
                                    <td>
                                        <span
                                            class="badge bg-success bg-opacity-10 text-success py-2 px-3 fw-semibold">Delivered</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">#CC255</td>
                                    <td>Sarah Taylor</td>
                                    <td>$654.99</td>
                                    <td>Jebble</td>
                                    <td>04-12-2024</td>
                                    <td>
                                        <span
                                            class="badge bg-primary bg-opacity-10 text-primary py-2 px-3 fw-semibold">Pending</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">#DD254</td>
                                    <td>David Warner</td>
                                    <td>$432.00</td>
                                    <td>Watch</td>
                                    <td>05-12-2024</td>
                                    <td>
                                        <span
                                            class="badge bg-success bg-opacity-10 text-success py-2 px-3 fw-semibold">Delivered</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-sm-flex justify-content-between align-items-center text-center">
                        <span class="fs-14">Showing 1 To 5 Of 20 Entries</span>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination mb-0 mt-3 mt-sm-0 justify-content-center">
                                <li class="page-item">
                                    <a class="page-link icon" href="index.html" aria-label="Previous">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-arrow-left">
                                            <line x1="19" y1="12" x2="5" y2="12"></line>
                                            <polyline points="12 19 5 12 12 5"></polyline>
                                        </svg>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link active" href="index.html">1</a></li>
                                <li class="page-item"><a class="page-link" href="index.html">2</a></li>
                                <li class="page-item"><a class="page-link" href="index.html">3</a></li>
                                <li class="page-item">
                                    <a class="page-link icon" href="index.html" aria-label="Next">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-arrow-right">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @endsection