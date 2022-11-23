<?php 
include "dbconfig.php";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $color = $_POST['color'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];

    if($name == "" || $color == "" || $price == "" || $image == ""){
        echo '<div class="alert alert-danger" role="alert">
                Error: Please Complete all fields!
              </div>';
    } else{
        $sqlCreate = "INSERT INTO car (name, color, price, image) VALUES ('$name', '$color', '$price', '$image')";
        $resultCreate = mysqli_query($conn, $sqlCreate);
        if($resultCreate){
            move_uploaded_file($_FILES['image']['tmp_name'],"upload_img/". $_FILES['image']['name']);
        }
        echo '<div class="alert alert-primary" role="alert">
            Successful Added!
        </div>';
        
    }
}

if(isset($_POST['cancel'])){
    header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Car</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Add new car</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name here">
                <label>Color</label>
                <input type="text" class="form-control" name="color" placeholder="Enter color here">
                <label>Price</label>
                <input type="number" class="form-control" name="price" placeholder="Enter price here">
                <label>Image</label>
                <input type="file" class="form-control" name="image" placeholder="Enter name here">
                <br>
                <button class="btn btn-primary" name="submit">Submit</button>
                <button class="btn btn-danger" name="cancel">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>