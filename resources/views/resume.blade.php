
<!DOCTYPE html>
<html lang="en" ng-app="jobPortalApp">

<head>
    <meta charset="UTF-8">
    <title>Resource Input Ltd - Recruitment - Job Search - Employment - Job Vacancies</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Have You Been Searching for attractive job offers everywhere?, but could not find one that is suitable for your skills? Look into our portal to instantly connect with the hottest jobs in the market such as technology jobs, freshers jobs, marketing jobs in India, Sales Jobs, Government Jobs, constructions jobs, IT Jobs etc. We bring you the best employment offers out there, through our huge networking web, we help you find the right job. Our site has a large number of job categories from which you can find an offer that matches with your skills. The site’s search facility will help you quickly zero-in on what is you need. Employers who are searching for talented professionals, will also find our database of candidates both exhaustive and extensive. You can easily find a suitable candidate from us, enabling you to easily find professionals who will help to grow and enhance your organization. We have separate site sections for both employees and employers, each catered to the individual needs. Signing up in the relevant category is easy, begin your search and find the best match. The site shows the latest job offers trending in the market, giving you access to what are the latest and most sought after skills in any specific industry. We have placed candidates in top companies in various industries and those seeking for a good job offer have various options to choose from and fulfill their dream of being placed in top companies across the country. Join now to get an attractive pay scale and a refreshing and competitive environment to grow, learn and enhance your career prospects." />
    <meta name="keywords" content="India jobs, technology jobs, Freshers jobs, marketing jobs India, constructions jobs, Sales Jobs, Government Jobs, HR Jobs, Jobs in Delhi, Jobs in Mumbai, Jobs in Bengaluru, Jobs in Kolkata, Jobs in Hyderabad, Jobs in Chennai, IT Jobs" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/rzslider.css">
    <link rel="stylesheet" type="text/css" href="css/select.css">
    <link id="main" rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/icons.css">
    <link rel="stylesheet" type="text/css" href="css/owl.css">
    <link rel="stylesheet" type="text/css" href="css/prettyPhoto.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link href="css/animate.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="img/favico.png" />
</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-ellipsis-v"></i>
            </button>
            <a class="navbar-brand" href="#"><img src="img/logo.png" alt="Resource Inputs Ltd"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right" ng-controller="NavigationCtrl">
                <li ng-class="{ active: isCurrentPath('/home') }"><a href="#/home">Home</a></li>
                <li ng-class="{ active: isCurrentPath('/searchjob') }">
                    <a href="#/searchjob">Search Jobs</a>
                </li>

                <li ng-class="{ active: isCurrentPath('/trackob')}">
                    <a href="#/trackob">Track Job Status</a>
                </li>
                <!--<li ng-class="{ active: isCurrentPath('/signup')}">
                    <a href="#/signup"><i class="fa fa-lock"></i> Sign Up</a>
                </li>-->
                <li ng-class="{ active: isCurrentPath('/login') }">
                    <a href="#/login">Candidate Login</a>
                </li>
                <li ng-class="{ active: isCurrentPath('/rlogin') }">
                    <a href="#/rlogin">Recruiters Login</a>
                </li>
                <li ng-class="{ active: isCurrentPath('/adminLogin') }">
                    <a href="#/adminLogin">Admin Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div>
    <route-loading-indicator></route-loading-indicator>
    <div ng-if='!isRouteLoading' ng-view>

    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <img src="img/logo_white.png" class="logo-white" alt="">
                <p>Resource Inputs Ltd. have carved a niche for ourselves with our distinctive assortment of services where in we bring together all people issues ranging from complex Labour Laws & IR to our every day HR. </p>
                <div class="social">
                    <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="dribbble"><i class="fa fa-dribbble"></i></a>
                    <a href="#" class="vine"><i class="fa fa-vine"></i></a>
                    <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                </div>
                <figure class="appdownload"><img src="img/appdownload.jpg" /> </figure>
            </div>
            <div class="col-md-4 col-sm-6 text-left">
                <h4 class="heading no-margin">Sitemap</h4>
                <hr class="blue">
                <div class="col-md-6 no-padding">
                    <a href="#">About Us</a>
                    <a href="#">Company Profile</a>
                    <a href="#">Contact Sales</a>
                    <a href="#">Work at Resource Inputs</a>
                    <a href="#">Terms and Conditions</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Contact Us</a>
                </div>
                <div class="col-md-6 no-padding">
                    <a href="#">News</a>
                    <a href="#">Browse Jobs</a>
                    <a href="#">Candidate Signup</a>
                    <a href="#">Employer Signup</a>
                    <a href="#">Attractive Employers</a>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 text-left newsletter-form">
                <h4 class="heading no-margin">Sign up for our newsletter</h4>
                <hr class="blue">
                <p>Job Searching Just Got Easy. Use Resource Inputs Ltd. to search for your dream job. Subscribe to our newsletter.</p>
                <form>
                    <input type="text" class="form-control" placeholder="Enter your email">
                    <button type="button" class="btn blue no-margin">Subscribe now!</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row bottom no-padding no-margin">
        <div class="container">
            <div class="col-md-12 no-padding text-center column-bottom">
                <p>Copyright &copy; 2016 <span class="blue-color">Resource Inputs Ltd</span> | All right reserved</p>
            </div>
        </div>
    </div>
</footer>


<script src="js/vendor-all.js"></script>
<script src="js/angular-route.js"></script>
<script src="js/angular-animate.js"></script>
<script src="js/ui-bootstrap-tpls-2.1.4.js"></script>
<script src="js/smoothWheel.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/images-loaded.js"></script>
<script src="js/jquery.count.js"></script>
<script src="js/knobify.js"></script>
<script src="js/isotope.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/rzslider.js"></script>
<script src="js/select.min.js"></script>
<script src="js/select-tpls.min.js"></script>
<script src="js/main.js"></script>
</body>

</html>
