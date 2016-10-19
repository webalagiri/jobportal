var adminApp = angular.module("jobPortalAdmin", ["ngRoute", "angular.chips", 'ui.bootstrap', "oi.select", "rzModule"]);

adminApp.config(function ($routeProvider) {
    $routeProvider
        .when("/", {
            templateUrl: "pages/dashboard.html",
            controller: "dashboardCtrl"
        })
        .when("/dashboard", {
            templateUrl: "pages/dashboard.html",
            controller: "dashboardCtrl"
        })
        .when("/jobs", {
            templateUrl: "pages/jobsList.html",
            controller: "jobsListCtrl"
        })
        .when("/company", {
            templateUrl: "pages/company.html",
            controller: "companyCtrl"
        })
        .when("/candidates", {
            templateUrl: "pages/candidates.html",
            controller: "candidateCtrl"
        })
        .when("/profileList", {
            templateUrl: "pages/profileList.html",
            controller: "profileListCtrl"
        })
        .when("/viewProfile", {
            templateUrl: "pages/viewProfile.html",
            controller: "viewProfileCtrl"
        })
        .when("/addIndustry", {
            templateUrl: "pages/addIndustry.html",
            controller: "addIndustryCtrl"
        })
        .when("/addFunctional", {
            templateUrl: "pages/addFunctional.html",
            controller: "addFunctionalCtrl"
        })
        .when("/manageInterview", {
            templateUrl: "pages/manageInterview.html",
            controller: "manageInterviewCtrl"
        })
        .when("/trackInterview", {
            templateUrl: "pages/trackInterview.html",
            controller: "trackInterviewCtrl"
        })
        .when("/cDashboard", {
            templateUrl: "pages/cDashboard.html",
            controller: "dashboardCtrl"
        })
        .when("/cJobs", {
            templateUrl: "pages/jobsList.html",
            controller: "cJobsListCtrl"
        })
        .when("/advacedResumeSearch", {
            templateUrl: "pages/advancedResumeSearch.html",
            controller: "advancedResumeSearchCtrl"
        })
        .otherwise({
            template: "pages/dashboard.html",
            controller: "dashboardCtrl"
        });
});

adminApp.directive('a', function () {
    return {
        restrict: 'E',
        link: function (scope, elem, attrs) {
            if (attrs.ngClick || attrs.href === '' || attrs.href === '#') {
                elem.on('click', function (e) {
                    e.preventDefault();
                });
            }
        }
    };
}).directive('routeLoadingIndicator', function ($rootScope) {
    return {
        restrict: 'E',
        template: "<h1 ng-if='isRouteLoading'>Loading...</h1>",
        link: function (scope, elem, attrs) {
            scope.isRouteLoading = false;

            $rootScope.$on('$routeChangeStart', function () {
                scope.isRouteLoading = true;
            });

            $rootScope.$on('$routeChangeSuccess', function () {
                scope.isRouteLoading = false;
            });
        }
    };
});

adminApp.controller('topNavigationCtrl', ['$scope', '$location', function ($scope, $location) {
    $scope.isCurrentPath = function (path) {
        return $location.path() == path;
    };
    $scope.status = {
        isopen: false
    };
    $scope.toggled = function (open) {
        $log.log('Dropdown is now: ', open);
    };
    $scope.toggleDropdown = function ($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.status.isopen = !$scope.status.isopen;
    };
}]);
adminApp.controller('LeftNavigationCtrl', ['$scope', '$location', function ($scope, $location) {
    $scope.isCurrentPath = function (path) {
        return $location.path() == path;
    };
}]).controller('dashboardCtrl', ['$scope', function ($scope) {

}]).controller('jobsListCtrl', ['$scope', '$uibModal', function ($scope, $uibModal) {
    $scope.today = function () {
        $scope.dt = new Date();
    };
    $scope.today();

    $scope.clear = function () {
        $scope.dt = null;
    };

    $scope.inlineOptions = {
        customClass: getDayClass,
        minDate: new Date(),
        showWeeks: true
    };

    $scope.dateOptions = {
        dateDisabled: disabled,
        formatYear: 'yy',
        maxDate: new Date(2020, 5, 22),
        minDate: new Date(),
        startingDay: 1
    };

    // Disable weekend selection
    function disabled(data) {
        var date = data.date,
            mode = data.mode;
        return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
    }

    $scope.toggleMin = function () {
        $scope.inlineOptions.minDate = $scope.inlineOptions.minDate ? null : new Date();
        $scope.dateOptions.minDate = $scope.inlineOptions.minDate;
    };

    $scope.toggleMin();

    $scope.open1 = function () {
        $scope.popup1.opened = true;
    };

    $scope.open2 = function () {
        $scope.popup2.opened = true;
    };

    $scope.setDate = function (year, month, day) {
        $scope.dt = new Date(year, month, day);
        $scope.dt1 = new Date(year, month, day);
    };

    $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd/MM/yyyy', 'shortDate'];
    $scope.format = $scope.formats[2];
    $scope.altInputFormats = ['M!/d!/yyyy'];

    $scope.popup1 = {
        opened: false
    };
    $scope.popup2 = {
        opened: false
    };

    function getDayClass(data) {
        var date = data.date,
            mode = data.mode;
        if (mode === 'day') {
            var dayToCheck = new Date(date).setHours(0, 0, 0, 0);

            for (var i = 0; i < $scope.events.length; i++) {
                var currentDay = new Date($scope.events[i].date).setHours(0, 0, 0, 0);

                if (dayToCheck === currentDay) {
                    return $scope.events[i].status;
                }
            }
        }

        return '';
    }

    $scope.showDiv = false;

    $scope.animationsEnabled = true;

    $scope.openModal = function (size) {
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'jobView.html',
            controller: 'jobViewCtrl',
            size: size
        });
    };

    $scope.experience = {
        minValue: 3,
        maxValue: 15,
        options: {
            floor: 1,
            ceil: 50,
            step: 1,
            minRange: 4,
            pushRange: true,
            showSelectionBar: true,
            getSelectionBarColor: function (value) {
                return '#fecb16';
            }
        }
    };
    $scope.salary = {
        minValue: 2,
        maxValue: 10,
        options: {
            floor: 1,
            ceil: 50,
            step: 1,
            minRange: 3,
            pushRange: true,
            showSelectionBar: true,
            getSelectionBarColor: function (value) {
                return '#fecb16';
            }
        }
    };

}]).controller('jobViewCtrl', ['$scope', '$uibModalInstance', function ($scope, $uibModalInstance) {
    $scope.closeModal = function () {
        $uibModalInstance.dismiss();
    };
}]).controller('companyCtrl', ['$scope', function ($scope) {
    $scope.showDiv = false;
    $scope.showUpload = false;
}]).controller('candidateCtrl', ['$scope', function ($scope) {
    $scope.showDiv = false;
    $scope.showUpload = false;
}]).controller('profileListCtrl', ['$scope', '$uibModal', '$location', function ($scope, $uibModal, $location) {
    $scope.showFilterSection = function () {
        $scope.isActive = !$scope.isActive;
    };
    $scope.hideFilter = function () {
        $scope.isActive = false;
    };
    $scope.experience = {
        minValue: 3,
        maxValue: 15,
        options: {
            floor: 1,
            ceil: 50,
            step: 1,
            minRange: 4,
            pushRange: true,
            showSelectionBar: true,
            getSelectionBarColor: function (value) {
                return '#fecb16';
            }
        }
    };
    $scope.salary = {
        minValue: 2,
        maxValue: 10,
        options: {
            floor: 1,
            ceil: 50,
            step: 1,
            minRange: 3,
            pushRange: true,
            showSelectionBar: true,
            getSelectionBarColor: function (value) {
                return '#fecb16';
            }
        }
    };

    $scope.skillsList = {
        "0": "JAVA",
        "1": "J2EE",
        "2": "Spring",
        "3": "Struts 2.0",
        "4": "NodeJS",
        "5": "HTML5/CSS3",
        "6": "Javascript",
        "7": "AngularJS",
        "8": "EmberJS",
        "9": "IONIC Framework",
        "10": "ReactJS"
    }

    $scope.goAdvaced = function () {
        $location.path('advacedResumeSearch');
    };
}]).controller('savedSearchCtrl', ['$scope', '$uibModalInstance', function ($scope, $uibModalInstance) {
    $scope.closeModal = function () {
        $uibModalInstance.dismiss();
    };
}]).controller('advancedResumeSearchCtrl', ['$scope', '$http', '$uibModal', function ($scope, $http, $uibModal) {
    $scope.openModal = function (size) {
        $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'savedSearch.html',
            controller: 'savedSearchCtrl',
            size: size
        });
    };
    $scope.salary = {
        minValue: 2,
        maxValue: 10,
        options: {
            floor: 1,
            ceil: 50,
            step: 1,
            minRange: 3,
            pushRange: true,
            showSelectionBar: true,
            getSelectionBarColor: function (value) {
                return '#fecb16';
            }
        }
    };

    $http.get('jsonData/graduation.json').success(function (data) {
        $scope.countries = data;
    });

    $http.get('jsonData/postgraduation.json').success(function (data) {
        $scope.postgrad = data;
    });

    $http.get('jsonData/industry.json').success(
        function (data) {
            $scope.industries = data;
        });

    $http.get('jsonData/functionalarea.json').success(
        function (data) {
            $scope.functionalarea = data;
        });

    $http.get('jsonData/phd.json').success(function (data) {
        $scope.phd = data;
    });

    $http.get('jsonData/skills.json').success(function (data) {
        $scope.parentItems = data;
        $scope.selectedParentItem = $scope.parentItems[0];
    });

    $http.get('jsonData/areaofspec.json').success(function (data) {
        $scope.grandChildItems = data;
        $scope.selectedGrandChildItem = $scope.grandChildItems[0];
    });

    $http.get('jsonData/role.json').success(function (data) {
        $scope.grandChildItems1 = data;
        $scope.selectedGrandChildItem1 = $scope.grandChildItems1[1];
    });

    $scope.jobfunctions = {
        'Finance & Accounts': {
            "Accounting/Tax/Company Secretary/Audit": [
										"Accountant/ Accounts Executive",
										"Accounting/ Auditing Clerk",
										"Accounts Assistant/ Book Keeper",
										"Accounts Manager",
										"Auditing Manager",
										"Bank Accountant",
										"Chartered Accountant",
										"Cost Accountant/ ICWA",
										"External Auditor",
										"Financial Accountant",
										"Forensic Accountant/ Auditor",
										"Internal Auditor",
										"Management Accountant",
										"Payroll Accountant",
										"Project/ Production Accountant",
										"Taxation Manager",
										"Other Accounting/ Audit",
										"Cashier",
										"Commercial/ Compliance Control - Executive",
										"Commercial/ Compliance Control - Manager",
										"Company Secretary (CS)",
										"Credit/ Control - Manager",
										"Financial Analyst",
										"Finance Controller",
										"Finance Manager",
										"Financial Planning/ Budgeting - Manager",
										"FOREX Manager/ Head",
										"Operations Manager",
										"Payroll/ Compensation - Executive",
										"Payroll/ Compensation - Manager",
										"Treasurer", "Other Finance",
										"Vice President GM Head - Finance",
										"Vice President/ GM/ Head - Accounts",
										"Other Top Management",

										"Management Trainee/ Trainee",
										"Intern", "Fresher"],
            "Finance and Insurance": [
										"Collections Manager/ Head",
										"Collections Officer",
										"Credit Manager/ Head",
										"Credit Analyst/ Officer",
										"Customer Service Executive/ Officer",
										"Customer Service Manager/ Head",
										"Domestic Private Banking - Executive/ Manager",
										"Operations/ Documentation - Executive/ Manager",
										"Phone/ Internet Banking Executive",
										"Relationship Executive/ Manager",
										"Branch Manager/ Head",
										"Regional Manager/ Head",
										"Head - Personal/ Retail Banking",
										"Other Personal/ Retail Banking",

										"Business Alliances Manager",
										"Card Approvals Officer",
										"Operations Executive/ Officer",
										"Operations Manager",
										"Product Manager - Cards",
										"Collections Executive/ Officer",
										"Merchant Acquisition Executive",
										"Other Card Products",

										"Back Office Executive",
										"Money Markets Dealer",
										"FOREX Dealer",
										"Sales/ Business Development Manager - FOREX",
										"FOREX Manager/ Head",
										"Debt Instrument Dealer",
										"Sales/ Business Development Manager - Debt Instruments",
										"Debt Operations Manager",
										"Derivatives Dealer",
										"Sales/ Business Development Manager - Derivatives",
										"Fixed Income Manager/ Head",
										"Treasury Operations Manager",
										"Other Treasury",

										"Bad Debts/ Workouts Manager",
										"Client Servicing/ Key Account Manager",
										"Credit Analyst/ Officer",
										"Credit Manager/ Head",
										"Customer Service Executive/ Officer",
										"Customer Service Manager/ Head",
										"Relationship Executive/ Manager",
										"Branch Manager/ Head",
										"Regional Manager/ Head",
										"Corporate Banking Head",
										"Other Corporate Banking",

										"Corporate Advisory Manager",
										"Debt Analyst",
										"Domestic Debt Manager",
										"Equity Analyst",
										"Investment Advisor",
										"Investment Banking Analyst",
										"Issues/ IPO Manager",
										"Legal Manager",
										"Legal Officer",
										"Mergers &amp; Acquisitions - Analyst",
										"Mergers &amp; Acquisitions - Manager",
										"Offshore Debt Manager",
										"Project Finance Manager",
										"Investment Banking Head",
										"Other Investment Banking",

										"ATM Operations Manager",
										"Audit Manager",
										"Cash Officer/ Manager",
										"Clearing Officer/ Manager",
										"Depository Services - Executive/ Manager",
										"Finance/ Budgeting Manager",
										"Legal Manager",
										"Legal Officer",
										"Operations Manager",
										"Operations Executive/ Officer",
										"Technology Manager",
										"Trade Finance Operations Manager/ Head",
										"Other Banking",

										"Actuary Manager",
										"Area/ Territory Sales Manager",
										"Bancassurance Executive/ Manager",
										"Branch Manager/ Head",
										"Insurance - Claims Manager",
										"Customer Service Executive/ Officer",
										"Customer Service Manager/ Head",
										"Insurance Advisor - General Insurance",
										"Insurance Advisor - Life Insurance",
										"Insurance Analyst - General Insurance",
										"Insurance Analyst - Life Insurance",
										"marketing Manager",
										"Operations Executive/ Officer - Insurance",
										"Operations Manager - Insurance",
										"Product Manager - Insurance",
										"Relationship Manager",
										"Regional Manager/ Head",
										"Unit Manager",
										"Underwriter/ Underwriting Manager",
										"Other Insurance",
										"Account Services Executive",
										"Asset Operations Executive/ Manager",
										"Compliance &amp; Control",
										"Depository Participant",
										"Derivatives Analyst",
										"Hedge Fund Analyst/ Trader",
										"Investment Analyst",
										"Market Risk - Manager/ Head",
										"Mutual Fund Analyst",
										"Portfolio Manager",
										"Product Manager - Mutual Funds",
										"Risk Management Analyst/ Manager",
										"Security/ Equity Researcher",
										"Stock Broker",
										"Stock Broking - Ratings Analyst",
										"Stock Broking - Trading Advisor",
										"Transaction Processing Executive",
										"Other Financial Services"]
        },
        'Sales & Marketing & Advertisements': {
            "Online & Offline Marketing / MR / Media Planning": [
										"Advertising - Account Executive/ Client Servicing Executive",
										"Advertising - Account Manager/ Client Servicing Manager",
										"Head - Advertising",
										"Corp. Communications Executive/ Manager",
										"Head – Corp. Communications",
										"Events/ Promotion - Manager",
										"Marketing Communications/ MarCom - Executive/ Officer",
										"Marketing Communications/ MarCom - Manager/ Head",
										"Media Buying - Executive/ Officer",
										"Media Buying - Manager",
										"Media Planning - Executive/ Officer",
										"Media Planning - Manager",
										"PR - Account Director/ Account Planner",
										"PR - Account Executive/ Client Servicing Executive",
										"PR - Account Manager/ Client Servicing Manager",
										"PR/ Media Relations - Executive",
										"PR/ Media Relations - Manager",
										"Head - PR/ Event Management",
										"Other Advertising/ PR/ Events",
										"Product Analyst/ Executive",
										"Product/ Brand Manager",
										"Product Head",
										"Marketing Executive",
										"Marketing Manager",
										"Online/ Internet Marketing - Executive/ Manager",
										"SEO/ Online Advertising - Executive/ Manager ",
										"Other Product/ Brand Management",
										"Direct Marketing - Account Manager",
										"Direct Marketing - Executive/ Officer",
										"Direct Marketing - Manager/ Head",
										"Other Direct Marketing",
										"Market Research - Analyst",
										"Market Research - Executive",
										"Market Research - Field Executive",
										"Market Research - Manager",
										"Market Research - Project Director",
										"Other Market Research",
										"SBU Head/ Profit Centre Head",
										"Vice President/ GM - Business Alliances",
										"Vice President/ GM/ Head - Marketing",
										"Vice President/ GM - Media Buying",
										"Vice President/ GM - Media Planning &amp; Strategy",
										"Other Top Management",
										"Management Trainee/ Trainee",
										"Intern",
										"Business Alliances Manager",
										"International Marketing/ Business - Manager/ Executive",
										"Marketing Engineer", "Merchandiser",
										"Regional Marketing Manager",
										"Visual Merchandiser",
										"Other Marketing", "Fresher"],
            "Sales/Business Development": [
										"Sales Executive/ Officer",
										"Medical Representative",
										"Sales/ Business Development Manager",
										"Client Relationship Manager",
										"Regional Sales Manager",
										"Other Channel Sales/ Retail Sales",
										"Banquet Sales - Manager/ Executive",
										"Institutional Sales - Executive/ Officer",
										"Institutional Sales - Manager",
										"IT Sales/ Technical Sales - Executive",
										"IT Sales/ Technical Sales - Manager",
										"Relationship Manager",
										"International Sales/ International Marketing Manager",
										"Other Corporate/ Institutional Sales",
										"Other Government Sales",
										"SBU Head/ Profit Centre Head",
										"National Sales Manager/ Sales Head",
										"Vice President/ GM/ Head - Sales/ Business Development",
										"Other Top Management",
										"Management Trainee/ Trainee",
										"Intern",
										"Loyalty Programs - Executive/ Manager",
										"Direct Sales - Executive/ Officer",
										"Direct Sales Manager",
										"DSA (Direct Sales Agent) - Insurance",
										"Franchisee Management/ DevelopmentReal Estate Agent",
										"Sales Engineer",
										"Sales Support Executive/ Manager",
										"Sales Training Executive/ Manager",
										"Sales Planning Manager",
										"Telecalling/ Telemarketing/ Telesales - Executive",
										"Telecalling/ Telemarketing/ Telesales - Team Lead/ Manager",
										"Other Sales/ Business Development",
										"Fresher"],
            "Advertising / Public Relation / Events": [
										"3d Artist",
										"Art Director",
										"Advertising - Account Executive/ Client Servicing Executive",
										"Advertising - Account Manager/ Client Servicing Manager",
										"Advertising - Group Account Manager/ Account Director",
										"Advertising - Account Planning Manager",
										"Advertising - Account Planning Head",
										"Audiovisual Design Engineer",
										"Costume Designer",
										"Creative Director",
										"Fine Artist/ Illustrator",
										"Graphic Artist/ Animator",
										"Human-Computer Interaction Designer",
										"Layout Artist",
										"Macromedia Flash Designer",
										"Media Buying - Executive/ Officer",
										"Media Buying - Manager",
										"Media Planning - Executive/ Officer",
										"Media Planning - Manager",
										"Media Research - Executive/ Officer",
										"Media Research - Field Executive",
										"Media Research - Manager",
										"Production Head",
										"Studio Operations Manager",
										"Technical Design Manager",
										"Visualiser",
										"Head - Advertising",
										"Other Advertising",
										"Account Planning Manager",
										"Account Planning Head",
										"PR - Account Executive/ Client Servicing Executive",
										"PR - Account Manager/ Client Servicing Manager",
										"PR - Group Account Manager/ Account Director",
										"Content Developer/ Content Writer",
										"Events/ Promotion - Manager",
										"Events/ Promotions - Coordinator",
										"Events/ Promotions - Director",
										"Photographer",
										"PR/ Media Relations - Executive",
										"PR/ Media Relations - Manager",
										"Road Shows - Manager/ Supervisor",
										"Set and Exhibit Designer",
										"Special Events - Coordinator",
										"Special Events - Manager",
										"Head - PR/ Event Management",
										"Other PR/ Event Management",
										"Market Research - Field Executive",
										"Market Research - Field Supervisor",
										"Market Research Executive - Qualitative",
										"Market Research Executive - Quantitative",
										"Market Research - Manager",
										"Market Research - Account Executive/ Client Servicing Executive",
										"Market Research - Account Manager/ Client Servicing Manager",
										"Market Research - Group Account Manager/ Account Director",
										"Other Market Research",
										"SBU Head/ Profit Centre Head",
										"Vice President/ GM - Client Servicing",
										"Vice President/ Head - Creative/ Creative Director",
										"Vice President/ GM - Media Buying",
										"Vice President/ GM - Media Planning &amp; Strategy",
										"Other Top Management",
										"Management Trainee/ Trainee",
										"Intern", "Fresher"]
        },
        'Office Operations /Human Resources': {
            "Front Office Staff/Secretarial/Computer Operator": [
										"Computer Operator/ Data Entry Operator",
										"Executive Assistant/ Executive Secretary",
										"Front Office Assistant/ Executive",
										"Personal Secretary/ Stenographer",
										"Receptionist",
										"Telephone/ Board Operator",
										"PBX Operator",
										"Other Secretarial/ Clerical Functions",
										"Vice President/ GM/ Head - Administration",
										"Fresher",
										"Management Trainee/ Trainee"],
            "Human Resource / IR /Training &amp; Development": [
										"Payroll - Executive/ Officer",
										"Payroll - Manager/ Head",
										"Employee Relations - Manager/ Head",
										"HR Consultant",
										"HR Executive/ Officer",
										"HR Generalist",
										"HR Manager",
										"HR Lead/ Territory HR Lead",
										"Industrial Relations - Manager",
										"Organization Development Manager",
										"Recruitment - Executive/ Officer",
										"Recruitment - Manager",
										"Recruitment - Head",
										"Recruitment Consultant",
										"Training & Development - Executive/ Officer",
										"Training & Development - Manager",
										"Training & Development - Head",
										"Other HCM/ HR/ T&D",
										"SBU Head/ Profit Centre Head",
										"Vice President/ GM/ Head - Human Resources",
										"Vice President/ GM - Industrial/ Labour Relations",
										"Other Top Management",
										"Management Trainee/ Trainee",
										"Intern", "Fresher"]
        },
        'Production/Maintenance/Quality': {
            "Production/Maintenance/ Manufacturing/ Packaging": [
										" Assembler",
										" Commercial Engineer",
										" Environmental Engineer",
										" Estimation Engineer",
										" Factory Engineer",
										" Factory Manager/ Plant Head",
										" Floor Supervisor",
										" Industrial Engineer",
										" Materials/ Inventory Control -Executive/ Officer",
										" Materials/ Inventory Control -Manager/ Head",
										" Paint Shop",
										" Plant Engineer",
										" Plumbing Engineer",
										" Product Manager",
										" Project Leader/ Project Manager",
										" Quality Assurance/ Control -Executive",
										" Quality Assurance/ Control -Manager",
										"   R&D Manager",
										" Safety Officer/ Engineer",
										" Service/ Maintenance Engineer/Manager",
										" Spares Manager/ Engineer",
										" Store Keeper/ Warehouse Assistant",
										" Store Manager/ Warehouse Manager",
										" Tool Room",
										" Welder",
										" Workman/ Foreman/ Technician",
										" Other Production/ Maintenance",

										" SBU Head/ Profit Centre Head",
										" Vice President/ GM/ Head -Operations",
										" Vice President/ GM/ Head -Production/ Manufacturing",
										" Vice President/ GM/ Head - Quality",
										" Other Top Management",

										"Management Trainee/ Trainee",
										"Intern", "Fresher"],
            "Quality/Process Control": [
										" Automation Engineer",
										" Configuration Manager",
										" Delivery Manager/ Head",
										" Lead Testing Engineer",
										" Performance Test Engineer",
										" Process Trainer",
										" Quality Assurance/ Control -Executive",
										" Quality Assurance/ Control -Manager",
										" Quality Auditor",
										" Release Manager",
										" Software Quality Assurance Analyst",
										" Software Quality Assurance Engineer",
										" Software Quality Assurance Manager",
										" Software Testing Architect",
										" Software Testing Engineer/ Test Automation Engineer",
										" Software Testing Manager",
										" Other Quality/ Process Control",

										" SBU Head/ Profit Centre Head",
										" Vice President/ GM/ Head -Operations",
										" Vice President/ GM/ Head -Production/ Manufacturing",
										" Vice President/ GM/ Head - Quality",
										" Other Top Management",

										"Management Trainee/ Trainee",
										"Intern", "Fresher"]
        },
        'Hotel/Restaurant': {

            "Food & Beverages": [
										"Banquet Sales - Manager/ Executive",
										"Banquet Manager",
										"Bartender",
										"Brew Master/ Coffee Master",
										"Butler",
										"Captain",
										"Catering Supervisor/ Manager",
										"Chef - Chef De Partie/ StationChef",
										"Chef - Commis/ Apprentice",
										"Chef - Executive Chef/ Chef DeCuisine",
										"Chef - Executive Sous Chef/ SousChef",
										"Chef - Others",
										"F&amp;B Manager",
										"Kitchen Manager",
										"Restaurant Host/ Hostess",
										"Restaurant Manager",
										"Waiter/ Waitresses/ Steward/Stewardess",
										"Other Food &amp; Beverages"],
            "House Keeping": [
										"Housekeeping - Executive/Assisstant",
										"Housekeeping - Team Leader/Manager",
										"Laundry Executive/ Manager",
										"Other Housekeeping"],
            "Front Desk/ Customer Care\tCashier": [
										"Cashier",
										"Concierge",
										"Front Office/ Customer Relations -Executive",
										"Front Office/ Customer Relations -Manager",
										"Guest Relations Officer",
										"Lobby/ Duty - Executive/ Manager",
										"Travel Desk - Executive/ Manager",
										"Other Front Desk/ Customer Care"],
            "Spas/ Health Club": [
										"Masseur",
										"Beauty/ Fitness Centre -Assistant/ Manager",
										"Beauty/ Fitness Centre -Beautician/ Make-Up Artist/ Hair Stylist",
										"Other Spas/ Health Club"],
            "Top Management": [
										"Executive Chef/ Master Chef",
										"National Sales Manager/ Sales Head",
										"Vice President/ GM - Corp Communications",
										"Vice President/ GM - F &; B",
										"Vice President/ GM/ Head - Sales/Business Development",
										"Other Top Management"]

        },
        'Architects/InteriorDesign/Naval Arch': {
            "Architecture/ Interior Desiging": [
										"Architect",
										"AutoCAD Designer",
										"AutoCAD Designer (Structural)",
										"Cartographer",
										"Draftsman/ Draughtsman",
										"Furniture Designer",
										"Industrial Architect",
										"Industrial Designer",
										"Interior Designer",
										"Land Surveyor",
										"Landscape Architect/ Designer",
										"Landscape Horticulturist",
										"Naval Architect",
										"Project Manager - Architecture",
										"Project Manager - Interior Designing",
										"Sales Executive/ Manager -Architecture/ Interior Designing",
										"Town/ Urban Planner",
										"Other Architecture/ Interior Designing"],
            "Data Management/ Analysis": [
										"Bio-Statistician",
										"Clinical Data Manager",
										"Data Management/ Statistics",
										"Other Data Management/ Analysis"]

        },
        'Bio Tech/R&D/Scientist': {
            "R&D": [
										"Analytical Chemistry - Research Associate",
										"Analytical Chemistry - Research Manager",
										"Bio/ Pharma Informatics - Research Associate",
										"Bio/ Pharma Informatics - Research ",
										"Pharmacist/ Chemist/ Bio Chemist",
										"Biomedical Engineer",
										"Biomedical Engineering - Manager",
										"Biotechnology - Research Associate",
										"Biotechnology - Research Manager",
										"Chemical Research - Engineer  Manager",
										"Chemical Research - Research Associate",
										"Chemical Research - Research Manager",
										"Clinical Research/ Clinical Trials - Coordinator",
										"Clinical Research/ Clinical Trials- Associate",
										"Clinical Research/ Clinical Trials- Research Manager",
										"Forensic Chemist",
										"Formulation Scientist",
										"Microbiologist",
										"Molecular Biologist", "Nutritionist",
										"Pharmaceuticals - Research Analyst",
										"Pharmaceuticals - Research Manager",
										"Research Engineer",
										"Research Administrator",
										"Research Fellow",
										"Research Scientist", "Toxicologist",
										"Other R & D"]
        },
        'Consultants / Freelancers': {
            "Freelancing": [
										"Freelance Copywriter",
										"Freelance Editor",
										"Freelance Fashion Designer/",
										"Jewellery Designer",
										"Freelance Graphic Designer",
										"Freelance Photographer",
										"Freelance Programmer",
										"Freelance Proofreader",
										"Freelance Web Designer",
										"Freelance Artist",
										"Freelance Interior Designer",
										"Freelance Writer",
										"Freelance Corporate Trainer",
										"Freelance Translator/ Language Specialist",
										"Freelance Recruiter",
										"Other Freelancing"],
            "Consulting": [
										"Management/ Business Consultant",
										"Software Consultant",
										"Graphic Designing/ User Interface - Consultant",
										"Corporate Strategy Advisor",
										"Environmental Consultant",
										"Other Consulting"]
        },
        'Content/Editors/Journalists': {
            "Content Development": [
										"Content Developer/ Content Writer",
										"Content Development - Manager/Head",
										"Business Content Developer",
										"Content Acquisition Researcher",
										"Copywriter",
										"Fashion/ Lifestyle/ Entertainment Content Developer",
										"Features Content Developer",
										"Political Content Developer",
										"Proof Reader/ Copy Marker",
										"Sports Content Developer",
										"Technical/ IT Content Developer",
										"Other Content Development"],
            "Editor": [
										"Business Editor",
										"Associate Editor",
										"Chief of Bureau/ Editor in Chief -Books",
										"Chief of Bureau/ Editor in Chief -Journal",
										"Chief of Bureau/ Editor in Chief -Magazine",
										"Chief of Bureau/ Editor in Chief -Newspaper",
										"Chief of Bureau/ Editor in Chief -Online Media",
										"Chief of Bureau/ Editor in Chief -Others",
										"Copy Editor/ Sub Editor",
										"Fashion/ Lifestyle/ EntertainmentEditor",
										"Features Editor",
										"International Business Editor",
										"Journal Editor", "Magazine Editor",
										"Managing Editor", "Newspaper Editor",
										"Political Editor", "Proof Reader",
										"Publications Editor", "Sports Editor",
										"Technical/ IT Editor",
										"Web Content Editor", "Other Editor"]
        },
        'Corporate Planning/Counsulting/ Strategy': {
            "Corporate Planning/ Strategic Management": [
										"Business Continuity &amp; Business Planning Manager",
										"Business Strategy - Manager",
										"Business Supervisor",
										"Corporate Strategy - Manager",
										"Functional Strategy - Manager",
										"Mergers &amp; Acquisitions -Manager",
										"Mergers &amp; Acquisitions - Head",
										"Research Associate",
										"Risk Management Analyst/ Manager",
										"Strategic Alliances - Manager",
										"Strategic Alliances - Head",
										"Other Corporate Planning/Strategic Management",
										"SBU Head/ Profit Centre Head",
										"Vice President/ GM/ Head -Corporate Planning",
										"Vice President/ GM/ Head -Strategic Management",
										"Other Top Management",
										"Management Trainee/ Trainee",
										"Intern", "Fresher"]
        },
        'Doctors/Nurses/MedicalProfessional': {
            "Doctor/ Physician": [
										"Anesthetist",
										"Cardiologist",
										"Company Physician/ Doctor",
										"Dentist",
										"Dermatologist",
										"Endocrinologist",
										"ENT Specialist",
										"Gastroenterologist",
										"General Practitioner/ Physician",
										"Gynaecologist",
										"Hepatologist",
										"Immunologist",
										"Neonatologist",
										"Nephrologist",
										"Neurologist",
										"Obstetrician",
										"Oncologist",
										"Opthalmologist",
										"Orthopaedician",
										"Paediatrician",
										"Psychiatrist",
										"Pulmonologist/ Pneumologist",
										"Radiologist",
										"Rheumatologist",
										"Speech Language Pathologist/Audiologist",
										"Surgeon", "Urologist", "Veterinarian",
										"Other Doctor/ Physician"],
            "Lab Staff": ["Lab/ Medical Technician",
										"Medical Imaging",
										"Pathologist/ Hematologist",
										"Radiographer",
										"Radiology X-Ray Technician",
										"Toxicologist", "Other Lab"],
            "Medical Support": [
										"Dietician/ Nutritionist",
										"Emergency/ Intensive Care Specialist",
										"Nurse", "Occupational Therapist",
										"Optometrist", "Paramedic",
										"Pharmacist/ Chemist",
										"Physiotherapist", "Psychologist",
										"Other Medical Support"],
            "Alternative Medicine": [
										"Acupuncture Specialist",
										"Ayurveda Specialist",
										"Homeopath",
										"Natural Therapist",
										"Other Alternative Medicine",
										"SBU Head/ Profit Centre Head",
										"Vice President/ GM/ Chief Medical Officer (CMO)",
										"Other Top Management",
										"Nurses/ Healthcare Professionals",
										"Management Trainee/ Trainee", "Intern"],
            "Others-": [
										"Hospital Administrator/ Manager",
										"Medical Officer",
										"Medical Superintendent/ Director",
										"Other Doctor/ Nurse/ Healthcare",
										"Professional", "Fresher"]
        },
        'Civil &Site/Electrical/ Aerospace/ Engg Project Management': {
            "Design Engineer": [
										"Design Engineer - Chemical/Process",
										"Design Engineer - Civil/Structural",
										"Design Engineer - Electrical",
										"Design Engineer - HVAC",
										"Design Engineer - Instrumentation",
										"Design Engineer - Mechanical",
										"Design Engineer - Pipeline Design",
										"Design Engineer - Tool Room",
										"Marine", "Other Design Engineer"],
            "Draftsman/ Draughtsman": [
										"Draftsman/ Draughtsman - Civil/Structural",
										"Draftsman/ Draughtsman -Electrical",
										"Draftsman/ Draughtsman -Mechanical",
										"Draftsman/ Draughtsman - HVAC",
										"Draftsman/ Draughtsman - Piping",
										"Draftsman/ Draughtsman - CAD/ CAE",
										"Other Draftsman/ Draughtsman"],
            "O&;M Engineer": [
										"O&amp;M Engineer - BiomedicalEngineering",
										"O&amp;M Engineer - Chemical/Process",
										"O&amp;M Engineer - Electrical",
										"O&amp;M Engineer - Food/ Dairy",
										"O&amp;M Engineer - HVAC",
										"O&amp;M Engineer - Instrumentation &amp; Controls",
										"O&amp;M Engineer - Marine",
										"O&amp;M Engineer - Mechanical",
										"O&amp;M Engineer - Mining",
										"O&amp;M Engineer - Paint Shop",
										"O&amp;M Engineer - Petroleum",
										"O&amp;M Engineer - Planning/Project Controller",
										"O&amp;M Engineer - Tool Room",
										"O&amp;M Engineer - Weld Shop",
										"Other O&amp;M Engineer"],
            "Quality Engineer": [
										"Quality Engineer - Chemical/Process",
										"Quality Engineer - Civil/Structural",
										"Quality Engineer - Electrical",
										"Quality Engineer - Mechanical",
										"Quality Engineer - Piping",
										"Quality Engineer - Food/ Dairy",
										"Quality Engineer - Welding/Fabrication",
										"Safety Officer/ Engineer",
										"Other Quality Engineer"],
            "Site/ Field Engineer": [
										"Site/ Field Engineer - Civil/Structural",
										"Site/ Field Engineer - Electrical",
										"Site/ Field Engineer - HVAC",
										"Site/ Field Engineer -Instrumentation/ Electronics",
										"Site/ Field Engineer - Mechanical",
										"Site/ Field Engineer - PipelineConstruction",
										"Other Site/ Field Engineer"],
            "Project Manager/ Chief Engineer": [
										"Project Manager/ Chief Engineer -Construction/ Civil",
										"Project Manager/ Chief Engineer -Electrical",
										"Project Manager/ Chief Engineer -Process/ Chemical",
										"Project Manager/ Chief Engineer -Production/ Maintenance  Maker",
										"Technician/ Foreman - Painting/Coating/ Insulation",
										"Technician/ Foreman - Printing/Pre-press",
										"Other Technician/ Foreman"]
        },
        'Export/Import': {
            "Export/Import": [
										"Documentation/ Shipping -Executive/ Manager",
										"International Business Development Manager",
										"Export/ Import - Agent",
										"Export/ Import - Manager",
										"Export/ Import - Officer/Executive",
										"Liaison - Executive/ Manager",
										"Logistics Manager/ Head",
										"Merchandiser",
										"Operations Manager",
										"Production Manager",
										"Purchasing Manager",
										"Quality Assurance/ Control -Executive",
										"Quality Assurance/ Control -ManagerTrader",
										"Store Manager/ Warehouse Manager",
										"Other Export/ Import"]
        },
        'Legal/Law': {
            "Legal/Law": [
										"Court/ Law Clerk",
										"Associate Lawyer/ Attorney",
										"Judge/ Magistrate",
										"Legal Assistant/ Paralegal",
										"Legal Trainee/ Apprentice",
										"Company Secretary (CS)",
										"Legal Advisor/ Solicitor",
										"Law/ Legal Officer",
										"Law/ Legal Manager",
										"Private Attorney/ Lawyer",
										"Legal Transcriptionist/ Proof Reader (Law)",
										"Regulatory Affairs - Officer/Executive",
										"Regulatory Affairs - Manager",
										"Other Legal/ Law"]
        },
        'Retailing/ Logistics/Supply Chain/ Materials/ Procurement': {
            "Logistics": [
										"CFA (Carrying and ForwardingAgent)",
										"Courier/ Transit Centre -Executive/ Manager",
										"Customs Officer", "Customs Manager",
										"Distribution Manager/ Head",
										"Logistics - Executive/ Officer",
										"Logistics Manager/ Head",
										"Maintenance Manager", "Shipbroker",
										"Store Keeper/ Warehouse Assistant",
										"Store Manager/ Warehouse Manager",
										"Transport/ Fleet - Executive/Manager",
										"Other Logistics"],
            "Purchase/ Material Management": [
										"eProcurement - Executive/ Manager",
										"Commercial Manager",
										"Commodity Trading Manager",
										"Materials/ Inventory Control -Executive",
										"Materials/ Inventory Control -Manager/ Head",
										"Purchase/ Vendor Development -Executive",
										"Purchase/ Vendor Development -Manager/ Head",
										"Other Purchase/ MaterialManagement",
										"Vice President/ GM - Logistics/Supply Chain (SCM)",
										"Vice President/ GM - Purchase",
										"Other Top Management",
										"Management Trainee/ Trainee", "Intern"],
            "Others": [
										"Computer Operator/ Data EntryOperator",
										"Facility Management - Manager",
										"General/ Operations Manager",
										"Quality Assurance/ Control -Manager",
										"Security Officer/ Facility Security Officer (FSO)",
										"Other Logistics/ Supply ChainManagement/ Procurement",
										"Fresher"]
        },
        'Education / Teachers /Professors / Lecturers / Academics': {
            "Education/ Teaching": [
										"Deputy Director/ Director",
										"Director General/ Chairman",
										"Vice Principal/ Principal (School)",
										"Vice Principal/ Principal(College/ Institute)",
										"Lecturer/ Professor/ Reader",
										"Library Assistant/ Attendant",
										"Librarian",
										"Tutor - Private/ Online",
										"Teacher - Nursery/ Play School",
										"Teacher - PRT (ProvisionallyRegistered Teacher)",
										"Teacher - TGT (Trained GraduateTeacher)",
										"Teacher - PGT (Post GraduateTeacher)",
										"Teacher - Music/ Dance/ Drama",
										"Teacher - Art/ Crafts/ Painting",
										"Teacher - Physical Education/Sports/ Games",
										"Teacher - Others", "Warden",
										"Other Education/ Teaching"],
            "Academic Research": [
										"Research Associate",
										"Research Fellow",
										"Distinguished Fellow",
										"Other Academic Research",
										"Management Trainee/ Trainee",
										"Intern",
										"Counselor - Career/ School/Educational",
										"Courseware/ Content Developer",
										"Curriculum/ Instructional Designer",
										"Language Specialist/ Linguist",
										"Special Educator",
										"Speech Therapist",
										"Other Education &amp; AcademicResearch",
										"Freshers"]
        },
        'Travel / Ticket / Airlines/ Cabin Crew / Air Hostess / Floor Operations': {
            "Travel/ Ticketing": [
										"Branch Manager/ Head",
										"Cashier",
										"Foreign Exchange Division",
										"MICE (Meetings Incentives Conferences Exhibitions)",
										"Operations Executive/ Manager",
										"Reservation/ Ticketing Officer",
										"Reservation/ Ticketing Manager",
										"Tour Management Executive",
										"Tour Management Manager",
										"Travel Agent",
										"Visa &amp; Documentation",
										"Other Travel/ Ticketing"],
            "Aviation": [
										"Air Hostess/ Flight Steward/ CabinCrew",
										"Air Freight Agent",
										"Air Traffic Controller",
										"Airline Reservation Agent",
										"Airline Security Representative",
										"Aviation Engineer",
										"Fire Crew Leader",
										"Flight Department Manager",
										"Flight Line Manager",
										"Flight Security Specialist",
										"Flight Services Manager",
										"round Staff/ Ground Attendant",
										"Maintenance Engineer", "Pilot",
										"Ramp Planner", "Other Aviation"]
        },
        'Entertainement': {
            "TV/ Films/ Production": [
										"3d Artist/ Animator/ Graphic  Designer",
										"Actor/ Actress",
										"Art Director",
										"Audiovisual Production Director",
										"AV Editor",
										"Camera Man/ Technician",
										"Choreographer",
										"Cinematographer",
										"Creative Director",
										"Design Editor",
										"Director/ Assistant Director",
										"Language Specialist/ Translator",
										"Lighting Technician",
										"Locations Manager",
										"Media Librarian/ Archiving Manager",
										"Musician/ Music Director",
										"Printing Technologist/ Manager",
										"Production Manager",
										"Product Marketing Manager",
										"Production/ Technical Worker",
										"Radio Jockey/ Video Jockey/ DiscJockey",
										"Scheduling Executive/ TrafficManager",
										"Script Writer",
										"Sound Mixer/ Sound Engineer",
										"Special Effects Technician",
										"Spot Boy", "Stunt Coordinator",
										"Technical Support Specialist",
										"TV Presenter/ Anchor/ MC",
										"Video/ Audio Editor", "Visualiser",
										"Wardrobe/ Make up/ Hair Artist",
										"Writer/ Author",
										"Other TV/ Films/ Production"],
            "Journalism": [
										"Chief/ Deputy Chief of Bureau",
										"Correspondent/ Reporter",
										"Editor/ Managing Editor",
										"Language Specialist/ Translator",
										"News Compiler", "News Editor",
										"News Presenter/ News Reader",
										"Principal/ Senior Correspondent",
										"Proof Reader", "Other Journalism"]
        },
        'Retails': {
            "Store Management": ["Floor Manager",
										"Department Manager", "Shift Manager",
										"Inventory Control Executive",
										"Inventory Control Manager",
										"Loss Prevention Manager",
										"Store Manager",
										"Other Store Management"],
            "Logistics/ Purchase/ Supply Chain Management": [
										"Category Manager",
										"Logistics - Executive/ Officer",
										"Logistics Manager/ Head",
										"Operations Executive/ Officer",
										"Operations Manager",
										"Planning &amp; Buying - Executive",
										"Planning &amp; Buying - Manager",
										"Warehouse Assistant",
										"Warehouse Manager",
										"Other Logistics/ Purchase/ Supply Chain Management"]
        }

    };
    $scope.GetSelectedCountry = function () {
        $scope.strCountry = document
            .getElementById("country").value;
    };
    $scope.GetSelectedState = function () {
        $scope.strState = $("#state option:selected")
            .text();
    };

    $scope.employers = {
        "0": "CTS",
        "1": "TCS",
        "2": "Infosys",
        "3": "Capegemini",
        "4": "Zoho Corp",
        "5": "Acsys Software India Pvt Ltd",
        "6": "Acs Ltd.",
        "7": "Dell",
        "8": "HP",
        "9": "Alcatel Lucent",
        "10": "Basix Microfinance"
    }

    $scope.designation = {
        "0": "Project Manager",
        "1": "Trainee/ Fresher",
        "2": "Sales/Business Development",
        "3": "Advertising / Public Relation / Events",
        "4": "Front Office Staff/Secretarial/Computer Operator",
        "5": "Administration/Operations",
        "6": "Quality/Process Control",
        "7": "IT Hardware - Embedded Technology",
        "8": "IT Hardware - External hardware",
        "9": "IT Hardware - IC Fabrication/ Programming",
        "10": "IT Hardware -Installation/ Maintenance"
    }

    $http.get('jsonData/education.json').success(function (data) {
        $scope.educationData = data;
    });

    $http.get('jsonData/insitution.json').success(function (data) {
        $scope.insitutionData = data;
    });

    $scope.years = {
        "0": "2016",
        "1": "2015",
        "2": "2014",
        "3": "2013",
        "4": "2012",
        "5": "2011",
        "6": "2010",
        "7": "2009",
        "8": "2008",
        "9": "2007",
        "10": "2006"
    }

    $scope.resumeFreshness = {
        "0": "All Resumes",
        "1": "1 month old",
        "2": "3 months old",
        "3": "6 months old",
        "4": "12 months old",
        "5": "Older than 12 months",
        "6": "1 day old",
        "7": "3 days old",
        "8": "5 days old",
        "9": "7 days old"
    }
    $scope.sortBy = {
        "0": "Intellisort",
        "1": "Keyword Relevance",
        "2": "Resume Popularity",
        "3": "Recency (Latest or Oldest)"
    }

    $scope.noticePeriod = {
        "0": "7 Days",
        "1": "Upto 15 days",
        "2": "Upto 1 month",
        "3": "Upto 2 months",
        "4": "Upto 3 months",
        "5": "More than 3 months"
    }

    $scope.empStatus = {
        "0": "Full Time Employed",
        "1": "Part Time Employed",
        "2": "Unemployed",
        "3": "Contractual"
    }
    $scope.showCandidate = {
        "0": "Verified Mobile",
        "1": "Verified Email",
        "2": "Web Footprints",
        "3": "Skill Quotient",
        "4": "Passport",
        "5": "GCC Driving License"
    }

    $scope.gender = {
        "0": "Male",
        "1": "Female",
        "2": "Either"
    }

    $http.get('jsonData/countries.json').success(function (data) {
        $scope.countryData = data;
    });

    $scope.atleastOneThese = ['Atleast One of these'];
    $scope.allofThese = ['All of these'];
    $scope.noneofThese = ["None of these"];

}]).controller('viewProfileCtrl', ['$scope', function ($scope) {

}]).controller('addIndustryCtrl', ['$scope', function ($scope) {
    $scope.showDiv = false;
}]).controller('addFunctionalCtrl', ['$scope', function ($scope) {
    $scope.showDiv = false;
}]).controller('manageInterviewCtrl', ['$scope', '$uibModal', function ($scope, $uibModal) {
    $scope.showFilterSection = function () {
        $scope.isActive = !$scope.isActive;
    };
    $scope.hideFilter = function () {
        $scope.isActive = false;
    };

    $scope.bundle = ["1"];

    $scope.shopObj = {
        "0": "AngularJS Developer",
        "1": "NodeJS Developer",
        "2": "UI Developer",
        "3": "Testing Expert",
        "4": "UI/UX Designer",
        "5": "Business Analyst",
        "6": "Project Manager",
        "7": "JAVA Tech Lead",
        "8": "MEAN Stack Developer",
        "9": "BPO Executive",
        "10": "Call Center Executive"
    }

    $scope.openModal = function (size) {
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'scheduleInterview.html',
            controller: 'scheduleInterviewCtrl',
            size: size
        });
    };
}]).controller('scheduleInterviewCtrl', ['$scope', '$uibModalInstance', '$location', function ($scope, $uibModalInstance, $location) {
    $scope.closeModal = function () {
        $uibModalInstance.dismiss();
    };
    $scope.bundle = ["1"];

    $scope.shopObj = {
        "0": "CTS",
        "1": "TCS",
        "2": "Infosys",
        "3": "Manhattan Technologies",
        "4": "Apple",
        "5": "Google",
        "6": "Microsoft"
    }
    $scope.today = function () {
        $scope.dt = new Date();
    };
    $scope.today();

    $scope.clear = function () {
        $scope.dt = null;
    };

    $scope.inlineOptions = {
        customClass: getDayClass,
        minDate: new Date(),
        showWeeks: true
    };

    $scope.dateOptions = {
        dateDisabled: disabled,
        formatYear: 'yy',
        maxDate: new Date(2020, 5, 22),
        minDate: new Date(),
        startingDay: 1
    };

    // Disable weekend selection
    function disabled(data) {
        var date = data.date,
            mode = data.mode;
        return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
    }

    $scope.toggleMin = function () {
        $scope.inlineOptions.minDate = $scope.inlineOptions.minDate ? null : new Date();
        $scope.dateOptions.minDate = $scope.inlineOptions.minDate;
    };

    $scope.toggleMin();

    $scope.open1 = function () {
        $scope.popup1.opened = true;
    };

    $scope.open2 = function () {
        $scope.popup2.opened = true;
    };

    $scope.setDate = function (year, month, day) {
        $scope.dt = new Date(year, month, day);
        $scope.dt1 = new Date(year, month, day);
    };

    $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd/MM/yyyy', 'shortDate'];
    $scope.format = $scope.formats[2];
    $scope.altInputFormats = ['M!/d!/yyyy'];

    $scope.popup1 = {
        opened: false
    };
    $scope.popup2 = {
        opened: false
    };

    function getDayClass(data) {
        var date = data.date,
            mode = data.mode;
        if (mode === 'day') {
            var dayToCheck = new Date(date).setHours(0, 0, 0, 0);

            for (var i = 0; i < $scope.events.length; i++) {
                var currentDay = new Date($scope.events[i].date).setHours(0, 0, 0, 0);

                if (dayToCheck === currentDay) {
                    return $scope.events[i].status;
                }
            }
        }

        return '';
    }

    $scope.mytime = new Date();

    $scope.hstep = 1;
    $scope.mstep = 15;

    $scope.options = {
        hstep: [1, 2, 3],
        mstep: [1, 5, 10, 15, 25, 30]
    };

    $scope.ismeridian = true;
    $scope.toggleMode = function () {
        $scope.ismeridian = !$scope.ismeridian;
    };

    $scope.update = function () {
        var d = new Date();
        d.setHours(14);
        d.setMinutes(0);
        $scope.mytime = d;
    };

    $scope.changed = function () {

    };

    $scope.clear = function () {
        $scope.mytime = null;
    };

    $scope.trackInterviewChange = function () {
        $location.path('/trackInterview');
    }
}]).controller('trackInterviewCtrl', ['$scope', '$location', function ($scope, $location) {

}]).controller('cJobsListCtrl', ['$scope', '$uibModal', function ($scope, $uibModal) {
    $scope.today = function () {
        $scope.dt = new Date();
    };
    $scope.today();

    $scope.clear = function () {
        $scope.dt = null;
    };

    $scope.inlineOptions = {
        customClass: getDayClass,
        minDate: new Date(),
        showWeeks: true
    };

    $scope.dateOptions = {
        dateDisabled: disabled,
        formatYear: 'yy',
        maxDate: new Date(2020, 5, 22),
        minDate: new Date(),
        startingDay: 1
    };

    // Disable weekend selection
    function disabled(data) {
        var date = data.date,
            mode = data.mode;
        return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
    }

    $scope.toggleMin = function () {
        $scope.inlineOptions.minDate = $scope.inlineOptions.minDate ? null : new Date();
        $scope.dateOptions.minDate = $scope.inlineOptions.minDate;
    };

    $scope.toggleMin();

    $scope.open1 = function () {
        $scope.popup1.opened = true;
    };

    $scope.open2 = function () {
        $scope.popup2.opened = true;
    };

    $scope.setDate = function (year, month, day) {
        $scope.dt = new Date(year, month, day);
        $scope.dt1 = new Date(year, month, day);
    };

    $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd/MM/yyyy', 'shortDate'];
    $scope.format = $scope.formats[2];
    $scope.altInputFormats = ['M!/d!/yyyy'];

    $scope.popup1 = {
        opened: false
    };
    $scope.popup2 = {
        opened: false
    };

    function getDayClass(data) {
        var date = data.date,
            mode = data.mode;
        if (mode === 'day') {
            var dayToCheck = new Date(date).setHours(0, 0, 0, 0);

            for (var i = 0; i < $scope.events.length; i++) {
                var currentDay = new Date($scope.events[i].date).setHours(0, 0, 0, 0);

                if (dayToCheck === currentDay) {
                    return $scope.events[i].status;
                }
            }
        }

        return '';
    }

    $scope.showDiv = false;

    $scope.animationsEnabled = true;

    $scope.openModal = function (size) {
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'jobView.html',
            controller: 'jobViewCtrl',
            size: size
        });
    };

    $scope.experience = {
        minValue: 3,
        maxValue: 15,
        options: {
            floor: 1,
            ceil: 50,
            step: 1,
            minRange: 4,
            pushRange: true,
            showSelectionBar: true,
            getSelectionBarColor: function (value) {
                return '#fecb16';
            }
        }
    };
    $scope.salary = {
        minValue: 2,
        maxValue: 10,
        options: {
            floor: 1,
            ceil: 50,
            step: 1,
            minRange: 3,
            pushRange: true,
            showSelectionBar: true,
            getSelectionBarColor: function (value) {
                return '#fecb16';
            }
        }
    };

    $scope.companyDisable = false;
    $scope.selectedCompany = "1";

}]);
