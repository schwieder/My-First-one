<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];
$TeamName = $_POST['TeamName'];
$LeagueName = $_POST['LeagueName'];
echo "LEague name is $LeagueName";

if(League_Exists($LeagueName))
{
    echo "You already have a league by this name, please choose another name or delete the other one";
}
else
{
    $insertQuery = "INSERT INTO hkyleagues SET CommishId=?, LeagueName=?";
    ExecuteSqlQuery($insertQuery, $UserId, $LeagueName);
    
    sleep(1);
    $LeagueId = ReadScalar(ExecuteSqlQuery("SELECT leagueId FROM hkyleagues WHERE leagueName ='$LeagueName' && commishId = '$UserId'"));
    
    $insertQuery = "INSERT INTO hkyteams SET leagueId=?, teamName=?, ownerId=?, teamNumber=?";
    ExecuteSqlQuery($insertQuery, $LeagueId, $TeamName, $UserId, "1");
    $insertQuery = "INSERT INTO hkyteams SET leagueId=?, teamName=?, teamNumber=?";
    ExecuteSqlQuery($insertQuery, $LeagueId, "Leafs", "2");
    $insertQuery = "INSERT INTO hkyteams SET leagueId=?, teamName=?, teamNumber=?";
    ExecuteSqlQuery($insertQuery, $LeagueId, "Habs", "3");
    $insertQuery = "INSERT INTO hkyteams SET leagueId=?, teamName=?, teamNumber=?";
    ExecuteSqlQuery($insertQuery, $LeagueId, "Bruins", "4");
    $insertQuery = "INSERT INTO hkyteams SET leagueId=?, teamName=?, teamNumber=?";
    ExecuteSqlQuery($insertQuery, $LeagueId, "Wings", "5");
    $insertQuery = "INSERT INTO hkyteams SET leagueId=?, teamName=?, teamNumber=?";
    ExecuteSqlQuery($insertQuery, $LeagueId, "Rangers", "6");

    $TeamId = ReadScalar(ExecuteSqlQuery("SELECT teamId FROM hkyteams WHERE leagueId ='$LeagueId' && teamName = '$TeamName'"));
    $LeafsId = ReadScalar(ExecuteSqlQuery("SELECT teamId FROM hkyteams WHERE leagueId ='$LeagueId' && teamName = 'Leafs'"));
    $HabsId = ReadScalar(ExecuteSqlQuery("SELECT teamId FROM hkyteams WHERE leagueId ='$LeagueId' && teamName = 'Habs'"));
    $BruinsId = ReadScalar(ExecuteSqlQuery("SELECT teamId FROM hkyteams WHERE leagueId ='$LeagueId' && teamName = 'Bruins'"));
    $WingsId = ReadScalar(ExecuteSqlQuery("SELECT teamId FROM hkyteams WHERE leagueId ='$LeagueId' && teamName = 'Wings'"));
    $RangersId = ReadScalar(ExecuteSqlQuery("SELECT teamId FROM hkyteams WHERE leagueId ='$LeagueId' && teamName = 'Rangers'"));
    
    $FirstName = Array("Alan","Ald Ric","Anthony","Asia","Brady","Caleb","Cole","Domas","Edynn","Emiliano","Emma","Gabriel","Jack","Jadyn","Jessica","Joel","Joey","Katie","Keira","Kyenna","Leo","Liam","Luke","Maria","Mariana","Paige","Raphael","Regan","Ryan","Sam","Tara-Jane","Thiago","Vanessa","Rahbot","Aidan","Alex","Amy","Holden","Peyton","Jemma","Tristan","Gage","Queenie","Aurora","Kian","Caeden","Marcello","Ethan","Reid","Evangeline","Garrick","Chayse","Aimee","Maya","Katelyn","Alysa","Keira","Shane","Maxine","Logan","Joey","Alexia","Jaslene","Lilly","Ryan","Grace","Zack","Preston","Elise","Marcel","Eric","Andrew","Oliver","Alex","Kayla","Gabe","Thomas","Joseph","Azriel","Addison","Anson","Ty","Cassandra","Ryder","Rocco","Ethmadalage","Haley","Phinfy","Mikayla","Alexander","Salme","Gabrielle","Kaia","Jayden","Dante","Justus","Madeline","Bella","Daniel","Nicholas","Kris","Liam","Kiel","Oliver","Pablo","Aidan","Brody","Aurora","Ben","Noah","Arkel","Joaquin","Michel","Sarah","Caelan","Easton","Blythe","Peyton","Taven","Jayden","Chris","Harmony","Jermiah","Connor","Tiago","Phoebe","Isis","Cole","Althea","Sophia","Skye","Tess","Holly","Frankie","Joanne","Jason","Taylor","Celeste","Mykaela","Alexander","Mikayla","Natalia","Isaac","Gabrielle","Bee","Clarissa","Kelly","Aidan","Bridget","Isabella","Jair-El","Marvin","Colby","Liv","Sydney","Aiden","Ethan","Gabriel","Ezekiel","Lyla","Lauren","Kyle","Benjamin","Maxine","Cameron","Skylar","Ali","Addy","Rhaid","Caleigh","Jean-Luc","Brian","Kolton","Adria","Ore","Charlie","Jax","Shayla","Yejun","Guy","Savannah","Mikayla","Irelynn","Kadance","Cassidy","Youjian","Andrew","Serenity","Cathy","Laura","Jaydan","Noah","Lucas","Vienna","Maria","Euan","Ricardo","Oliver","Alejandro","Javier","Reigh Ven","Ethan","Paytyn","Harold","Ivie","Viet","Mikayla","Charles","Christian","Mira","Karen","Kayla","Allia","Oliver","Ian","Matthew","Veronica","Ethan","Nicholas","Nisha","Carla","Tavia","Reid","Alessio","Kirsten","Caleb","Nathan","Camille","Paxton","Rachelle mae","Aaliyah","Sarah","Lucas","Eden","Cutler","Alisha","Kaden","Johan","Rocco","Michael","Lexi","Natalie","Njoro","Georgia","Kaylee","Gabriel","Kendra","Joseph","Celena","Adam","Eilad","John","Alex","Joseph","Daniel","Gavin","Darvn","Thea","Lux","Everett","Micky","Sehreem","Kuschi","Josiah","Londyn","Holda","Rena");
    $LastName = Array("Wong","Luna","Ferrari","Hill","Sine","DeForge","Whitehouse","Subocas","Jones","Barron Arce","Faith","Cheung","Johnson","Aiello","Niilo","Beka","Petratur","Haugen","Murray","Morin","Brown","Gates","Hirtle","Somers","Cardozo Ruiz","Helmer","Yim","Gallagher","Elefante","Tigner","Barraclough","Gianeze Franzoi","Skyers","Solomon","Durand","Fernandez Hernandez","Bush","Godfrey","Pakish","Shaw","Onyszko","Annable","Chavez","Fowler","Green","James","Vigna","Roy","Gallant","Helder","Moore","Van Den Broek","Chan","Magdziarz","Buckley","Utigard","Datijan","Calafatis","Valdez","Wagner","Spadafora","Salas","Wong","Lavictoire","Ruddock","Tigner","Choquette","McCann","Bergman","Arias","Marshall","Campbell","Rogers","Weld","Cardellini","Hill","Hampton","Parsons","Calahaison","Head","Yeung","Novak","Mak","Ramsay","Lo Gullo","Perera","Manuel","Calleja","Daigle","Sobiesiak","Zenith","Gawley","Reid-Wallace","Soles","Gomez","Marra","Yeboah","Reinberg","Bunuan","Martin","Bazile","Farkas Herrera","Lachica","Kerr","Cardozo Ruiz","Clarke","Neville","Renaud","Fairlie","Redes-Braaten","Enriquez","Garrido Farias","Selim","Mmari","Laverty","Clink","Situ","Hurley","Elliott","McMillan","Jung","Gladue","John","Payne","Torres","Lau","Llewellyn","Nachuk","Aquino","Sun","Ferguson","Johnson","Ollenberger","Cameron","Zhu","Liu","Grebinski","Litorco","Pavka","Simms","Lee","Plenzik","Wunsch","Moore","Catania","Dukeshire","Xiang","Orazietti","Breen","Melowsky","De Leon","Tong","Michalkow","Couzens","Schopff","Herndier","Johnny","Moreno-Barrera","Lanuzo","Jackson","Chesla","Loney","Radilla","Malubay","Parachoniak","Draper","Filewych","Murray","Younis","Klemen","Vachon","Li","Roberts","Henderson","Ayotade","Bandelow","Thompson","Eyk","Seo","Dumont Ojeda","Vloerbergh","Roveto","Barnes","Hammond","Shah","Luo","Staroselskiy","Moreau","Bendig","Lopez Munoz","Henninger","Hwang","Qiu","Polra","Kilo","Davey","Latorre Angel","Bazile","Ruiz","Ron Peraza","Jocson","Ferrari","Dodds","Murias","Isoa","Tran","Moffat","Beach","Chvets","Fernandez","Best","Best","Johnson","Penney","Huang","Dunne","Costante","Bruno","Clark","Shaw","Lambe","Benacchio","Skogen","Vigna","Dukeshire","Gartner","Wang","Tsui","Cross-Bussoli","Cabaong","Oloya-Barros","Niilo","Hryniuk","Hryniuk","Annable","Bullock","Salcedo","Nicolas","Sirianni","Stanley","Rosales","Owens","Merrett","Glovacka","Buschau","Iervella","Chapman","Yuzwa","Zhang","Brown","Cantuba","Donovan","Gomez","Passquale","Boada","Ulmer","Wang","Flores","Sparkes","Clink","Walker","Asher","Saharawat","Church","Johnston","Solomon","Yang");
    $Pos = Array("LW","LW","LW","LW","RW","RW","RW","RW","C","C","C","C","D","D","D","D","D","D","G");
    $picarray = Array("player1.jpg", "player2.jpg", "player3.jpg", "player4.jpg", "player5.jpg");

    $n=0;
    while ($n <6){
        if($n == 0){$id = $TeamId;}
        else if($n == 1){$id = $LeafsId;}
        else if($n == 2){$id = $HabsId;}
        else if($n == 3){$id = $BruinsId;}
        else if($n == 4){$id = $WingsId;}
        else if($n == 5){$id = $RangersId;}

        foreach($Pos as $k=>$var){
            $a = $FirstName[array_rand($FirstName)];
            $b = $LastName[array_rand($LastName)];
            $pic = $picarray[array_rand($picarray)];
            $Name = $a ." ". $b;
            $position = $var;
            $yr = rand(1,4);
            $potential = rand(50,100);
            $intelligence = rand(50,100);
            if($position == "D"){
                $shotPer = rand(1,7);
                $blockPer = rand(45,95);
                $savePer = 0;
                $insertQuery = "INSERT INTO hkyplayers SET leagueId=?, teamId=?, playerName=?, year=?, potential=?, intelligence=?, position=?, shotPercent=?, blockPercent=?, picture=?";
                ExecuteSqlQuery($insertQuery, $LeagueId, $id, $Name, $yr, $potential, $intelligence, $position, $shotPer, $blockPer, $pic);
            }
            else if($position == "G"){
                $shotPer = 0;
                $blockPer = 0;
                $savePer = rand(880,940);
                $insertQuery = "INSERT INTO hkyplayers SET leagueId=?, teamId=?, playerName=?, year=?, potential=?, intelligence=?, position=?, savePercentAbility=?, picture=?";
                ExecuteSqlQuery($insertQuery, $LeagueId, $id, $Name, $yr, $potential, $intelligence, $position, $savePer, $pic);
            }
            else {
                $shotPer = rand(1,15);
                $blockPer = 0;
                $savePer = 0;
                $insertQuery = "INSERT INTO hkyplayers SET leagueId=?, teamId=?, playerName=?, year=?, potential=?, intelligence=?, position=?, shotPercent=?, picture=?";
                ExecuteSqlQuery($insertQuery, $LeagueId, $id, $Name, $yr, $potential, $intelligence, $position, $shotPer, $pic);
            }
            If($yr>1)
            {
                $v = $yr;
                $v = --$v;
                while($v>0)
                {
                    $block = floor(rand(300,500)*($blockPer/100));
                    $goals = floor(rand(200,300)*($shotPer/100));
                    $save = floor(rand(850,1050)*($savePer/100));
                    $PlayerId = ReadScalar(ExecuteSqlQuery("SELECT playerId FROM hkyplayers WHERE playerName ='$Name' && teamId='$id'"));
                    $insertQuery = "INSERT INTO hkyalltimestats SET playerId=?, TeamId=?, LeagueId=?, Season=?, Position=?, SavePercent=?, ShotsBlocked=?, Goals=?";
                    ExecuteSqlQuery($insertQuery, $PlayerId, $id, $LeagueId, $v, $position, $save, $block, $goals);
                    $v = $v-1;
                }
            }
        }
        $n++;
    }

    

}

?>

<script type="text/javascript">
	$(document).ready(function(){
        $("#Refresh").show();
	});

</script>

