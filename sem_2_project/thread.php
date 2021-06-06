<?php
include 'partials/connect.php';
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $reply_submitted = false;
    $reply_uname = $_POST['name'];
    $reply = $_POST['reply'];
    $reply_thd_id = $_GET['thd_id'];
    $sql_new_reply_query = "INSERT INTO `reply` (`rply_id`, `rply_user_name`, `rply_desc`, `rply_timestamp`, `rply_thd_id`) VALUES (NULL, '$reply_uname', '$reply', current_timestamp(), '$reply_thd_id')";
    $result_of_reply_query = mysqli_query($conn, $sql_new_reply_query);
    if($result_of_reply_query){
        $reply_submitted = true;
    }
}

// $query = "SELECT * FROM information_schema.tables WHERE table_schema = 'onestop' AND table_name = 'users';";
// $result = mysqli_query($conn, $query);

// $result_bool = mysqli_num_rows($result);
// echo $result_bool;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32"
                style="padding-bottom: 10px; max-width: none;">
                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                    fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100" />
                </svg>

                <div>
                    <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                        <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start"
                            aria-label="Global" style="justify-content: space-between;">
                            <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                                <div class="flex items-center justify-between w-full md:w-auto">
                                    <a href="index2.php">
                                        <span class="sr-only">Workflow</span>
                                        <img class="h-8 w-auto sm:h-10"
                                            src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg">
                                    </a>
                                    <div class="-mr-2 flex items-center md:hidden">
                                        <button type="button"
                                            class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                                            aria-expanded="false">
                                            <span class="sr-only">Open main menu</span>

                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 6h16M4 12h16M4 18h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden md:block md:ml-10 md:pr-4 md:space-x-8">
                                <a href="categories.php"
                                    class="font-medium text-gray-500 hover:text-gray-900">Categories</a>
                                <?php
                                
                                if(!isset($_SESSION['loggedin']) OR $_SESSION['loggedin']!=true){
                                    echo '<a href="login.php" class="font-medium text-indigo-600 hover:text-indigo-500">Log in</a>';
                                }else{
                                    echo '<a href="logout.php" class="font-medium text-indigo-600 hover:text-indigo-500">Log out</a>';
                                }
                                ?>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container w-50">
        <?php
        $thd_id = $_GET['thd_id'];
        $sql_query = "SELECT * FROM `thread` WHERE thd_id=$thd_id";
        $result = mysqli_query($conn, $sql_query);
        $row = mysqli_fetch_assoc($result);
        $thd_q = $row['thd_q'];
        $thd_desc = $row['thd_desc'];
        $thd_user_name = $row['thd_user_name'];
        echo '<div class="card text-center"
        style="border-radius: 8px;border-width: 2px;border-color: #4f46e5;margin-top: 20px;">
        
        <div class="card-body">
            <h5 class="card-title" style="font-size: 1.5rem; font-family: \'Montserrat\', sans-serif; font-weight: bold;">'.$thd_q.'</h5>
            <p class="card-text">'.$thd_desc.'</p>
        </div>
        <div class="card-footer text-muted" style="border-top: none;">
            Posted By:- '.$thd_user_name.'
        </div>
        </div>';
        ?>
    </div>


    <div class="container w-50 mt-4">
        <?php
    $sql_request_reply = "SELECT * FROM `reply` WHERE rply_thd_id=$thd_id";
    $result_of_reply_request = mysqli_query($conn, $sql_request_reply);
    while($replies_row = mysqli_fetch_assoc($result_of_reply_request)){
        $reply_by = $replies_row['rply_user_name'];
        $reply_desc = $replies_row['rply_desc'];
        $time = $replies_row['rply_timestamp'];
    echo'
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4" style="width: 20%;">
                    <img src="assets/dp.png" alt="">
                </div>
                <div class="col-md-8" style="width: 80%;">
                    <div class="card-body">
                        <h5 class="card-title"><strong>'.$reply_by.'</strong></h5>
                        <p class="card-text">'.$reply_desc.'</p>
                        <p class="card-text"><small class="text-muted">'.$time.'</small></p>
                    </div>
                </div>
            </div>
        </div>';
    }
    ?>
    </div>

    <!-- <div class="container w-50 mt-4">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4" style="width: 20%;">
                    <img src="assets/dp.png" alt="">
                </div>
                <div class="col-md-8" style="width: 80%;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                            additional content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="container w-50 mt-4">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4" style="width: 20%;">
                    <img src="assets/dp.png" alt="">
                </div>
                <div class="col-md-8" style="width: 80%;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                            additional content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="container w-50 mt-4">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4" style="width: 20%;">
                    <img src="assets/dp.png" alt="">
                </div>
                <div class="col-md-8" style="width: 80%;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                            additional content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <?php
    if(!isset($_SESSION['loggedin']) OR $_SESSION['loggedin']!=true){
    echo'
    
        <div class="container w-50">
            <h1 class="display-6 mt-20"><strong>Reply to this thread</strong></h1>
            <div class="mb-3 mt-5">
                <label for="name" class="form-label">Your name</label>
                <input type="text" name="name" class="form-control" id="exampleFormControlInput1" style="border-color: #4f46e5;">
            </div>
            <div class="mb-3">
                <label for="Comment" class="form-label">Comment</label>
                <textarea class="form-control" name="reply" id="exampleFormControlTextarea1" rows="5" style="border-color: #4f46e5;"></textarea>
            </div>
        </div>

        <div class="container w-50 mb-5 mt-20">
            <a class="btn btn-primary" style="background-color: #4f46e5; border-color: #4f46e5;" href="login.php"
            role="button">Reply</a>
        </div>
    ';
    }
    else{
        echo'
        <form action="thread.php?thd_id='.$thd_id.'" method="POST">
            <div class="container w-50">
                <h1 class="display-6 mt-20"><strong>Reply to this thread</strong></h1>
                <div class="mb-3 mt-5">
                    <label for="name" class="form-label">Your name</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" style="border-color: #4f46e5;" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="Comment" class="form-label">Comment</label>
                    <textarea class="form-control" name="reply" id="exampleFormControlTextarea1" rows="5" style="border-color: #4f46e5;"></textarea>
                </div>
            </div>
    
            <div class="container w-50 mb-5 mt-20">
                <button class="btn btn-primary" style="background-color: #4f46e5; border-color: #4f46e5;"
                role="button">Reply</button>
            </div>
        </form>'; 
    }
    ?>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>

    <div class="container w-50">
    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if($reply_submitted){
            echo'
            <div class="alert alert-success alert-dismissible d-flex align-items-center fade show" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
              <div>
                Reply added
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }
        if(!$reply_submitted){
            echo'
            <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
              <div>
                Reply not added. Try again.
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }
    }
    
    ?>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->

</body>

</html>