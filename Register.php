<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Uniforum</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 style="text-align:center"> Registration Form </h1>

        <?php if(!empty($msg)){echo $msg;} $msg=""; ?>
        <form action="Register_connect.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>First Name</label>
                    <input type="varchar" class="form-control" name="First_Name" size="20" placeholder="FirstName" value="<?php if(!empty($_POST['First_Name'])) {echo $_POST['First_Name'];} ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Last Name</label>
                    <input type="varchar" class="form-control" name="Last_Name" size="20" placeholder="LastName">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Sap ID</label>
                    <input type="int" class="form-control" name="Sap_ID" size="12" placeholder="Sap-ID">
                </div>
                <div class="form-group col-md-6">
                    <label>Stream</label>
                    <select type="text" class="form-control" name="Stream"  placeholder="Stream">
                        <option> </option>
                        <option>CCVT</option>
                        <option>AIML</option>
                        <option>CSF</option>
                        <option>DevOps</option>
                        <option>GG</option>
                     </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Email</label>
                    <input type="varchar" class="form-control" name="Email" size="20" placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                    <label>Gender</label>
                    <select type="Char" class="form-control" name="Gender" placeholder="Gender">
                        <option> </option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Others</option>
                     </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Username</label>
                    <input type="varchar" class="form-control" name="Username" size="20" placeholder="Username">
                </div>
                <div class="form-group col-md-6">
                    <label>Password</label>
                    <input type="varchar" class="form-control" name="Password" size="16" placeholder="Password">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Mobile</label>
                    <input type="int" class="form-control" name="Mobile" size="15" placeholder="Mobile Number">
                </div>
                <div class="form-group col-md-6">
                    <label>Date of Birthday</label>
                    <input type="date" class="form-control" name="DateOfBirth"  placeholder="DoB">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
    </div>
</body>

</html>