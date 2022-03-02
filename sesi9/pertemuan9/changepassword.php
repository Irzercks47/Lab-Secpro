<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - Media Sosial</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php
    session_start();
    function csrf_token()
    {
        if (!isset($_SESSION["token"])) {
            $_SESSION["token"] = bin2hex(random_bytes(16));
        }
        return $_SESSION["token"];
    }
    ?>
    <div class="bg-red-600">
        <div class="mx-auto flex items-center py-2 gap-1 text-white w-11/12">
            <div class="font-bold mr-auto">Forum</div>
            <a href="index.php" class="font-semibold px-4 py-2 hover:bg-white/20">Home</a>
            <a href="changepassword.php" class="font-semibold px-4 py-2 hover:bg-white/20">Change Password</a>
        </div>
    </div>
    <div class="mx-auto mt-4 flex flex-col gap-2" style="width: 27rem">
        <h1 class="mx-auto mb-4 font-semibold text-3xl underline underline-offset-8">
            Change Password
        </h1>
        <form action="changepasswordcontroller.php" method="post" class="grid grid-cols-3 gap-4 grid-rows-auto border border-black rounded p-4 mb-0">
            <label for="new-password" class="font-semibold p-2">New Password</label>
            <input type="password" name="new-password" id="new-password" placeholder="New Password" class="col-span-2 border-2 border-gray-400 rounded p-2">
            <button class="col-span-3 bg-red-600 text-white font-semibold rounded px-4 py-2">
                Change password
            </button>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        </form>
    </div>
</body>

</html>