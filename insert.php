
<?php
include_once('connect.php');
if ($conn->connect_error) {
    die("Không kết nối :" . $conn->connect_error);
    exit();
}


//Khai báo giá trị ban đầu, nếu không có thì khi chưa submit câu lệnh insert sẽ báo lỗi
$Lng = "";
$Lat = "";
$Phone = "";
$Location ="";
$Type = "";
$Name = "";
//Lấy giá trị POST từ form vừa submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["Name"])) { $Name = $_POST['Name']; }
    if(isset($_POST["Latitude"])) { $Lat = $_POST['Latitude']; }
    if(isset($_POST["Longitude"])) { $Lng = $_POST['Longitude']; }
    if(isset($_POST["Location"])) { $Location = $_POST['Location']; }
    if(isset($_POST["Type"])) { $Type = $_POST['Type']; }
    if(isset($_POST["Phone"])) { $Phone = $_POST['Phone']; }

    //Code xử lý, insert dữ liệu vào table
    $sql = "INSERT INTO location (Latitude, Longitude, Name, Phone, Location, Type)
    VALUES ('$Lat', '$Lng', '$Name', '$Phone', '$Location', '$Type')";

    if ($conn->query($sql) === TRUE) {
        echo "Sucessfull!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
header('Location: admin.php');
die();
}
$conn->close();
?>

<html>
<head>
    <title>Quản lý địa điểm</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href='custom.css' rel='stylesheet' type='text/css'>
    <title>Quản Lý</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	
	<button class="btn btn-success" onclick="window.open('admin.php', '_self')">Quản lý</button>
	<button class="btn btn-success" onclick="window.open('index.php', '_self')">Map</button>
</head>

<body>

    <div class="container">

        <div class="row">

            <div class="col-xl-8 offset-xl-2 py-5">

                <h1>Thêm địa điểm</h1>
                <form id="contact-form" method="post" action="" role="form">

                    <div class="messages"></div>

                    <div class="controls">
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_name">Name</label>
                                    <input id="form_name" name="Name" class="form-control" placeholder="Name" rows="1" required="required" data-error="Please enter Name"></input>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_lat">Latitude *</label>
                                    <input id="form_lat" type="double" name="Latitude" class="form-control" placeholder="Latitude" required="required" data-error="Please enter Latitude *">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_lng">Longitude *</label>
                                    <input id="form_lng" type="double" name="Longitude" class="form-control" placeholder="Longitude" required="required" data-error="Please enter Longitude">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_location">Location</label>
                                    <input id="form_location" type="text" name="Location" class="form-control" placeholder="Location" required="required" data-error="Please enter Location">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_need">Store Type</label>
                                    <select id="form_need" name="Type" class="form-control" required="required" data-error="Please choose type.">
                                        <option value="1">CircleK</option>
                                        <option value="2">Vinmart</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_phone">Phone Number</label>
                                    <input id="form_phone" type = "text" name="Phone" class="form-control" placeholder="Phone Number" required="required" data-error="Please, enter phone number"></input>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-success btn-send" value="Submit">
                            </div>
                        </div>
                        
                    </div>

                </form>

            </div>
            <!-- /.8 -->

        </div>
        <!-- /.row-->

    </div>
    <!-- /.container-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js" integrity="sha256-dHf/YjH1A4tewEsKUSmNnV05DDbfGN3g7NMq86xgGh8=" crossorigin="anonymous"></script>
    <script src="contact.js"></script>
</body>

</html>