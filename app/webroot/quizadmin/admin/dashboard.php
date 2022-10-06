<?php
include("function.php");
if(demo()==false)
{
   header("location:index.php");
}
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="vendor/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="vendor/favicon.ico" />
    <!-- Generated: 2019-04-04 16:55:45 +0200 -->
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="vendor/assets/js/require.min.js"></script>
    <script>
        requirejs.config({
            baseUrl: '.'
        });
    </script>
    <!-- Dashboard Core -->
    <link href="vendor/assets/css/dashboard.css" rel="stylesheet" />
    <script src="vendor/assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="vendor/assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="vendor/assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="vendor/assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="vendor/assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="vendor/assets/plugins/input-mask/plugin.js"></script>
    <!-- Datatables Plugin -->
    <script src="vendor/assets/plugins/datatables/plugin.js"></script>
</head>

<body class="">
    <div class="page">
        <div class="flex-fill">
            <div class="header py-4">
                <div class="container">
                    <div class="d-flex">
                         <a class="header-brand" href="dashboard.php">
                <img src="../images/logo.png" class="header-brand-img" alt="tabler logo">
              </a>
                        <div class="d-flex order-lg-2 ml-auto">
                            
                            <div class="dropdown">
                                <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar" style="background-image: url(./demo/faces/female/25.jpg)"></span>
                    <span class="ml-2 d-none d-lg-block">
                      <span class="text-default"><?php echo $_SESSION['name']; ?></span>
                      <small class="text-muted d-block mt-1">Administrator</small>
                    </span>
                  </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    
                                    <a class="dropdown-item" href="">
                      <i class="dropdown-icon fe fe-settings"></i> Settings
                    </a>
                                    
                                    
                                    <div class="dropdown-divider"></div>
                                   
                                    <a class="dropdown-item" href="logout.php">
                      <i class="dropdown-icon fe fe-log-out"></i> Sign out
                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
                    </div>
                </div>
            </div>
            <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
                <div class="container">
                    <div class="row align-items-center">
                        
                        <div class="col-lg order-lg-first">
                            <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                                <li class="nav-item">
                                    <a href="dashboard.php" class="nav-link active"><i class="fe fe-home"></i> Dashboard</a>
                                </li>
                                
                                <li class="nav-item dropdown">
                                    <a href="testimonial_index.php" class="nav-link"><i class="fe fe-check-square"></i> Testimonials</a>
                                </li>
								 <li class="nav-item">
                                    <a href="banner_index.php" class="nav-link"><i class="fe fe-image"></i> Banners</a>
                                </li>
                                <li class="nav-item">
                                    <a href="product_index.php" class="nav-link"><i class="fa fa-product-hunt"></i> Products</a>
                                </li>
                                <li class="nav-item">
                                    <a href="user_index.php" class="nav-link"><i class="fa fa-user"></i> Users</a>
                                </li>
								<li class="nav-item">
                                    <a href="blog_index.php" class="nav-link"><i class="fa fa-rss"></i> Blogs</a>
                                </li>
								<li class="nav-item">
                                    <a href="settting_index.php" class="nav-link"><i class="fa fa-cog"></i> Settings</a>
                                </li>
								<li class="nav-item">
                                    <a href="categories_index.php" class="nav-link"><i class="fe fe-file-text"></i> Categories</a>
                                </li>
								<li class="nav-item">
                                    <a href="enquiries_index.php" class="nav-link"><i class="fa fa-envelope"></i> Enquiries</a>
                                </li>
								<li class="nav-item">
                                    <a href="sitepage_index.php" class="nav-link"><i class="fa fa-sitemap"></i> Sitepages</a>
                                </li>
								<li class="nav-item">
                                    <a href="../" target="_blank" class="nav-link"><i class="fa fa-globe"></i> Website</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-3 my-md-5">
                <div class="container">
                    <div class="page-header">
                        <h1 class="page-title">
                            Dashboard
                        </h1>
                    </div>
                    <div class="row row-cards">
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="card">
                                <div class="card-body p-3 text-center">
                                    <div class="text-right text-green">
                                        6%
                                        <i class="fe fe-chevron-up"></i>
                                    </div>
                                    <div class="h1 m-0">43</div>
                                    <div class="text-muted mb-4">New Tickets</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="card">
                                <div class="card-body p-3 text-center">
                                    <div class="text-right text-red">
                                        -3%
                                        <i class="fe fe-chevron-down"></i>
                                    </div>
                                    <div class="h1 m-0">17</div>
                                    <div class="text-muted mb-4">Closed Today</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="card">
                                <div class="card-body p-3 text-center">
                                    <div class="text-right text-green">
                                        9%
                                        <i class="fe fe-chevron-up"></i>
                                    </div>
                                    <div class="h1 m-0">7</div>
                                    <div class="text-muted mb-4">New Replies</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="card">
                                <div class="card-body p-3 text-center">
                                    <div class="text-right text-green">
                                        3%
                                        <i class="fe fe-chevron-up"></i>
                                    </div>
                                    <div class="h1 m-0">27.3K</div>
                                    <div class="text-muted mb-4">Followers</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="card">
                                <div class="card-body p-3 text-center">
                                    <div class="text-right text-red">
                                        -2%
                                        <i class="fe fe-chevron-down"></i>
                                    </div>
                                    <div class="h1 m-0">$95</div>
                                    <div class="text-muted mb-4">Daily Earnings</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="card">
                                <div class="card-body p-3 text-center">
                                    <div class="text-right text-red">
                                        -1%
                                        <i class="fe fe-chevron-down"></i>
                                    </div>
                                    <div class="h1 m-0">621</div>
                                    <div class="text-muted mb-4">Products</div>
                                </div>
                            </div>
                        </div>
                       <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Invoices</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th class="w-1">No.</th>
                                                <th>Invoice Subject</th>
                                                <th>Client</th>
                                                <th>VAT No.</th>
                                                <th>Created</th>
                                                <th>Status</th>
                                                <th>Price</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span class="text-muted">001401</span></td>
                                                <td><a href="invoice.html" class="text-inherit">Design Works</a></td>
                                                <td>
                                                    Carlson Limited
                                                </td>
                                                <td>
                                                    87956621
                                                </td>
                                                <td>
                                                    15 Dec 2017
                                                </td>
                                                <td>
                                                    <span class="status-icon bg-success"></span> Paid
                                                </td>
                                                <td>$887</td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-muted">001402</span></td>
                                                <td><a href="invoice.html" class="text-inherit">UX Wireframes</a></td>
                                                <td>
                                                    Adobe
                                                </td>
                                                <td>
                                                    87956421
                                                </td>
                                                <td>
                                                    12 Apr 2017
                                                </td>
                                                <td>
                                                    <span class="status-icon bg-warning"></span> Pending
                                                </td>
                                                <td>$1200</td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-muted">001403</span></td>
                                                <td><a href="invoice.html" class="text-inherit">New Dashboard</a></td>
                                                <td>
                                                    Bluewolf
                                                </td>
                                                <td>
                                                    87952621
                                                </td>
                                                <td>
                                                    23 Oct 2017
                                                </td>
                                                <td>
                                                    <span class="status-icon bg-warning"></span> Pending
                                                </td>
                                                <td>$534</td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-muted">001404</span></td>
                                                <td><a href="invoice.html" class="text-inherit">Landing Page</a></td>
                                                <td>
                                                    Salesforce
                                                </td>
                                                <td>
                                                    87953421
                                                </td>
                                                <td>
                                                    2 Sep 2017
                                                </td>
                                                <td>
                                                    <span class="status-icon bg-secondary"></span> Due in 2 Weeks
                                                </td>
                                                <td>$1500</td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-muted">001405</span></td>
                                                <td><a href="invoice.html" class="text-inherit">Marketing Templates</a></td>
                                                <td>
                                                    Printic
                                                </td>
                                                <td>
                                                    87956621
                                                </td>
                                                <td>
                                                    29 Jan 2018
                                                </td>
                                                <td>
                                                    <span class="status-icon bg-danger"></span> Paid Today
                                                </td>
                                                <td>$648</td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-muted">001406</span></td>
                                                <td><a href="invoice.html" class="text-inherit">Sales Presentation</a></td>
                                                <td>
                                                    Tabdaq
                                                </td>
                                                <td>
                                                    87956621
                                                </td>
                                                <td>
                                                    4 Feb 2018
                                                </td>
                                                <td>
                                                    <span class="status-icon bg-secondary"></span> Due in 3 Weeks
                                                </td>
                                                <td>$300</td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-muted">001407</span></td>
                                                <td><a href="invoice.html" class="text-inherit">Logo & Print</a></td>
                                                <td>
                                                    Apple
                                                </td>
                                                <td>
                                                    87956621
                                                </td>
                                                <td>
                                                    22 Mar 2018
                                                </td>
                                                <td>
                                                    <span class="status-icon bg-success"></span> Paid Today
                                                </td>
                                                <td>$2500</td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-muted">001408</span></td>
                                                <td><a href="invoice.html" class="text-inherit">Icons</a></td>
                                                <td>
                                                    Tookapic
                                                </td>
                                                <td>
                                                    87956621
                                                </td>
                                                <td>
                                                    13 May 2018
                                                </td>
                                                <td>
                                                    <span class="status-icon bg-success"></span> Paid Today
                                                </td>
                                                <td>$940</td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-muted">001409</span></td>
                                                <td><a href="invoice.html" class="text-inherit">Design Works</a></td>
                                                <td>
                                                    Carlson Limited
                                                </td>
                                                <td>
                                                    87956621
                                                </td>
                                                <td>
                                                    15 Dec 2017
                                                </td>
                                                <td>
                                                    <span class="status-icon bg-success"></span> Paid
                                                </td>
                                                <td>$887</td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-muted">001410</span></td>
                                                <td><a href="invoice.html" class="text-inherit">UX Wireframes</a></td>
                                                <td>
                                                    Adobe
                                                </td>
                                                <td>
                                                    87956421
                                                </td>
                                                <td>
                                                    12 Apr 2017
                                                </td>
                                                <td>
                                                    <span class="status-icon bg-warning"></span> Pending
                                                </td>
                                                <td>$1200</td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-muted">001411</span></td>
                                                <td><a href="invoice.html" class="text-inherit">New Dashboard</a></td>
                                                <td>
                                                    Bluewolf
                                                </td>
                                                <td>
                                                    87952621
                                                </td>
                                                <td>
                                                    23 Oct 2017
                                                </td>
                                                <td>
                                                    <span class="status-icon bg-warning"></span> Pending
                                                </td>
                                                <td>$534</td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-muted">001412</span></td>
                                                <td><a href="invoice.html" class="text-inherit">Landing Page</a></td>
                                                <td>
                                                    Salesforce
                                                </td>
                                                <td>
                                                    87953421
                                                </td>
                                                <td>
                                                    2 Sep 2017
                                                </td>
                                                <td>
                                                    <span class="status-icon bg-secondary"></span> Due in 2 Weeks
                                                </td>
                                                <td>$1500</td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-muted">001413</span></td>
                                                <td><a href="invoice.html" class="text-inherit">Marketing Templates</a></td>
                                                <td>
                                                    Printic
                                                </td>
                                                <td>
                                                    87956621
                                                </td>
                                                <td>
                                                    29 Jan 2018
                                                </td>
                                                <td>
                                                    <span class="status-icon bg-danger"></span> Paid Today
                                                </td>
                                                <td>$648</td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-muted">001414</span></td>
                                                <td><a href="invoice.html" class="text-inherit">Sales Presentation</a></td>
                                                <td>
                                                    Tabdaq
                                                </td>
                                                <td>
                                                    87956621
                                                </td>
                                                <td>
                                                    4 Feb 2018
                                                </td>
                                                <td>
                                                    <span class="status-icon bg-secondary"></span> Due in 3 Weeks
                                                </td>
                                                <td>$300</td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-muted">001415</span></td>
                                                <td><a href="invoice.html" class="text-inherit">Logo & Print</a></td>
                                                <td>
                                                    Apple
                                                </td>
                                                <td>
                                                    87956621
                                                </td>
                                                <td>
                                                    22 Mar 2018
                                                </td>
                                                <td>
                                                    <span class="status-icon bg-success"></span> Paid Today
                                                </td>
                                                <td>$2500</td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-muted">001416</span></td>
                                                <td><a href="invoice.html" class="text-inherit">Icons</a></td>
                                                <td>
                                                    Tookapic
                                                </td>
                                                <td>
                                                    87956621
                                                </td>
                                                <td>
                                                    13 May 2018
                                                </td>
                                                <td>
                                                    <span class="status-icon bg-success"></span> Paid Today
                                                </td>
                                                <td>$940</td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <script>
                                        require(['datatables', 'jquery'], function(datatable, $) {
                                            $('.datatable').DataTable();
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    
                            
                        </div>
                    </div>
                    
                    
                </div>
               
               
            </div>
       
        
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                  
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                        Copyright © 2019 
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>