<?php

    date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");
	
    $aaa=0;
    $UserId = $_SESSION['UserId'];
	$LeagueId = $_POST['LId'];
	$Pos = $_POST['Pos'];
	$Sort = $_POST['Sort'];
    $taken = [];
	foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM rosterchosen WHERE LeagueId = '$LeagueId'")) as $chosen)
	{
        array_push($taken,$chosen['PlayerId']);
    }
	echo '<br><input type="button" rel="PassYds" fart="QB" id="'.$LeagueId.'" align="right" style="height:20px;width:200px;" class="btn btn-success FA" value="QB"> &nbsp';
	echo '<input type="button" rel="RushYds" fart="RB" id="'.$LeagueId.'" align="right" style="height:20px;width:200px;" class="btn btn-success FA" value="RB"> &nbsp';
	echo '<input type="button" rel="RecYds" fart="WR" id="'.$LeagueId.'" align="right" style="height:20px;width:200px;" class="btn btn-success FA" value="WR"> &nbsp';
    echo '<input type="button" rel="KORYds" fart="Ret" id="'.$LeagueId.'" align="right" style="height:20px;width:150px;" class="btn btn-success FA" value="Ret"> &nbsp';
	echo '<input type="button" rel="KickPts" fart="K" id="'.$LeagueId.'" align="right" style="height:20px;width:200px;" class="btn btn-success FA" value="K"> &nbsp';

    echo '<table id="admintable" style="text-align:center; margin-left:auto; margin-right:auto; width: 700px;"><tr></tr>
	<tr>';

    if($Pos == "QB")
    {
		?>
		<th><input type='button' rel="Name" id=<?php echo $LeagueId;?> fart=<?php echo $Pos;?> align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Name'></th>
		<th><input type='button' rel="Team" id=<?php echo $LeagueId;?> fart=<?php echo $Pos;?> align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Team'></th>
		<th>Availiability</th>
		<th><input type='button' rel="PassYds" id=<?php echo $LeagueId;?> fart="QB" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Pass Yds'></th>
		<th><input type='button' rel="PassTds" id=<?php echo $LeagueId;?> fart="QB" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Pass Tds'></th>
		<th><input type='button' rel="Ints" id=<?php echo $LeagueId;?> fart="QB" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Ints'></th>
		<th><input type='button' rel="RushYds" id=<?php echo $LeagueId;?> fart="QB" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Rush Yds'></th>
		<th><input type='button' rel="RushTds" id=<?php echo $LeagueId;?> fart="QB" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Rush Tds'></th>
		<th><input type='button' rel="FumblesLost" id=<?php echo $LeagueId;?> fart="QB" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Fumb Lost'></th>
        <th>Points<th>
		<?php
    	echo '</tr><tbody>';

        if($Sort == 'Name')
        {
            foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM roster WHERE Pos = 'QB' ORDER BY $Sort")) as $row)
            {
                if (!in_array($row['PlayerId'], $taken))
                {
                    $PId = $row['PlayerId'];
                    $Taken = '<input type="button" PId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add">';
                }
                else 
                {
                    $PId = $row['PlayerId'];
                    $TakenTeamNo = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM rosterchosen WHERE LeagueId = '$LeagueId' && PlayerId = '$PId'"));
                    $Taken = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$TakenTeamNo'"));
                }
                $N = $row['Name'];
                $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);

                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $TotalPoints = 
                    (($Points['PassYds'] * ($row['PassYds'])/25))+
                    (($Points['PassTds']  * $row['PassTds']))+
                    (($Points['PassInts'] * $row['Ints']))+
                    (($Points['RushYds']  * ($row['RushYds'])/10))+
                    (($Points['RushTds']  * $row['RushTds']))+
                    (($Points['RecYds']   * ($row['RecYds']/10)))+
                    (($Points['RecTds']   * $row['RecTds']))+
                    (($Points['KORYds']   * ($row['KORYds']/10)))+
                    (($Points['KORTds']   * $row['KORTds']))+
                    (($Points['PRYds']    * ($row['PRYds']/10)))+
                    (($Points['PRTds']    * $row['PRTds']))+
                    (($Points['Fum']      * $row['Fumbles']))+
                    (($Points['FumLost']  * $row['FumblesLost']))+
                    ($row['KickPts']);


                echo '<tr>';
                echo '<td>'.$Name.'</td>';
                echo '<td>'.$row['Team'].'</td>';
                echo '<td>'.$Taken.'</td>';
                echo '<td>'.$row['PassYds'].'</td>';
                echo '<td>'.$row['PassTds'].'</td>';
                echo '<td>'.$row['Ints'].'</td>';
                echo '<td>'.$row['RushYds'].'</td>';
                echo '<td>'.$row['RushTds'].'</td>';
                echo '<td>'.$row['FumblesLost'].'</td>';
                echo '<td>'.$TotalPoints.'</td>';
                echo '</tr>';
            }
        }
        else if ($Sort == 'Team')
        {
            foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM roster WHERE Pos = 'QB' ORDER BY $Sort")) as $row)
            {
                if (!in_array($row['PlayerId'], $taken))
                {
                    $PId = $row['PlayerId'];
                    $Taken = '<input type="button" PId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add">';
                }
                else 
                {
                    $PId = $row['PlayerId'];
                    $TakenTeamNo = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM rosterchosen WHERE LeagueId = '$LeagueId' && PlayerId = '$PId'"));
                    $Taken = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$TakenTeamNo'"));
                }
                $N = $row['Name'];
                $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);

                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $TotalPoints = 
                    (($Points['PassYds'] * ($row['PassYds'])/25))+
                    (($Points['PassTds']  * $row['PassTds']))+
                    (($Points['PassInts'] * $row['Ints']))+
                    (($Points['RushYds']  * ($row['RushYds'])/10))+
                    (($Points['RushTds']  * $row['RushTds']))+
                    (($Points['RecYds']   * ($row['RecYds']/10)))+
                    (($Points['RecTds']   * $row['RecTds']))+
                    (($Points['KORYds']   * ($row['KORYds']/10)))+
                    (($Points['KORTds']   * $row['KORTds']))+
                    (($Points['PRYds']    * ($row['PRYds']/10)))+
                    (($Points['PRTds']    * $row['PRTds']))+
                    (($Points['Fum']      * $row['Fumbles']))+
                    (($Points['FumLost']  * $row['FumblesLost']))+
                    ($row['KickPts']);

                echo '<tr>';
                echo '<td>'.$Name.'</td>';
                echo '<td>'.$row['Team'].'</td>';
                echo '<td>'.$Taken.'</td>';
                echo '<td>'.$row['PassYds'].'</td>';
                echo '<td>'.$row['PassTds'].'</td>';
                echo '<td>'.$row['Ints'].'</td>';
                echo '<td>'.$row['RushYds'].'</td>';
                echo '<td>'.$row['RushTds'].'</td>';
                echo '<td>'.$row['FumblesLost'].'</td>';
                echo '<td>'.$TotalPoints.'</td>';
                echo '</tr>';
            }
        }

        else
        {
            foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM roster WHERE Pos = 'QB' ORDER BY $Sort DESC")) as $row)
            {
                    if (!in_array($row['PlayerId'], $taken))
                {
                    $PId = $row['PlayerId'];
                    $Taken = '<input type="button" PId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add">';
                }
                else 
                {
                    $PId = $row['PlayerId'];
                    $TakenTeamNo = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM rosterchosen WHERE LeagueId = '$LeagueId' && PlayerId = '$PId'"));
                    $Taken = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$TakenTeamNo'"));
                }
                $N = $row['Name'];
                $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);

                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $TotalPoints = 
                    (($Points['PassYds'] * ($row['PassYds'])/25))+
                    (($Points['PassTds']  * $row['PassTds']))+
                    (($Points['PassInts'] * $row['Ints']))+
                    (($Points['RushYds']  * ($row['RushYds'])/10))+
                    (($Points['RushTds']  * $row['RushTds']))+
                    (($Points['RecYds']   * ($row['RecYds']/10)))+
                    (($Points['RecTds']   * $row['RecTds']))+
                    (($Points['KORYds']   * ($row['KORYds']/10)))+
                    (($Points['KORTds']   * $row['KORTds']))+
                    (($Points['PRYds']    * ($row['PRYds']/10)))+
                    (($Points['PRTds']    * $row['PRTds']))+
                    (($Points['Fum']      * $row['Fumbles']))+
                    (($Points['FumLost']  * $row['FumblesLost']))+
                    ($row['KickPts']);

                echo '<tr>';
                echo '<td>'.$Name.'</td>';
                echo '<td>'.$row['Team'].'</td>';
                echo '<td>'.$Taken.'</td>';
                echo '<td>'.$row['PassYds'].'</td>';
                echo '<td>'.$row['PassTds'].'</td>';
                echo '<td>'.$row['Ints'].'</td>';
                echo '<td>'.$row['RushYds'].'</td>';
                echo '<td>'.$row['RushTds'].'</td>';
                echo '<td>'.$row['FumblesLost'].'</td>';
                echo '<td>'.$TotalPoints.'</td>';
                echo '</tr>';
            }
    
        }
    }

    if($Pos == "RB")
    {
		?>
		<th><input type='button' rel="Name" id=<?php echo $LeagueId;?> fart=<?php echo $Pos;?> align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Name'></th>
		<th><input type='button' rel="Team" id=<?php echo $LeagueId;?> fart=<?php echo $Pos;?> align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Team'></th>
		<th>Availiability</th>
		<th><input type='button' rel="RushYds" id=<?php echo $LeagueId;?> fart="RB" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Rush Yds'></th>
		<th><input type='button' rel="RushTds" id=<?php echo $LeagueId;?> fart="RB" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Rush Tds'></th>
		<th><input type='button' rel="RecYds" id=<?php echo $LeagueId;?> fart="RB" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Rec Yds'></th>
		<th><input type='button' rel="RecTds" id=<?php echo $LeagueId;?> fart="RB" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Rec Tds'></th>
		<th><input type='button' rel="FumblesLost" id=<?php echo $LeagueId;?> fart="RB" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Fumb Lost'></th>
		<?php
    	echo '</tr><tbody>';

        if($Sort == 'Name')
        {
            foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM roster WHERE Pos = 'RB' ORDER BY $Sort")) as $row)
            {
                if (!in_array($row['PlayerId'], $taken))
                {
                    $PId = $row['PlayerId'];
                    $Taken = '<input type="button" PId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add">';
                }
                else 
                {
                    $PId = $row['PlayerId'];
                    $TakenTeamNo = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM rosterchosen WHERE LeagueId = '$LeagueId' && PlayerId = '$PId'"));
                    $Taken = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$TakenTeamNo'"));
                }
                $N = $row['Name'];
                $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);

                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $TotalPoints = 
                    (($Points['PassYds'] * ($row['PassYds'])/25))+
                    (($Points['PassTds']  * $row['PassTds']))+
                    (($Points['PassInts'] * $row['Ints']))+
                    (($Points['RushYds']  * ($row['RushYds'])/10))+
                    (($Points['RushTds']  * $row['RushTds']))+
                    (($Points['RecYds']   * ($row['RecYds']/10)))+
                    (($Points['RecTds']   * $row['RecTds']))+
                    (($Points['KORYds']   * ($row['KORYds']/10)))+
                    (($Points['KORTds']   * $row['KORTds']))+
                    (($Points['PRYds']    * ($row['PRYds']/10)))+
                    (($Points['PRTds']    * $row['PRTds']))+
                    (($Points['Fum']      * $row['Fumbles']))+
                    (($Points['FumLost']  * $row['FumblesLost']))+
                    ($row['KickPts']);

                echo '<tr>';
                echo '<td>'.$Name.'</td>';
                echo '<td>'.$row['Team'].'</td>';
                echo '<td>'.$Taken.'</td>';
                echo '<td>'.$row['RushYds'].'</td>';
                echo '<td>'.$row['RushTds'].'</td>';
                echo '<td>'.$row['RecYds'].'</td>';
                echo '<td>'.$row['RecTds'].'</td>';
                echo '<td>'.$row['FumblesLost'].'</td>';
                echo '<td>'.$TotalPoints.'</td>';
                echo '</tr>';
            }
        }
        else if ($Sort == 'Team')
        {
            foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM roster WHERE Pos = 'RB' ORDER BY $Sort")) as $row)
            {
                if (!in_array($row['PlayerId'], $taken))
                {
                    $PId = $row['PlayerId'];
                    $Taken = '<input type="button" PId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add">';
                }
                else 
                {
                    $PId = $row['PlayerId'];
                    $TakenTeamNo = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM rosterchosen WHERE LeagueId = '$LeagueId' && PlayerId = '$PId'"));
                    $Taken = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$TakenTeamNo'"));
                }
                $N = $row['Name'];
                $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);

                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $TotalPoints = 
                    (($Points['PassYds'] * ($row['PassYds'])/25))+
                    (($Points['PassTds']  * $row['PassTds']))+
                    (($Points['PassInts'] * $row['Ints']))+
                    (($Points['RushYds']  * ($row['RushYds'])/10))+
                    (($Points['RushTds']  * $row['RushTds']))+
                    (($Points['RecYds']   * ($row['RecYds']/10)))+
                    (($Points['RecTds']   * $row['RecTds']))+
                    (($Points['KORYds']   * ($row['KORYds']/10)))+
                    (($Points['KORTds']   * $row['KORTds']))+
                    (($Points['PRYds']    * ($row['PRYds']/10)))+
                    (($Points['PRTds']    * $row['PRTds']))+
                    (($Points['Fum']      * $row['Fumbles']))+
                    (($Points['FumLost']  * $row['FumblesLost']))+
                    ($row['KickPts']);

                echo '<tr>';
                echo '<td>'.$Name.'</td>';
                echo '<td>'.$row['Team'].'</td>';
                echo '<td>'.$Taken.'</td>';
                echo '<td>'.$row['RushYds'].'</td>';
                echo '<td>'.$row['RushTds'].'</td>';
                echo '<td>'.$row['RecYds'].'</td>';
                echo '<td>'.$row['RecTds'].'</td>';
                echo '<td>'.$row['FumblesLost'].'</td>';
                echo '<td>'.$TotalPoints.'</td>';
                echo '</tr>';
            }
        }

        else
        {
            foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM roster WHERE Pos = 'RB' ORDER BY $Sort DESC")) as $row)
            {
                    if (!in_array($row['PlayerId'], $taken))
                {
                    $PId = $row['PlayerId'];
                    $Taken = '<input type="button" PId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add">';
                }
                else 
                {
                    $PId = $row['PlayerId'];
                    $TakenTeamNo = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM rosterchosen WHERE LeagueId = '$LeagueId' && PlayerId = '$PId'"));
                    $Taken = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$TakenTeamNo'"));
                }
                $N = $row['Name'];
                $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);

                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $TotalPoints = 
                    (($Points['PassYds'] * ($row['PassYds'])/25))+
                    (($Points['PassTds']  * $row['PassTds']))+
                    (($Points['PassInts'] * $row['Ints']))+
                    (($Points['RushYds']  * ($row['RushYds'])/10))+
                    (($Points['RushTds']  * $row['RushTds']))+
                    (($Points['RecYds']   * ($row['RecYds']/10)))+
                    (($Points['RecTds']   * $row['RecTds']))+
                    (($Points['KORYds']   * ($row['KORYds']/10)))+
                    (($Points['KORTds']   * $row['KORTds']))+
                    (($Points['PRYds']    * ($row['PRYds']/10)))+
                    (($Points['PRTds']    * $row['PRTds']))+
                    (($Points['Fum']      * $row['Fumbles']))+
                    (($Points['FumLost']  * $row['FumblesLost']))+
                    ($row['KickPts']);

                echo '<tr>';
                echo '<td>'.$Name.'</td>';
                echo '<td>'.$row['Team'].'</td>';
                echo '<td>'.$Taken.'</td>';
                echo '<td>'.$row['RushYds'].'</td>';
                echo '<td>'.$row['RushTds'].'</td>';
                echo '<td>'.$row['RecYds'].'</td>';
                echo '<td>'.$row['RecTds'].'</td>';
                echo '<td>'.$row['FumblesLost'].'</td>';
                echo '<td>'.$TotalPoints.'</td>';
                echo '</tr>';
            }
    
        }
    }

    if($Pos == "WR")
    {
		?>
		<th><input type='button' rel="Name" id=<?php echo $LeagueId;?> fart=<?php echo $Pos;?> align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Name'></th>
		<th><input type='button' rel="Team" id=<?php echo $LeagueId;?> fart=<?php echo $Pos;?> align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Team'></th>
		<th>Availiability</th>
		<th><input type='button' rel="RecYds" id=<?php echo $LeagueId;?> fart="WR" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Rec Yds'></th>
		<th><input type='button' rel="RecTds" id=<?php echo $LeagueId;?> fart="WR" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Rec Tds'></th>
		<th><input type='button' rel="RushYds" id=<?php echo $LeagueId;?> fart="WR" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Rush Yds'></th>
		<th><input type='button' rel="RushTds" id=<?php echo $LeagueId;?> fart="WR" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Rush Tds'></th>
		<th><input type='button' rel="FumblesLost" id=<?php echo $LeagueId;?> fart="WR" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Fumb Lost'></th>
		<?php
    	echo '</tr><tbody>';

        if($Sort == 'Name')
        {
            foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM roster WHERE Pos = 'WR' ORDER BY $Sort")) as $row)
            {
                if (!in_array($row['PlayerId'], $taken))
                {
                    $PId = $row['PlayerId'];
                    $Taken = '<input type="button" PId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add">';
                }
                else 
                {
                    $PId = $row['PlayerId'];
                    $TakenTeamNo = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM rosterchosen WHERE LeagueId = '$LeagueId' && PlayerId = '$PId'"));
                    $Taken = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$TakenTeamNo'"));
                }
                $N = $row['Name'];
                $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);

                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $TotalPoints = 
                    (($Points['PassYds'] * ($row['PassYds'])/25))+
                    (($Points['PassTds']  * $row['PassTds']))+
                    (($Points['PassInts'] * $row['Ints']))+
                    (($Points['RushYds']  * ($row['RushYds'])/10))+
                    (($Points['RushTds']  * $row['RushTds']))+
                    (($Points['RecYds']   * ($row['RecYds']/10)))+
                    (($Points['RecTds']   * $row['RecTds']))+
                    (($Points['KORYds']   * ($row['KORYds']/10)))+
                    (($Points['KORTds']   * $row['KORTds']))+
                    (($Points['PRYds']    * ($row['PRYds']/10)))+
                    (($Points['PRTds']    * $row['PRTds']))+
                    (($Points['Fum']      * $row['Fumbles']))+
                    (($Points['FumLost']  * $row['FumblesLost']))+
                    ($row['KickPts']);

                echo '<tr>';
                echo '<td>'.$Name.'</td>';
                echo '<td>'.$row['Team'].'</td>';
                echo '<td>'.$Taken.'</td>';
                echo '<td>'.$row['RecYds'].'</td>';
                echo '<td>'.$row['RecTds'].'</td>';
                echo '<td>'.$row['RushYds'].'</td>';
                echo '<td>'.$row['RushTds'].'</td>';
                echo '<td>'.$row['FumblesLost'].'</td>';
                echo '<td>'.$TotalPoints.'</td>';
                echo '</tr>';
            }
        }
        else if ($Sort == 'Team')
        {
            foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM roster WHERE Pos = 'WR' ORDER BY $Sort")) as $row)
            {
                if (!in_array($row['PlayerId'], $taken))
                {
                    $PId = $row['PlayerId'];
                    $Taken = '<input type="button" PId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add">';
                }
                else 
                {
                    $PId = $row['PlayerId'];
                    $TakenTeamNo = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM rosterchosen WHERE LeagueId = '$LeagueId' && PlayerId = '$PId'"));
                    $Taken = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$TakenTeamNo'"));
                }
                $N = $row['Name'];
                $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);

                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $TotalPoints = 
                    (($Points['PassYds'] * ($row['PassYds'])/25))+
                    (($Points['PassTds']  * $row['PassTds']))+
                    (($Points['PassInts'] * $row['Ints']))+
                    (($Points['RushYds']  * ($row['RushYds'])/10))+
                    (($Points['RushTds']  * $row['RushTds']))+
                    (($Points['RecYds']   * ($row['RecYds']/10)))+
                    (($Points['RecTds']   * $row['RecTds']))+
                    (($Points['KORYds']   * ($row['KORYds']/10)))+
                    (($Points['KORTds']   * $row['KORTds']))+
                    (($Points['PRYds']    * ($row['PRYds']/10)))+
                    (($Points['PRTds']    * $row['PRTds']))+
                    (($Points['Fum']      * $row['Fumbles']))+
                    (($Points['FumLost']  * $row['FumblesLost']))+
                    ($row['KickPts']);

                echo '<tr>';
                echo '<td>'.$Name.'</td>';
                echo '<td>'.$row['Team'].'</td>';
                echo '<td>'.$Taken.'</td>';
                echo '<td>'.$row['RecYds'].'</td>';
                echo '<td>'.$row['RecTds'].'</td>';
                echo '<td>'.$row['RushYds'].'</td>';
                echo '<td>'.$row['RushTds'].'</td>';
                echo '<td>'.$row['FumblesLost'].'</td>';
                echo '<td>'.$TotalPoints.'</td>';
                echo '</tr>';
            }
        }

        else
        {
            foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM roster WHERE Pos = 'WR' ORDER BY $Sort DESC")) as $row)
            {
                    if (!in_array($row['PlayerId'], $taken))
                {
                    $PId = $row['PlayerId'];
                    $Taken = '<input type="button" PId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add">';
                }
                else 
                {
                    $PId = $row['PlayerId'];
                    $TakenTeamNo = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM rosterchosen WHERE LeagueId = '$LeagueId' && PlayerId = '$PId'"));
                    $Taken = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$TakenTeamNo'"));
                }
                $N = $row['Name'];
                $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);

                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $TotalPoints = 
                    (($Points['PassYds'] * ($row['PassYds'])/25))+
                    (($Points['PassTds']  * $row['PassTds']))+
                    (($Points['PassInts'] * $row['Ints']))+
                    (($Points['RushYds']  * ($row['RushYds'])/10))+
                    (($Points['RushTds']  * $row['RushTds']))+
                    (($Points['RecYds']   * ($row['RecYds']/10)))+
                    (($Points['RecTds']   * $row['RecTds']))+
                    (($Points['KORYds']   * ($row['KORYds']/10)))+
                    (($Points['KORTds']   * $row['KORTds']))+
                    (($Points['PRYds']    * ($row['PRYds']/10)))+
                    (($Points['PRTds']    * $row['PRTds']))+
                    (($Points['Fum']      * $row['Fumbles']))+
                    (($Points['FumLost']  * $row['FumblesLost']))+
                    ($row['KickPts']);

                echo '<tr>';
                echo '<td>'.$Name.'</td>';
                echo '<td>'.$row['Team'].'</td>';
                echo '<td>'.$Taken.'</td>';
                echo '<td>'.$row['RecYds'].'</td>';
                echo '<td>'.$row['RecTds'].'</td>';
                echo '<td>'.$row['RushYds'].'</td>';
                echo '<td>'.$row['RushTds'].'</td>';
                echo '<td>'.$row['FumblesLost'].'</td>';
                echo '<td>'.$TotalPoints.'</td>';
                echo '</tr>';
            }
    
        }
    }

    if($Pos == "K")
    {
		?>
		<th><input type='button' rel="Name" id=<?php echo $LeagueId;?> fart=<?php echo $Pos;?> align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Name'></th>
		<th><input type='button' rel="Team" id=<?php echo $LeagueId;?> fart=<?php echo $Pos;?> align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Team'></th>
		<th>Availiability</th>
		<th><input type='button' rel="KickPts" id=<?php echo $LeagueId;?> fart="K" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Kick Points'></th>
		<?php
    	echo '</tr><tbody>';

        if($Sort == 'KickPts')
        {
            foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM roster WHERE Pos = 'K' ORDER BY $Sort DESC")) as $row)
            {
                    if (!in_array($row['PlayerId'], $taken))
                {
                    $PId = $row['PlayerId'];
                    $Taken = '<input type="button" PId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add">';
                }
                else 
                {
                    $PId = $row['PlayerId'];
                    $TakenTeamNo = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM rosterchosen WHERE LeagueId = '$LeagueId' && PlayerId = '$PId'"));
                    $Taken = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$TakenTeamNo'"));
                }
                $N = $row['Name'];
                $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);

                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $TotalPoints = 
                    (($Points['PassYds'] * ($row['PassYds'])/25))+
                    (($Points['PassTds']  * $row['PassTds']))+
                    (($Points['PassInts'] * $row['Ints']))+
                    (($Points['RushYds']  * ($row['RushYds'])/10))+
                    (($Points['RushTds']  * $row['RushTds']))+
                    (($Points['RecYds']   * ($row['RecYds']/10)))+
                    (($Points['RecTds']   * $row['RecTds']))+
                    (($Points['KORYds']   * ($row['KORYds']/10)))+
                    (($Points['KORTds']   * $row['KORTds']))+
                    (($Points['PRYds']    * ($row['PRYds']/10)))+
                    (($Points['PRTds']    * $row['PRTds']))+
                    (($Points['Fum']      * $row['Fumbles']))+
                    (($Points['FumLost']  * $row['FumblesLost']))+
                    ($row['KickPts']);

                echo '<tr>';
                echo '<td>'.$Name.'</td>';
                echo '<td>'.$row['Team'].'</td>';
                echo '<td>'.$Taken.'</td>';
                echo '<td>'.$row['KickPts'].'</td>';
                echo '<td>'.$TotalPoints.'</td>';
                echo '</tr>';
            }
        }
        else
        {
            foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM roster WHERE Pos = 'K' ORDER BY $Sort")) as $row)
            {
                if (!in_array($row['PlayerId'], $taken))
                {
                    $PId = $row['PlayerId'];
                    $Taken = '<input type="button" PId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add">';
                }
                else 
                {
                    $PId = $row['PlayerId'];
                    $TakenTeamNo = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM rosterchosen WHERE LeagueId = '$LeagueId' && PlayerId = '$PId'"));
                    $Taken = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$TakenTeamNo'"));
                }
                $N = $row['Name'];
                $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);

                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $TotalPoints = 
                    (($Points['PassYds'] * ($row['PassYds'])/25))+
                    (($Points['PassTds']  * $row['PassTds']))+
                    (($Points['PassInts'] * $row['Ints']))+
                    (($Points['RushYds']  * ($row['RushYds'])/10))+
                    (($Points['RushTds']  * $row['RushTds']))+
                    (($Points['RecYds']   * ($row['RecYds']/10)))+
                    (($Points['RecTds']   * $row['RecTds']))+
                    (($Points['KORYds']   * ($row['KORYds']/10)))+
                    (($Points['KORTds']   * $row['KORTds']))+
                    (($Points['PRYds']    * ($row['PRYds']/10)))+
                    (($Points['PRTds']    * $row['PRTds']))+
                    (($Points['Fum']      * $row['Fumbles']))+
                    (($Points['FumLost']  * $row['FumblesLost']))+
                    ($row['KickPts']);

                echo '<tr>';
                echo '<td>'.$Name.'</td>';
                echo '<td>'.$row['Team'].'</td>';
                echo '<td>'.$Taken.'</td>';
                echo '<td>'.$row['KickPts'].'</td>';
                echo '<td>'.$TotalPoints.'</td>';
                echo '</tr>';
            }
        }
    }

    if($Pos == "Ret")
    {
        ?>
        <th><input type='button' rel="Name" id=<?php echo $LeagueId;?> fart=<?php echo $Pos;?> align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Name'></th>
        <th><input type='button' rel="Team" id=<?php echo $LeagueId;?> fart=<?php echo $Pos;?> align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Team'></th>
        <th>Pos</th>
        <th>Availiability</th>
        <th><input type='button' rel="KORYds" id=<?php echo $LeagueId;?> fart="Ret" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='KOR Yards'></th>
        <th><input type='button' rel="KORTds" id=<?php echo $LeagueId;?> fart="Ret" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='KOR TDs'></th>
        <th><input type='button' rel="PRYds" id=<?php echo $LeagueId;?> fart="Ret" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='PR Yards'></th>
        <th><input type='button' rel="PRTds" id=<?php echo $LeagueId;?> fart="Ret" align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='PR TDs'></th>
        <?php
        echo '</tr><tbody>';
    
        if($Sort == 'KORYds')
        {
            foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM roster WHERE KORYds !='0' ORDER BY KORYds DESC")) as $row)
            {
                    if (!in_array($row['PlayerId'], $taken))
                {
                    $PId = $row['PlayerId'];
                    $Taken = '<input type="button" PId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add">';
                }
                else 
                {
                    $PId = $row['PlayerId'];
                    $TakenTeamNo = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM rosterchosen WHERE LeagueId = '$LeagueId' && PlayerId = '$PId'"));
                    $Taken = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$TakenTeamNo'"));
                }
                $N = $row['Name'];
                $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
    
                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $TotalPoints = 
                    (($Points['PassYds'] * ($row['PassYds'])/25))+
                    (($Points['PassTds']  * $row['PassTds']))+
                    (($Points['PassInts'] * $row['Ints']))+
                    (($Points['RushYds']  * ($row['RushYds'])/10))+
                    (($Points['RushTds']  * $row['RushTds']))+
                    (($Points['RecYds']   * ($row['RecYds']/10)))+
                    (($Points['RecTds']   * $row['RecTds']))+
                    (($Points['KORYds']   * ($row['KORYds']/10)))+
                    (($Points['KORTds']   * $row['KORTds']))+
                    (($Points['PRYds']    * ($row['PRYds']/10)))+
                    (($Points['PRTds']    * $row['PRTds']))+
                    (($Points['Fum']      * $row['Fumbles']))+
                    (($Points['FumLost']  * $row['FumblesLost']))+
                    ($row['KickPts']);
    
                echo '<tr>';
                echo '<td>'.$Name.'</td>';
                echo '<td>'.$row['Team'].'</td>';
                echo '<td>'.$row['Pos'].'</td>';
                echo '<td>'.$Taken.'</td>';
                echo '<td>'.$row['KORYds'].'</td>';
                echo '<td>'.$row['KORTds'].'</td>';
                echo '<td>'.$row['PRYds'].'</td>';
                echo '<td>'.$row['PRTds'].'</td>';
                echo '<td>'.$TotalPoints.'</td>';
                echo '</tr>';
            }
        }
        else if($Sort == 'KORTds')
        {
            foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM roster WHERE KORYds !='0' ORDER BY KORTds DESC")) as $row)
            {
                    if (!in_array($row['PlayerId'], $taken))
                {
                    $PId = $row['PlayerId'];
                    $Taken = '<input type="button" PId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add">';
                }
                else 
                {
                    $PId = $row['PlayerId'];
                    $TakenTeamNo = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM rosterchosen WHERE LeagueId = '$LeagueId' && PlayerId = '$PId'"));
                    $Taken = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$TakenTeamNo'"));
                }
                $N = $row['Name'];
                $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
    
                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $TotalPoints = 
                    (($Points['PassYds'] * ($row['PassYds'])/25))+
                    (($Points['PassTds']  * $row['PassTds']))+
                    (($Points['PassInts'] * $row['Ints']))+
                    (($Points['RushYds']  * ($row['RushYds'])/10))+
                    (($Points['RushTds']  * $row['RushTds']))+
                    (($Points['RecYds']   * ($row['RecYds']/10)))+
                    (($Points['RecTds']   * $row['RecTds']))+
                    (($Points['KORYds']   * ($row['KORYds']/10)))+
                    (($Points['KORTds']   * $row['KORTds']))+
                    (($Points['PRYds']    * ($row['PRYds']/10)))+
                    (($Points['PRTds']    * $row['PRTds']))+
                    (($Points['Fum']      * $row['Fumbles']))+
                    (($Points['FumLost']  * $row['FumblesLost']))+
                    ($row['KickPts']);
    
                echo '<tr>';
                echo '<td>'.$Name.'</td>';
                echo '<td>'.$row['Team'].'</td>';
                echo '<td>'.$row['Pos'].'</td>';
                echo '<td>'.$Taken.'</td>';
                echo '<td>'.$row['KORYds'].'</td>';
                echo '<td>'.$row['KORTds'].'</td>';
                echo '<td>'.$row['PRYds'].'</td>';
                echo '<td>'.$row['PRTds'].'</td>';
                echo '<td>'.$TotalPoints.'</td>';
                echo '</tr>';
            }
        }
        else if($Sort == 'PRYds')
        {
            foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM roster WHERE PRYds !='0' ORDER BY PRYds DESC")) as $row)
            {
                    if (!in_array($row['PlayerId'], $taken))
                {
                    $PId = $row['PlayerId'];
                    $Taken = '<input type="button" PId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add">';
                }
                else 
                {
                    $PId = $row['PlayerId'];
                    $TakenTeamNo = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM rosterchosen WHERE LeagueId = '$LeagueId' && PlayerId = '$PId'"));
                    $Taken = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$TakenTeamNo'"));
                }
                $N = $row['Name'];
                $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
    
                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $TotalPoints = 
                    (($Points['PassYds'] * ($row['PassYds'])/25))+
                    (($Points['PassTds']  * $row['PassTds']))+
                    (($Points['PassInts'] * $row['Ints']))+
                    (($Points['RushYds']  * ($row['RushYds'])/10))+
                    (($Points['RushTds']  * $row['RushTds']))+
                    (($Points['RecYds']   * ($row['RecYds']/10)))+
                    (($Points['RecTds']   * $row['RecTds']))+
                    (($Points['KORYds']   * ($row['KORYds']/10)))+
                    (($Points['KORTds']   * $row['KORTds']))+
                    (($Points['PRYds']    * ($row['PRYds']/10)))+
                    (($Points['PRTds']    * $row['PRTds']))+
                    (($Points['Fum']      * $row['Fumbles']))+
                    (($Points['FumLost']  * $row['FumblesLost']))+
                    ($row['KickPts']);
    
                echo '<tr>';
                echo '<td>'.$Name.'</td>';
                echo '<td>'.$row['Team'].'</td>';
                echo '<td>'.$row['Pos'].'</td>';
                echo '<td>'.$Taken.'</td>';
                echo '<td>'.$row['KORYds'].'</td>';
                echo '<td>'.$row['KORTds'].'</td>';
                echo '<td>'.$row['PRYds'].'</td>';
                echo '<td>'.$row['PRTds'].'</td>';
                echo '<td>'.$TotalPoints.'</td>';
                echo '</tr>';
            }
        }
        else if($Sort == 'PRTds')
        {
            foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM roster WHERE PRYds !='0' ORDER BY PRTds DESC")) as $row)
            {
                    if (!in_array($row['PlayerId'], $taken))
                {
                    $PId = $row['PlayerId'];
                    $Taken = '<input type="button" PId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add">';
                }
                else 
                {
                    $PId = $row['PlayerId'];
                    $TakenTeamNo = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM rosterchosen WHERE LeagueId = '$LeagueId' && PlayerId = '$PId'"));
                    $Taken = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$TakenTeamNo'"));
                }
                $N = $row['Name'];
                $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
    
                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $TotalPoints = 
                    (($Points['PassYds'] * ($row['PassYds'])/25))+
                    (($Points['PassTds']  * $row['PassTds']))+
                    (($Points['PassInts'] * $row['Ints']))+
                    (($Points['RushYds']  * ($row['RushYds'])/10))+
                    (($Points['RushTds']  * $row['RushTds']))+
                    (($Points['RecYds']   * ($row['RecYds']/10)))+
                    (($Points['RecTds']   * $row['RecTds']))+
                    (($Points['KORYds']   * ($row['KORYds']/10)))+
                    (($Points['KORTds']   * $row['KORTds']))+
                    (($Points['PRYds']    * ($row['PRYds']/10)))+
                    (($Points['PRTds']    * $row['PRTds']))+
                    (($Points['Fum']      * $row['Fumbles']))+
                    (($Points['FumLost']  * $row['FumblesLost']))+
                    ($row['KickPts']);
    
                echo '<tr>';
                echo '<td>'.$Name.'</td>';
                echo '<td>'.$row['Team'].'</td>';
                echo '<td>'.$row['Pos'].'</td>';
                echo '<td>'.$Taken.'</td>';
                echo '<td>'.$row['KORYds'].'</td>';
                echo '<td>'.$row['KORTds'].'</td>';
                echo '<td>'.$row['PRYds'].'</td>';
                echo '<td>'.$row['PRTds'].'</td>';
                echo '<td>'.$TotalPoints.'</td>';
                echo '</tr>';
            }
        }
        else
        {
            foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM roster WHERE KORYds !='0' ORDER BY $Sort")) as $row)
            {
                if (!in_array($row['PlayerId'], $taken))
                {
                    $PId = $row['PlayerId'];
                    $Taken = '<input type="button" PId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add">';
                }
                else 
                {
                    $PId = $row['PlayerId'];
                    $TakenTeamNo = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM rosterchosen WHERE LeagueId = '$LeagueId' && PlayerId = '$PId'"));
                    $Taken = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$TakenTeamNo'"));
                }
                $N = $row['Name'];
                $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
    
                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $TotalPoints = 
                    (($Points['PassYds'] * ($row['PassYds'])/25))+
                    (($Points['PassTds']  * $row['PassTds']))+
                    (($Points['PassInts'] * $row['Ints']))+
                    (($Points['RushYds']  * ($row['RushYds'])/10))+
                    (($Points['RushTds']  * $row['RushTds']))+
                    (($Points['RecYds']   * ($row['RecYds']/10)))+
                    (($Points['RecTds']   * $row['RecTds']))+
                    (($Points['KORYds']   * ($row['KORYds']/10)))+
                    (($Points['KORTds']   * $row['KORTds']))+
                    (($Points['PRYds']    * ($row['PRYds']/10)))+
                    (($Points['PRTds']    * $row['PRTds']))+
                    (($Points['Fum']      * $row['Fumbles']))+
                    (($Points['FumLost']  * $row['FumblesLost']))+
                    ($row['KickPts']);
    
                    echo '<tr>';
                    echo '<td>'.$Name.'</td>';
                    echo '<td>'.$row['Team'].'</td>';
                    echo '<td>'.$row['Pos'].'</td>';
                    echo '<td>'.$Taken.'</td>';
                    echo '<td>'.$row['KORYds'].'</td>';
                    echo '<td>'.$row['KORTds'].'</td>';
                    echo '<td>'.$row['PRYds'].'</td>';
                    echo '<td>'.$row['PRTds'].'</td>';
                    echo '<td>'.$TotalPoints.'</td>';
                    echo '</tr>';
                }
            }
    }


    echo '</tbody>';
    
?>

<script type="text/javascript">
	$(document).ready(function(){
		$(".FA").on('click', function(){
			var Pos = $(this).attr("fart");
			var LId = $(this).attr("id");
			var Sort = $(this).attr("rel");
			$.post("LeadersYearChart.php", {Pos: Pos, LId: LId, Sort:Sort}, function(data){
				$("#TeamInner").html(data);
			});	
		});

        $(".Chart").on('click', function(){
			var Pos = $(this).attr("fart");
			var LId = $(this).attr("id");
			var Sort = $(this).attr("rel");
			$.post("LeadersYearChart.php", {Pos: Pos, LId: LId, Sort:Sort}, function(data){
				$("#TeamInner").html(data);
			});	
		});
        $(".Add").on('click', function(){
			var PId = $(this).attr("PId");
			var LId = $(this).attr("LId");
			$.post("FreeAgentsChoose.php", {PId: PId, LId: LId}, function(data){
				$("#TeamInner").html(data);
			});	
		});

	});

</script>
