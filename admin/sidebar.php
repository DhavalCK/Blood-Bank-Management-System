<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Admin Panel</title>
    <style>
        .list-group-item {
            background-color: transparent !important;

        }


        .list-group-item a {
            color: white !important;
        }
        
        .list-group-item:hover,
        .active {
             background-color: #a8c0ff!important;
                background-image:radial-gradient(circle, #0d28ea, #0e0e0efa)!important;
                color: black!important; 
            border: 1px solid white;
        }
    </style>
</head>

<body>
    <div class="col-lg-2 m-0 p-0" style="background-image:linear-gradient(to bottom,  #181ff3bf, #0af1bbb0);">
        <div class="bg-light text-center p-3"><img src="../img/icon1.png" width="150px"></div>
        <ul class="list-group">
            <li class="list-group-item"><a class="pr-6 py-2 font-weight-bold" href="admin_panel.php">Home</a></li>
            <li class="list-group-item"> <a class="pr-6 py-2 font-weight-bold" href="mng_bb.php">Manage Blood Bank</a></li>
            <li class="list-group-item"><a class="pr-6 py-2 font-weight-bold" href="mng_dnr_req.php">Manage Donor Request</a></li>
            <li class="list-group-item"><a class="pr-6 py-2 font-weight-bold" href="mng_pat_req.php">Manage Blood Request</a></li>
            <li class="list-group-item"><a class="pr-6 py-2 font-weight-bold" href="adminlogout.php">Logout</a></li>
        </ul>

    </div>
    <script type="text/javascript">
        const currentLocation = location.href;
        const menuItem = document.querySelectorAll('a');
        const menuLi = document.querySelectorAll('li');
        const menuLength = menuItem.length;
        for (let i = 0; i < menuLength; i++) {
            if (menuItem[i].href == currentLocation) {
                menuLi[i-1].className = "list-group-item active";
                
            }
        }
    </script>
</body>

</html>