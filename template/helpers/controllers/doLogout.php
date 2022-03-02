<?php
session_start();

#Question 1 Section 2 OF 2: Generate Session 
#Section Starts Here
session_destroy();
session_regenerate_id();
#Section Ends Here


exit(header('Location: ./../../index.php'));
