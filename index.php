<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="">
        <h1>Welcome to Dashboard</h1>
        <a href="logout.php" class="btn btn-dark">Logout</a>
        <a href="create.php" class="btn btn-dark ms-3">Add new Book</a>
    </div>
   
<div class="Container my-5">
    <form method="get" action="index.php" class="mb-3">
        <label for="limitSelect" class="form-label">Items per Page:</label>
        <select name="limit" id="limitSelect" >  
            <option value="">Select limit</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <button type="submit" class="btn btn-dark">Apply</button>
    </form>
</div>

    
   
<div class="my-5">
    <h2 class='heading'>BOOK LIST</h2>
<table class="table">
  <thead class="bg-dark text-light">
    <tr>
      <th scope="col">Sl no</th>
      <th scope="col">Title</th>
      <th scope="col">Content</th>
      <th scope="col">Published on</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>

  <?php
    include('database.php');
    $limit = isset($_GET['limit']) ? $_GET['limit'] : 3;
    $sql="SELECT * FROM books";
    $result=mysqli_query($conn,$sql);
    $numRows=mysqli_num_rows($result);
    $totalPages=ceil($numRows/$limit);
    $page=isset($_GET['page']) ? $_GET['page'] : 1;
    $page = max(1, intval($page));
    $start =($page-1)*$limit;
    $previous= $page-1;
    $next=$page+1;
    
    //creating pagination buttons

    echo '<button class="page-item btn btn-dark mb-5"><a class="page-link" href="index.php?limit='.$limit.'&page=' . $previous . '">Previous</a></button>';
    for($btn=1;$btn<=$totalPages;$btn++){
        echo '<button class="page-item btn btn-dark mx-1 mb-5"><a class="page-link " href="index.php?limit='.$limit.'&page='.$btn.'">'.$btn.'</a></button>';
   }
    if($next <= $totalPages)
    echo'<button class="page-item btn btn-dark  mb-5"><a class="page-link" href="index.php?limit='.$limit.'&page=' . $next . '">Next</a></button>';
    
    $sql = "SELECT * FROM books LIMIT " . $start . " , " . $limit;
    $result=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_assoc($result)){
        echo ' <tr>
        <th scope="row">'.$row['id'].'</th>
        <td>'.$row['title'].'</td>
        <td>'.$row['content'].'</td>
        <td>'.$row['date'].'</td>
        <td><a href="view.php?id='.$row['id'].'" class="btn btn-dark">Read more</a></td>
      </tr>';
    }
    ?>   
  </tbody>
</table>
</div>
</body>
</html>
