<?php
include "partials/connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                                <a href="index2.php" class="font-medium text-gray-500 hover:text-gray-900">Home</a>
                                <?php
                                session_start();
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

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-wrap w-full mb-20">
                    <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">Explore Topics</h1>
                        <div class="h-1 w-20 bg-blue-500 rounded" style="background-color: #4f46e5;"></div>
                    </div>
                    <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">Start discussing about your favourite
                        topics and explore more topics on the go!</p>
                </div>
                <div class="flex flex-wrap -m-4">
                    <?php
                    $sql_categories_query = "SELECT * FROM `categories`";
                    $result = mysqli_query($conn, $sql_categories_query);
                    while($row = mysqli_fetch_assoc($result)){
                        $ctg_name = $row['ctg_name'];
                        $ctg_desc = $row['ctg_desc'];
                        $ctg_id = $row['ctg_id'];
                        echo '<div class="xl:w-1/4 md:w-1/2 p-4">
                                <div class="bg-gray-100 p-6 rounded-lg">
                                    <img class="h-40 rounded w-full object-cover object-center mb-6"
                                        src="https://dummyimage.com/720x400" alt="content">
                                    <h3 class="tracking-widest text-blue-500 text-xs font-medium title-font"
                                        style="color: #4f46e5;">Category</h3>
                                    <h2 class="text-lg text-gray-900 font-medium title-font mb-4"><a href="forum.php?ctgid='.$ctg_id.'">'.$ctg_name.'</a></h2>
                                    <p class="leading-relaxed text-base">'.substr($ctg_desc, 0, 150).'...</p>
                                </div>
                            </div>';
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>

</body>

</html>