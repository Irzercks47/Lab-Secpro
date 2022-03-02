<?php 
/**
 * Initialization Script
 * ---------------------
 * This script base on Initialization Script
 * by AS14-0 (Albert Richard Sanyoto)
 * 
 * With some edited code on following function:
 *  --> Drop All Tables 
 *  --> Create All Tables 
 *  --> Insert Data Seeder 
 *  --> Add Dynamically Bind Params in Prepared Statements with MySQLi 
 */

/**
 * Initialization Script
 * ---------------------
 * Copyright © 2018 by SW16-2 (Kevin Surya Wahyudi)
 * All rights reserved.
 */

/**
 * WARNING!!!
 * Do not modify the code below unless you know how to read and write the script.
 */

/**
 * INITIALIZATION SCRIPT HTML TAGS
 * These are the essential tags to form the HTML page of the initialization report
 */

// require_once('helpers/function.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Initialization Script</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-dark">
    <div class="container-fluid mt-3 mb-3">
        <header class="jumbotron text-center">
            <h1 class="title">Initialization Script</h1>
        </header>
        <article>
<?php
/**
 * DATABASE CONFIGURATION
 * This is the configuration for the mysql connection
 * The default setting should be the default configuration of MySQL in Laboratory classes
 * 
 * ALERT!!!
 * DATABASE `information_schema` MUST BE EXISTS BEFORE USING THIS SCRIPT
 */
$config = array(
	'server' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'sodiblog_db',
);

/**
 * INITIALIZATION SCRIPT VARIABLES
 * This is the supporting variables required for this initialization script to run
 */
function create_report($title, $content){
    $report_template = 
    "<div class='card mb-3'>
        <div class='card-header'>{{title}}</div>
        <div class='card-body'>
            {{row}}
        </div>
    </div>";

    $row_template = 
    "<div class='row'>
        <div class='col-lg-12 col-md-12 col-sm-12'>
            {{body}}
        </div>
    </div>";

    $body_contents = [];
    if(is_array($content)){
        $body_contents = $content;
    }
    else{
        $body_contents[] = $content;
    }
    $report_string = str_replace("{{title}}", $title, $report_template);
    $row_string = "";
    foreach($body_contents as $body){
        $row_string .= str_replace("{{body}}", $body, $row_template);
    }
    $report_string = str_replace("{{row}}", $row_string, $report_string);
    return $report_string;
}

/**
 * PRE INTIALIZATION CHECK
 * Check whether the website has been initialized.
 * If the website has been initialized, a force command must be given for the script to reinitialize everything.
 */ 
$preflight = new mysqli($config['server'], $config['username'], $config['password'], 'information_schema');
if($preflight->connect_error){
    $message = "Pre-initialization connect failed: $preflight->connect_error";
    die(create_report("Preflight Report", $message));
}

$db = "CREATE DATABASE IF NOT EXISTS " . $config['database'];
$preflight->query($db);
$preflight->select_db($config['database']);

$initialized = false;
$force = false;

$init_var_check = "SELECT `value` FROM app_config WHERE `key` = 'initialized' AND value = 1";
$check = $preflight->query($init_var_check);
if($check){
    $result = $check->fetch_assoc();
    if($result && $result['value']){
        $initialized = true;
    }
}

$preflight->close();

if($initialized){
    $force_param = isset($_REQUEST['force']);
    if($force_param){
        $preflight_report_string = create_report("Preflight Report", "Data has been initialized. Force initialization is issued. This initialization script will re-initialize the application.");
        $force = true;
    }
    else{
        $preflight_report_string = create_report("Preflight Report", [
            "Data has been initialized. Please add force parameter if you want to re-initialize the application.", 
            "<a href='?force' class='btn btn-warning'>Force Initialization</a><a href='/' class='btn btn-primary'>Open Website</a>"
        ]);
    }
}
else{
    $preflight_report_string = create_report("Preflight Report", "Application is ready for initialization.");
}
echo($preflight_report_string);

/**
 * INITIALIZATION
 * Initialization will initializes everything required by the website
 * This step may only be run if the website has not been
 * initialized or it is forced to initialize
 */
if(!$initialized || $force){
    /**
     * MYSQL CONNECTION
     * This step initializes the MySQLi Instance for executing database queries.
     */
    $connection = new mysqli($config['server'], $config['username'], $config['password'], $config['database']);
    if($connection->connect_error){
        $message = "Failed to connect to database: $connection->connect_error";
        die(create_report("MySQLi Connect Report", $message));
    }
    $connection->set_charset("utf8");

    $message = "Successfully established database connection to " . $config['database'] . "@" . $config['server'] . " with username " . $config['username'];
    echo(create_report("MySQLi Connect Report", $message));
    
    /**
     * PREPARATION STEP
     * This step for preparation all the tables required for the website to work properly.
     */
    // all tables in the database
    $tables = "4 tables (tblarticle, tblcomments, tblusers, app_config)";    

    /**
     * TABLE SCHEMA DROPPING
     * This step deleted the tables required if already exists on the database for the website to work properly.
     */

    // All query for DROP TABLE
    $drop_tables = [
        "DROP TABLE IF EXISTS tblarticles",
        "DROP TABLE IF EXISTS tblcomments",
        "DROP TABLE IF EXISTS tblusers",
        "DROP TABLE IF EXISTS app_config",
    ];

    foreach($drop_tables as $drop){
        if(!$connection->query($drop)){
            $message = "Drop tables failed: $connection->error";
            die(create_report("Table Schema Dropping Report", $message));
        }
    }

    echo(create_report("Table Schema Dropping Report", "Successfully drops all $tables"));

    /**
     * TABLE SCHEMA CREATION
     * This step builds the tables required for the website to work properly.
     */

    // All query for Query CREATE TABLE
    $create_tables = [
    	"
    		CREATE TABLE `tblusers` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`user_fullname` varchar(255) NOT NULL,
				`user_email` varchar(255) NOT NULL,
				`user_password` varchar(255) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		",
        "
        	CREATE TABLE `tblarticles` (
	  			`id` int(11) NOT NULL AUTO_INCREMENT,
				`article_title` varchar(255) NOT NULL,
				`article_source` varchar(255) NOT NULL,
				`article_contents` text NOT NULL,
				`article_image` varchar(255) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		",
		"
			CREATE TABLE `tblcomments` (
			  	`id` int(11) NOT NULL AUTO_INCREMENT,
			  	`article` int(11) NOT NULL,
			  	`commenter` int(11) NOT NULL,
			  	`comment_content` text,
			  	PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		",
        "
        	CREATE TABLE `app_config` (
	            `key` VARCHAR(15),
	            `value` BOOLEAN,
	            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	            PRIMARY KEY (`key`)
        	)
        ",
    ];

    foreach($create_tables as $create){
        if(!$connection->query($create)){
            $message = "Table creation failed: $connection->error";
            die(create_report("Table Schema Creation Report", $message));
        }
    }

    echo(create_report("Table Schema Creation Report", "Successfully creates all $tables"));

    /**
     * DATA SEEDER
     * This step fills the database with dummy data that could be used to simulate a working website.
     */

    // All query for INSERT TABLE
    $insert_tables = [
        "INSERT INTO `tblusers` (`user_fullname`, `user_email`, `user_password`) VALUES (?, ?, ?)",
        "INSERT INTO `tblarticles` (`article_title`, `article_source`, `article_contents`, `article_image`) VALUES (?, ?, ?, ?)",
        "INSERT INTO `tblcomments` (`article`, `commenter`, `comment_content`) VALUES (?, ?, ?)",
		"INSERT INTO `app_config` (`key`, `value`) VALUES (?, ?)"
    ];

    // Generate dummy article
    $dummy_article = [
        [ 
        	"ssss",  
        	"Salt: The Reason for Weight Gain?", 
			"Monica Reinagel, MS, LD/N, CNS Nutrition Diva",
        	"People who eat more salt tend to weigh more. But maybe not for the reasons you think.\n\nEating a lot of salt can cause your body to retain more water, which can show up on the scale as extra pounds. But we’re not just talking about water weight here. High salt diets appear to be linked to higher body fat—in particular, the kind of fat that accumulates around your middle.\n\nThere are a few obvious explanations for this. First, just think about what kinds of foods tend to be higher in salt: snacks, chips, fast food, fried foods, processed foods, and restaurant meals. It might also surprise you to know that bread is one of the primary sources of sodium in the Western diet.\n\nAll of these high-sodium foods are also relatively high in calories. Not only that, they are notoriously easy to overeat. So, if your diet contains a lot of snacks, chips, bread, fried foods, and restaurant meals, you’re not only going to be consuming a lot of salt, but probably also a lot more calories. That could certainly explain the link between sodium and weight.\n\nThere are some other possible explanations. Taking in more sodium can also increase your appetite, leading you to eat more. Salty foods can also make you thirsty, which could increase your intake of caloric beverages like soda or beer. (That’s certainly what they’re hoping when they put those bowls of salty snacks out in bars!)\n\nIf high-sodium diets are more likely to be high-calorie diets, then it’s not exactly a mystery why people who eat more salt also weigh more. But then a 2015 study found that higher sodium intake was linked to higher body weight and larger waist circumference—even when calorie intake was not higher.\n\nThat’s a little harder to explain. But some new research suggests that the link between sodium and obesity could also involve the microbiome. (Lately, it seems as if all roads lead to the microbiome, doesn’t it?)\n\nDominick Müller’s research group at the Max Dellbrück Center for Molecular Medicine in Berlin just released data from a new study showing that high-sodium diets may kill off the beneficial lactobacillus bacteria in our guts—which may set us up for weight gain. Conversely, moderating our sodium intake may help us maintain healthier gut flora, which is associated with healthier body weight. Who saw that coming?\n\nHigh-sodium diets also tend to increase blood pressure, of course. We’ve always assumed that this has to do with how sodium intake affects water retention and blood volume. But could the change in gut bacteria play a role? Potentially, yes.",
        	"salt-sprinkle.jpg"
        ],
		[ 
        	"ssss",  
        	"Myths and Facts About MSG", 
			"Food Insight (Megan Meyer, PhD, Anthony Flood)",
        	"These days, there are too many food myths to count. Even with so much noise out there, some common myths continue to capture our attention. Some of these common misperceptions center on monosodium glutamate, or MSG. It's about time we expose a few of the common myths you may have heard.\n\nBut first, what exactly is MSG? MSG is created when sodium and glutamate (an amino acid that is found in both plant and animal proteins) are combined. It is naturally occurring in tomatoes, Parmesan cheese, walnuts, sardines, mushrooms, clams, meat and asparagus. MSG is also used as a flavoring component in foods to bring out savory, umami flavors to a dish.\n\nMyth #1: \"MSG gives me headaches and other problems.\"\n\nOver the years, we have seen anecdotal reports linking MSG to headaches and nausea. Ever since the first incidents were reported, there's been no strong, medical evidence to support these claims. The FDA investigated some of these claims and has \"never been able to confirm that the MSG caused the reported effects.\" In addition, the FDA commissioned a group of independent scientists from the Federation of American Societies for Experimental Biology to examine the safety of MSG in the 1990s. The FASEB report determined that MSG is safe.\n\nMyth #2: \"I'm allergic to MSG.\"\n\nFirst off, MSG is not an allergen, so it will not cause allergies. The FDA, leading health authorities, consumer advocates and researchers in the field have identified eight common known allergens: wheat, soy, peanuts, tree nuts, fish, shellfish, eggs and milk. These allergens are the leading foods that cause the majority of reactions to individuals. Furthermore, decades of research have failed to demonstrate that MSG causes allergic reactions. However, if you're having an allergic reaction dial 911 or consult a health provider immediately.\n\nMyth #3: \"'No added MSG' does not mean there's no MSG in the food.\"\n\nEven if it's not added to food, MSG can still be present in the food since it's just sodium and an amino acid, glutamate. Because of this, MSG is naturally occurring in many popular foods, ranging from cheese and meat to fermented sauces and some produce.\n\nThe bottom line is that MSG is safe and the circulating myths around it are not aligned with the scientific consensus. So, the next time you hear someone tell you a familiar myth about MSG, feel free to debunk it and remember the facts.",
        	"msg-on-a-spoon.jpg"
        ],
		[ 
        	"ssss",  
        	"Saffron: The Jewelry of Spices", 
			"Cydney Grannan",
        	"Saffron, golden-coloured, pungent stigmas (pollen-bearing structures) of the autumn crocus (Crocus sativus), which are dried and used as a spice to flavour foods and as a dye to colour foods and other products. Saffron has a strong, exotic aroma and a bitter taste and is used to colour and flavour many Mediterranean and Asian dishes, particularly rice and fish, and English, Scandinavian, and Balkan breads. It is an important ingredient in bouillabaisse soup.\n\nThe ancient Greeks and Romans used saffron as perfume, and saffron is mentioned in the Chinese materia medica from the 1550s. Today the herb is also used as a cooking spice and a clothing dye. It's now an essential part of some Eastern, Middle Eastern, and European dishes, such as the French bouillabaisse, Spanish paella, Moroccan tagines, and many more dishes. Saffron, however, is a very expensive spice. Real saffron can cost you over $10,000 per kilogram. Its costliness has to do with its harvesting. Only a small amount of each saffron flower is used, and all harvesting must be done by hand.\n\nSaffron is believed to be native to the Mediterranean, Asia Minor, and Iran, although Spain, France, and Italy are also now primary cultivators of the spice. The spice we think of when we hear \"saffron\" is actually only a small part of the plant itself. Saffron (Crocus sativus) is a purple flower. What we use for that distinctive yellow color, sweet-herb smell, and bitter taste is actually the stigma (plural stigmata), the pollen-germinating part, at the end of the red pistil, the female sex organ of the plant.\n\nThere are only three stigmata in each saffron flower. Once the stigmata (and their red pistils) have been separated from the plant, they are dried to preserve their color and flavor. Since such a small part of the flower is used, it takes 75,000 saffron flowers to make one pound of saffron spice. The small amount of saffron spice per plant, along with the fact that harvesting must be done manually, leads to saffron's being majorly expensive.",
        	"saffron-spice-herb.jpg"
        ],
		[ 
        	"ssss",  
        	"Getting to Know About Pink Himalayan Salts", 
			"Egypt Today Staff",
        	"Recently there is quite a hype on superfoods and healthier alternatives to what we consume on a daily basis. Worth mentioning that there is a noticeable awareness on the importance of a good nutrition, in addition to several unhealthy eating habits that need to be abandoned.  The move towards this approach is welcomed with acceptance from an increasing number of people with a capacity and interest to learn more about following healthy diets and nutrition plan, not only for the aim of losing weight, but most importantly to stay healthy.\n\nLately, pink Himalayan salt has been advised by several nutritionist as a healthier alternative to table salt. Since salt is a very commonly consumed ingredient in food, one should pay attention to some of the harmful impacts it can cause. Though sodium is important for the body, too much of sodium can lead to high blood pressure, and from here let's take a look on why we should switch to pink Himalayan salt.\n\nThis pink-colored salt is extracted from the Khewra salt mine which is the oldest salt mine located near the Himalayas in Pakistan. Being hand-extracted, pink Himalayan salt is minimally processed which means it is unrefined and free from additives. The natural process of harvesting this salt doesn't strip minerals away from it. Pink Himalayan salt includes a significantly higher number of minerals than regular table salt, and this is what gives it this pink color. Pink Himalayan salt can be used bit as a food additive and in cooking as well.\n\nDietary Benefits Of Pink Himalayan Salt:\n<ul><li>Controls high blood pressure as it is lower in sodium than table salt.</li><li>Contrary to regular salt, pink Himalayan salt does not dehydrate you. In fact it aids with hydration as it helps maintaining fluid balance and blood pressure in your body.</li><li>A little pinch of pink Himalayan salt can go a long way when it comes to taste as opposed to table salt, accordingly it will help you consume less.</li><li>Pink Himalayan salt aids in strengthening the bones as it contains several minerals such as calcium and magnesium which are important for bone formation and density.</li></ul>\nNon-Dietary Benefits Of Pink Himalayan Salt:\n<ul><li>Using pink Himalayan salt in salt baths can help you relax, soothes sore muscles, and rejuvenates the skin.</li><li>Pink Himalayan salt is often used in salt lamps to help purify the air and clear out negative energy.</li><li>The rough granules of pink Himalayan salt makes it a commonly used substance in spa treatments like facial and body scrubs.</li></ul>",
        	"pink-himalayan-salt.jpg"
        ],
	];

	// Generate dummy comment
    $dummy_comment = [
        [ 
        	"iis",  
        	1,
        	5, 
        	"My son ate a lot of salt. This might explain why he is so obese."
        ],
		[ 
        	"iis",  
        	1,
        	2, 
        	"This is so insightful"
        ],
		[ 
        	"iis",  
        	2,
        	1, 
        	"People always think that MSG is harmful, while in reality, it's just not entirely true. Thanks for this article."
        ],
		[ 
        	"iis",  
        	3,
        	3, 
        	"People be showing off Ferraris and Lambos while I'm here sprinking my hair with Saffron. This is real wealth."
        ],
		[ 
        	"iis",  
        	3,
        	3, 
        	"For real though, I don't know why people like these stuff. They taste bitter, and makes your food smell like perfume."
        ],
		[ 
        	"iis",  
        	3,
        	2, 
        	"Where can I buy these spices?"
        ],
		[ 
        	"iis",  
        	3,
        	3, 
        	"Online shops. But if you want the real thing, you could try Chinatown."
        ],
		[ 
        	"iis",  
        	4,
        	6, 
        	"I once climbed the Himalayan mountains, and I found a hard, yellow ice. It smells funky and tastes salty. Could it be that i found a new variant, like a 'Yellow Himalayan Salt'?"
        ],
		[ 
        	"iis",  
        	4,
        	5, 
        	"Mom always said never eat something you found on the ground, and this is the reason why..."
        ],
		[ 
        	"iis",  
        	4,
        	4, 
        	"Someone pray for this laddie."
        ],
	];

	// Generate dummy user
    $dummy_users = [
        [
			"sss",
			"Chad",
			"chaddo@gmail.com",
			"\$2y\$10\$bE6WX4LwQV84sWLOKHW1uOnIUT067W6aajS88WPqzrQXvcXRthioO"
		],
		[
			"sss",
			"Richard",
			"richardo@gmail.com",
			"\$2y\$10\$YEHvePibuGywk7j9IqpTJ.dCPgsxrgKNVIVF5sTjc4Kd.5.i3RQUe"
		],
		[
			"sss",
			"Perry",
			"agentp@gmail.com",
			"\$2y\$10\$f0TaBQ2MthNUOFCUUTLQke/U0EkOEbY2WXtyVbDD561X3uPUhviNi"
		],
		[
			"sss",
			"Easy Pete",
			"easypete@gmail.com",
			"\$2y\$10\$.fYMjIs2u/oOvwMf1vD90urTScLL6Xz.r9w3gMvmCWVU571C6nCpq"
		],
		[
			"sss",
			"Casey Lim",
			"caseylim@gmail.com",
			"\$2y\$10\$31BQ6KMDbKw5Tn7cqWmNaOpgOREHNJfTu534A4n1Psp1RxwojOzJ."
		],
		[
			"sss",
			"Jules May",
			"julesmay@gmail.com",
			"\$2y\$10\$PuZDv/PRrcMbU8R28xKpvOWsyDPcsVh7TEvnXTDM6bu4H.GH3JEY2"
		],
	];

    // Insert initialization key to prevent this script from re-initializing the website
    $app_config_value = [
        [ "si", "initialized", true ],
    ];

    $initialize_datas = [
        [ $insert_tables[0], $dummy_users ],
        [ $insert_tables[1], $dummy_article ],
        [ $insert_tables[2], $dummy_comment ],
		[ $insert_tables[3], $app_config_value]
    ];

    foreach($initialize_datas as $init){
        foreach($init[1] as $data){
            $stmt = $connection->prepare($init[0]);
            if(!$stmt){
                $message = "Statement preparation failed: $connection->error";
                die(create_report("Statement Preparation Report", $message));
            }
            $params = [];
            for($i = 0; $i < count($data); $i++){
                $params[] = &$data[$i];
            }
            call_user_func_array([$stmt, "bind_param"], $params);
            $stmt->execute();
            $stmt->close();
        }
    }

    $connection->close();

    echo(create_report("Statement Preparation Report", "Statement preparation successful"));

    echo(create_report("Table Seeder Report", [
        "User data entered (". count($dummy_users) . " data(s))", 
    ]));

    echo(create_report("Table Seeder Report", [
        "Article data entered (". count($dummy_article) . " data(s))", 
    ]));

    echo(create_report("Table Seeder Report", [
        "Comment data entered (". count($dummy_comment) . " data(s))", 
    ]));

    /**
     * Initialization Completed
     * This step show the random username and password from dummy data that could be used to log in to website.
     */
    $users = $dummy_users[rand(0, count($dummy_users) - 1)];
    $email = $users[2];
    $password = $users[1];
    echo(create_report("Initialization Completed", [
        "You can log in with this credential (email/password): $email/$password",
        "All default credentials generated through this initialization has the password set equal to the full name",
        "<a href='./index.php' class='btn btn-primary'>Open Website</a>"
    ]));

}
?>
    </article>
    <footer class="container-fluid text-white">
        <strong>Copyright &copy; 2018 by SW16-2 (Kevin Surya Wahyudi)<br>All rights reserved</strong> 
    </footer>
</body>
</html>
