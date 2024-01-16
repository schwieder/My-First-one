<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$LeagueId = "36"; //$_POST['LeagueId'];



    $FirstName = Array("Alan","Ald Ric","Anthony","Asia","Brady","Caleb","Cole","Domas","Edynn","Emiliano","Emma","Gabriel","Jack","Jadyn","Jessica","Joel","Joey","Katie","Keira","Kyenna","Leo","Liam","Luke","Maria","Mariana","Paige","Raphael","Regan","Ryan","Sam","Tara-Jane","Thiago","Vanessa","Rahbot","Aidan","Alex","Amy","Holden","Peyton","Jemma","Tristan","Gage","Queenie","Aurora","Kian","Caeden","Marcello","Ethan","Reid","Evangeline","Garrick","Chayse","Aimee","Maya","Katelyn","Alysa","Keira","Shane","Maxine","Logan","Joey","Alexia","Jaslene","Lilly","Ryan","Grace","Zack","Preston","Elise","Marcel","Eric","Andrew","Oliver","Alex","Kayla","Gabe","Thomas","Joseph","Azriel","Addison","Anson","Ty","Cassandra","Ryder","Rocco","Ethmadalage","Haley","Phinfy","Mikayla","Alexander","Salme","Gabrielle","Kaia","Jayden","Dante","Justus","Madeline","Bella","Daniel","Nicholas","Kris","Liam","Kiel","Oliver","Pablo","Aidan","Brody","Aurora","Ben","Noah","Arkel","Joaquin","Michel","Sarah","Caelan","Easton","Blythe","Peyton","Taven","Jayden","Chris","Harmony","Jermiah","Connor","Tiago","Phoebe","Isis","Cole","Althea","Sophia","Skye","Tess","Holly","Frankie","Joanne","Jason","Taylor","Celeste","Mykaela","Alexander","Mikayla","Natalia","Isaac","Gabrielle","Bee","Clarissa","Kelly","Aidan","Bridget","Isabella","Jair-El","Marvin","Colby","Liv","Sydney","Aiden","Ethan","Gabriel","Ezekiel","Lyla","Lauren","Kyle","Benjamin","Maxine","Cameron","Skylar","Ali","Addy","Rhaid","Caleigh","Jean-Luc","Brian","Kolton","Adria","Ore","Charlie","Jax","Shayla","Yejun","Guy","Savannah","Mikayla","Irelynn","Kadance","Cassidy","Youjian","Andrew","Serenity","Cathy","Laura","Jaydan","Noah","Lucas","Vienna","Maria","Euan","Ricardo","Oliver","Alejandro","Javier","Reigh Ven","Ethan","Paytyn","Harold","Ivie","Viet","Mikayla","Charles","Christian","Mira","Karen","Kayla","Allia","Oliver","Ian","Matthew","Veronica","Ethan","Nicholas","Nisha","Carla","Tavia","Reid","Alessio","Kirsten","Caleb","Nathan","Camille","Paxton","Rachelle mae","Aaliyah","Sarah","Lucas","Eden","Cutler","Alisha","Kaden","Johan","Rocco","Michael","Lexi","Natalie","Njoro","Georgia","Kaylee","Gabriel","Kendra","Joseph","Celena","Adam","Eilad","John","Alex","Joseph","Daniel","Gavin","Darvn","Thea","Lux","Everett","Micky","Sehreem","Kuschi","Josiah","Londyn","Holda","Rena");
    $LastName = Array("Wong","Luna","Ferrari","Hill","Sine","DeForge","Whitehouse","Subocas","Jones","Barron Arce","Faith","Cheung","Johnson","Aiello","Niilo","Beka","Petratur","Haugen","Murray","Morin","Brown","Gates","Hirtle","Somers","Cardozo Ruiz","Helmer","Yim","Gallagher","Elefante","Tigner","Barraclough","Gianeze Franzoi","Skyers","Solomon","Durand","Fernandez Hernandez","Bush","Godfrey","Pakish","Shaw","Onyszko","Annable","Chavez","Fowler","Green","James","Vigna","Roy","Gallant","Helder","Moore","Van Den Broek","Chan","Magdziarz","Buckley","Utigard","Datijan","Calafatis","Valdez","Wagner","Spadafora","Salas","Wong","Lavictoire","Ruddock","Tigner","Choquette","McCann","Bergman","Arias","Marshall","Campbell","Rogers","Weld","Cardellini","Hill","Hampton","Parsons","Calahaison","Head","Yeung","Novak","Mak","Ramsay","Lo Gullo","Perera","Manuel","Calleja","Daigle","Sobiesiak","Zenith","Gawley","Reid-Wallace","Soles","Gomez","Marra","Yeboah","Reinberg","Bunuan","Martin","Bazile","Farkas Herrera","Lachica","Kerr","Cardozo Ruiz","Clarke","Neville","Renaud","Fairlie","Redes-Braaten","Enriquez","Garrido Farias","Selim","Mmari","Laverty","Clink","Situ","Hurley","Elliott","McMillan","Jung","Gladue","John","Payne","Torres","Lau","Llewellyn","Nachuk","Aquino","Sun","Ferguson","Johnson","Ollenberger","Cameron","Zhu","Liu","Grebinski","Litorco","Pavka","Simms","Lee","Plenzik","Wunsch","Moore","Catania","Dukeshire","Xiang","Orazietti","Breen","Melowsky","De Leon","Tong","Michalkow","Couzens","Schopff","Herndier","Johnny","Moreno-Barrera","Lanuzo","Jackson","Chesla","Loney","Radilla","Malubay","Parachoniak","Draper","Filewych","Murray","Younis","Klemen","Vachon","Li","Roberts","Henderson","Ayotade","Bandelow","Thompson","Eyk","Seo","Dumont Ojeda","Vloerbergh","Roveto","Barnes","Hammond","Shah","Luo","Staroselskiy","Moreau","Bendig","Lopez Munoz","Henninger","Hwang","Qiu","Polra","Kilo","Davey","Latorre Angel","Bazile","Ruiz","Ron Peraza","Jocson","Ferrari","Dodds","Murias","Isoa","Tran","Moffat","Beach","Chvets","Fernandez","Best","Best","Johnson","Penney","Huang","Dunne","Costante","Bruno","Clark","Shaw","Lambe","Benacchio","Skogen","Vigna","Dukeshire","Gartner","Wang","Tsui","Cross-Bussoli","Cabaong","Oloya-Barros","Niilo","Hryniuk","Hryniuk","Annable","Bullock","Salcedo","Nicolas","Sirianni","Stanley","Rosales","Owens","Merrett","Glovacka","Buschau","Iervella","Chapman","Yuzwa","Zhang","Brown","Cantuba","Donovan","Gomez","Passquale","Boada","Ulmer","Wang","Flores","Sparkes","Clink","Walker","Asher","Saharawat","Church","Johnston","Solomon","Yang");
    $Pos = Array("LW","LW","LW","LW","RW","RW","RW","C","C","C","C","D","D","D","D","D","G");
    $picArray = Array("player1.jpg", "player2.jpg", "player3.jpg", "player4.jpg", "player5.jpg");


    $n=0;
    while ($n <75){

            $a = $FirstName[array_rand($FirstName)];
            $b = $LastName[array_rand($LastName)];
            $pic = $picArray[array_rand($picArray)];
            $Name = $a ." ". $b;
            $position = $Pos[array_rand($Pos)];
            $potential = rand(50,100);
            $intelligence = rand(50,100);
            $Team1Int = rand(100,600);
            $Team2Int = rand(100,600);
            $Team3Int = rand(100,600);
            $Team4Int = rand(100,600);
            $Team5Int = rand(100,600);
            $Team6Int = rand(100,600);
            $PrestigeInterest = rand(1,50);
            $CurrRecordInterest = rand(1,50);
            $FacilitiesInterest = rand(1,50);
            $AcademicsInterest = rand(1,50);
            $DepthInterest = rand(1,50);
            //$LocationInterest = rand(1,50);
            $PointsNeeded = rand(1400,2000);

            if($position == "D"){
                $shotPer = rand(1,5);
                $blockPer = rand(45,75);
                $savePer = 0;
                $insertQuery = "INSERT INTO recruits SET leagueId=?, playerName=?, potential=?, intelligence=?, position=?, shotPercent=?, blockPercent=?, picture=?, team1Int=?, team2Int=?, team3Int=?, team4Int=?, team5Int=?, team6Int=?, prestige=?, currRecord=?, facilities=?, academics=?, depth=?, pointsNeeded=?";
                ExecuteSqlQuery($insertQuery, $LeagueId, $Name, $potential, $intelligence, $position, $shotPer, $blockPer, $pic, $Team1Int, $Team2Int, $Team3Int, $Team4Int, $Team5Int, $Team6Int, $PrestigeInterest, $CurrRecordInterest, $FacilitiesInterest, $AcademicsInterest, $DepthInterest, $PointsNeeded);
            }
            else if($position == "G"){
                $shotPer = 0;
                $blockPer = 0;
                $savePer = rand(880,900);
                $insertQuery = "INSERT INTO recruits SET leagueId=?, playerName=?, potential=?, intelligence=?, position=?, savePercentAbility=?, picture=?, team1Int=?, team2Int=?, team3Int=?, team4Int=?, team5Int=?, team6Int=?, prestige=?, currRecord=?, facilities=?, academics=?, depth=?, pointsNeeded=?";
                ExecuteSqlQuery($insertQuery, $LeagueId, $Name, $potential, $intelligence, $position, $savePer, $pic, $Team1Int, $Team2Int, $Team3Int, $Team4Int, $Team5Int, $Team6Int, $PrestigeInterest, $CurrRecordInterest, $FacilitiesInterest, $AcademicsInterest, $DepthInterest, $PointsNeeded);
            }
            else {
                $shotPer = rand(1,8);
                $blockPer = 0;
                $savePer = 0;
                $insertQuery = "INSERT INTO recruits SET leagueId=?, playerName=?, potential=?, intelligence=?, position=?, shotPercent=?, picture=?, team1Int=?, team2Int=?, team3Int=?, team4Int=?, team5Int=?, team6Int=?, prestige=?, currRecord=?, facilities=?, academics=?, depth=?, pointsNeeded=?";
                ExecuteSqlQuery($insertQuery, $LeagueId, $Name, $potential, $intelligence, $position, $shotPer, $pic, $Team1Int, $Team2Int, $Team3Int, $Team4Int, $Team5Int, $Team6Int, $PrestigeInterest, $CurrRecordInterest, $FacilitiesInterest, $AcademicsInterest, $DepthInterest, $PointsNeeded);
            }
        $n++;
    }

