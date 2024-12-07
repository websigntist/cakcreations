<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>USPS API</title>
  </head>
  <body>
    <div class="container">
        <div class="row mb-5"></div>
        <div class="row">
            <div class="col-md-12">
                <form action="process.php" method="post">
                    <h3>Shipping Information</h3>
                    <label for="first_name">First Name</label>
                    <input value="John" type="text" id="first_name" name="first_name" class="form-control" placeholder="First name of the person">
                    <label for="last_name">Last Name</label>
                    <input value="Doe" type="text" id="last_name" name="last_name" class="form-control" placeholder="Last name of the person">
                    <label for="phone">Phone</label>
                    <input value="5555551234" type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number of person">
                    <label for="address_1">Address 1 (optional)</label>
                    <input value="SUITE K" type="text" id="address_1" name="address_1" class="form-control" placeholder="Delivery Address in the destination address. May contain secondary unit designator, such as APT or SUITE, for Accountable mail.)">
                    <label for="address_2">Address 2 (required)</label>
                    <input value="29851 Aventura" type="text" id="address_2" name="address_2" class="form-control" placeholder="Delivery Address in the destination address. Required for all mail and packages, however 11-digit Destination Delivery Point ZIP+4 Code can be provided as an alternative in the Detail 1 Record.">
                    <label for="city">City (optional)</label>
                    <input value="" type="text" id="city" name="city" class="form-control" placeholder="City name of the destination address.">
                    <label for="state">State (optional)</label>
                    <input value="CA" type="text" id="state" name="state" class="form-control" placeholder="Two-character state code of the destination address.">
                    <label for="zip_5">Zip5 (optional)</label>
                    <input value="92688" type="text" id="zip_5" name="zip_5" class="form-control" placeholder="Destination 5-digit ZIP Code. Numeric values (0-9) only. If International, all zeroes.">
                    <label for="zip_4">Zip4 (optional)</label>
                    <input value="" type="text" id="zip_4" name="zip_4" class="form-control" placeholder="Destination ZIP+4 Numeric values (0-9) only. If International, all zeroes. Default to spaces if not available.">

                    <hr>
                    <h3>Package Details</h3>
                    <label for="pounds">Pounds (required)</label>
                    <input value="8" type="text" id="pounds" name="pounds" class="form-control" placeholder="Value must be numeric. Package weight cannot exceed 70 pounds. ">
                    <label for="pounds">Ounces (required)</label>
                    <input value="2" type="text" id="ounces" name="ounces" class="form-control" placeholder="Value must be numeric. Package weight cannot exceed 70 pounds (1120 ounces).">
                    <label for="width">Width (optional)</label>
                    <input type="text" id="width" name="width" class="form-control" placeholder="Value must be numeric. Units are inches.">
                    <label for="length">Length (optional)</label>
                    <input type="text" id="length" name="length" class="form-control" placeholder="Value must be numeric. Units are inches.">
                    <label for="height">Height (optional)</label>
                    <input type="text" id="height" name="height" class="form-control" placeholder="Value must be numeric. Units are inches.">
                    <label for="height">Girth (optional)</label>
                    <input type="text" id="girth" name="girth" class="form-control" placeholder="Value must be numeric. Units are inches.">
                    

                    <hr>
                    <button  name="submit" type="submit" class="btn btn-success float-right mb-5">Submit</button>
                    
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>