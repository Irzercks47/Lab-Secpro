<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session 8</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" integrity="sha512-wnea99uKIC3TJF7v4eKk4Y+lMz2Mklv18+r4na2Gn1abDRPPOeef95xTzdwGD9e6zXJBteMIhZ1+68QC5byJZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
    include './header.php'
    ?>
    <div class="mt-8 flex flex-col items-center">
        <div class="font-bold text-xl mb-12">
            Login
        </div>
        <form action="./controller/loginController.php" method="post">
            <input type="text" name="name" class="w-96 mb-4 shadow-sm block border-gray-300 rounded-md px-4 py-2 border border-gray-300 outline-none" placeholder="Name">
            <input type="text" name="password" class="w-96 shadow-sm block border-gray-300 rounded-md px-4 py-2 border border-gray-300 outline-none" placeholder="Password">
            <?php
                if(isset($_GET['error'])){
            ?>
                <div class="mt-4 text-red-500">
                    <?= $_GET['error'] ?>
                </div>
            <?php
                }
            ?>
            <button type="submit" class="bg-blue-500 text-white rounded-md w-full py-2 mt-4">Login</button>
        </form>
    </div>
</body>
</html>