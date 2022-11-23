<?php 
include "dbconfig.php";

$car_Id = $_GET['car_Id'];

if(isset($_POST['cancel'])){
    header("Location:index.php");
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $color = $_POST['color'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];

    $sqlUpdate = "UPDATE car SET name = '$name', color = '$color', price = '$price', image = '$image' WHERE car_Id = '$car_Id'";
    $resUpdate = mysqli_query($conn, $sqlUpdate);
    if($resUpdate){
        move_uploaded_file($_FILES['image']['tmp_name'],"upload_img/". $_FILES['image']['name']);
    }
    echo '<div class="alert alert-primary" role="alert">
        Successful Updated!
    </div>';
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit New Car</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Edit new car</h1>
        <?php
        
        $selectCar = "SELECT * FROM car WHERE car_Id = $car_Id";
        $resCar = mysqli_query($conn, $selectCar);

        if(mysqli_num_rows($resCar) >= 1){
            $row = mysqli_fetch_assoc($resCar);
        }

        ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $row["name"] ?>" >
                <label>Color</label>
                <input type="text" class="form-control" name="color" value="<?php echo $row['color'] ?>">
                <label>Price</label>
                <input type="number" class="form-control" name="price" value="<?php echo $row['price'] ?>">
                <label>Image</label>
                <input type="file" class="form-control" name="image" value="<?php echo $row['image'] ?>" >
                <br>
                <button class="btn btn-primary" name="submit">Submit</button>
                <button class="btn btn-danger" name="cancel">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>