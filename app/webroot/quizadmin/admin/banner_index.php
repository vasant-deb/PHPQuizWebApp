<?php
include("../connection.php");
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
                                    <a href="dashboard.php" class="nav-link"><i class="fe fe-home"></i> Dashboard</a>
                                </li>
                                
                                <li class="nav-item dropdown">
                                    <a href="testimonial_index.php" class="nav-link"><i class="fe fe-check-square"></i> Testimonials</a>
                                </li>
								 <li class="nav-item">
                                    <a href="banner_index.php" class="nav-link active"><i class="fe fe-image"></i> Banners</a>
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
                   
                    <div class="row row-cards">
 
                     
                       <div class="col-12">
                            <div class="card">
                                <div class="card-header">
								 <h1 style="width:1000px;" class="page-title">
                            Banners
                        </h1>
                                    <a href="banner_add.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add Banner</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th class="w-1">No.</th>
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Created</th>
                                                <th>Status</th>
                                                <th></th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
$smwr=mysqli_query($con,"select * from banners");
$count_row=mysqli_num_rows($smwr);
$row=1;
while($row<=$count_row)
{
  $fetch_data=mysqli_fetch_array($smwr);
  extract($fetch_data);

?>
                                            <tr>
                                                <td><span class="text-muted"><?=$id;?></span></td>
                                                <td><?php echo  $heading;?></td>
                                                <td>
                                                    <img src="../images/main-slider/<?php echo $image;?>" width="100px" height="70px" alt="<?php echo $heading;?>" title="<?php echo $heading;?>">  
                                                </td>
                                              
                                                <td>
                                                    <?=$created_at?>
                                               
                                                <td>Active</td>
                                               
                                                <td>
                                                    <a class="icon" href="banner_view.php?con=<?= $id;?>">
                              <i class="fe fe-edit"></i>
                            </a>
                                                </td>
                                            </tr>
<?php
				$row++;
				}
            ?> 
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