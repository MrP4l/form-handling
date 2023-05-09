<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Welcome</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="homepage.css">
    </head>
    <body>
    
    <div id="firstContainer">
        <div id="firstBackgroundImage"></div>
        <div id="mainContainer" class="position-relative">
            <div id="titleContainer">
                <h1 id="title" class="display-4 text-light">Become part of our group, over 150 companies have made the right choice.</h1>
            </div>
            <div id="buttonContainer">
                <button id="joinUsButton" type="button" class="btn btn-outline-light btn-lg">Join us</button>
                <button id="logInButton" type="button" class="btn btn-outline-light btn-lg">Log in</button>
            </div>
        </div>
    </div> 

    <div id="secondContainer">
        <div id="secondBackgroundImage"></div>
        <div id="formContainer">
            <form action="registrationForm.php" method="post" class="row g-3 has-validation" id="form">
                <div class="col-md-6">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="Jesse" required>
                </div>
                <div class="col-md-6">
                  <label for="surname" class="form-label">Surname</label>
                  <input type="text" name="surname" class="form-control" id="surname" placeholder="Pinkman" required>
                </div>
                <div class="col-md-6">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <div class="col-md-6">
                  <label for="companyName" class="form-label">Company Name</label>
                  <input type="text" name="companyName" class="form-control" id="companyName" required>
                </div>
                <div class="col-md-6">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="col-md-6">
                  <label for="confirmPassword" class="form-label">Confirm Password</label>
                  <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" required>
                  <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Password doesn't match.
                  </div>
                </div>
                <div class="col-12">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" name="address" class="form-control" id="address">
                </div>
                <div class="col-md-6">
                  <label for="city" class="form-label">City</label>
                  <input type="text" name="city" class="form-control" id="city">
                </div>
                <div class="col-md-4">
                  <label for="state" class="form-label">State</label>
                  <select id="state" name="state" class="form-select">
                    <option selected required>Choose...</option>
                    <option>Italy</option>
                    <option>Germany</option>
                    <option>England</option>
                    <option>Spain</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="inputZip" class="form-label">Zip</label>
                  <input type="text" class="form-control" id="inputZip">
                </div>
                <div class="col-12">
                  <button type="submit" name="submit" class="btn btn-primary" id="submit">Sign in</button>
                </div>
            </form>
        </div>
    </div>

    <div id="thirdContainer">
        <div id="thirdBackgroundImage"></div>
        <div id="secondFormContainer">
            <form action="login.php" method="post" class="row g-3 needs-validation">
                <div class="col-md-12">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <div class="col-md-15">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="col-15">
                  <button type="submit" class="btn btn-primary">Log in</button>
                </div>
            </form>
        </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" async defer></script>
        <script src="homepage.js" async defer></script>
    </body>
</html>

