<?php

include "dbconfig.php";

if(isset($_GET['newCar'])){
    header("Location:addNewCar.php");
}


if(isset($_GET['edit'])){
    $car_Id = $_GET['car_Id'];
    header("location:editCar.php?car_Id=$car_Id");
}

if(isset($_GET['delete'])){
    $car_Id = $_GET['car_Id'];
    
    $sqlDelete = "DELETE FROM car WHERE car_Id = $car_Id";
    $resDelete = mysqli_query($conn, $sqlDelete);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>CRUD</h1>
      <a href="index.php?newCar" ><button class="btn btn-primary">New Car</button></a>
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Color</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sqlRead = "SELECT * FROM car";
                $resultRead = mysqli_query($conn, $sqlRead);

                if(mysqli_num_rows($resultRead) > 0){
                    while($row = mysqli_fetch_assoc($resultRead)){
                        echo ' 
                        <tr>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['color'].'</td>
                            <td>'.$row['price'].'</td>
                            <td><img src="upload_img/' . $row['image'] . '" width="175" height="100"/></td>
                            <td>
                            <form>
                                <input type="hidden" name="car_Id" value="'.$row['car_Id'].'">
                                <button class="btn btn-primary" name="edit">Edit</button>
                                <button class="btn btn-danger" name="delete">Delete</button>
                            </form>
                        </td>
                       </tr>';
                    }
                } else {
                    echo '
                    <tr>
                    <td colspan="5">
                        Empty table!
                    </td>
                    </tr>
                    ';
                }
            ?>
       
               
            </tbody>
        </table>
    </div>
</body>

</html>