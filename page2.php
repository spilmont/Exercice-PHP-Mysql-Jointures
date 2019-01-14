<?php

session_start();

/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 11/01/2019
 * Time: 13:58
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jointure";






$conn = new mysqli($servername,$username,$password);

if($conn ->connect_error){
    die("Connection failed: " . $conn->connect_error);
}else{
// Selectionner la base à utiliser
    $conn->select_db($dbname);

}

function diagrame()
{

    $ss=$_GET['value'];
    $sql = "select * from competences, eleves_competences where eleves_competences.competences_id = competences.id and eleves_competences.eleves_id = '$ss'";
    global $conn;
    global $connexion;
    global $string ;
    global $sting;

    $conn->query($sql);
    $connexion = $conn->query($sql);

    $string ="";
    $sting = "";

    while($row = $connexion-> fetch_assoc()) {

        $niveau = $row['niveau'] ;
        $niveau_ae = $row['niveau_ae'];

        if($string!='')
        {
            $string.=",";
        }

        if($sting!='')
        {
            $sting.=",";
        }

        $string.= $niveau;
        $sting .= $niveau_ae;

        echo "elevesid : ".$row['eleves_id']."<br> niveaux:  ".$row['niveau']." <br>description : ".$row["description"]." <br>niveau_ae :  ".$row['niveau_ae']." <br>titre :".$row['titre']."  <br>competence id : ".$row["competences_id"]."<br><br>";
    }
    echo "competence".$string;
    echo "competence auto evalue".$sting;
}



diagrame();


?>

<!DOCTYPE html>
<html>
<head>
    <script src= "https://cdn.zingchart.com/zingchart.min.js"></script>
    <script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9","ee6b7db5b51705a13dc2339db3edaf6d"];</script></head>
<body>
<div id='myChart'><a class="zc-ref" href="https://www.zingchart.com/">Powered by ZingChart</a></div>
</body>
</html>


<style>


    html, body {
        height:100%;
        width:100%;
    }
    #myChart {
        height:100%;
        width:100%;
        min-height:250px;
    }
    .zc-ref {
        display:none;
    }


</style>

<script>


    var myConfig = {
        type : 'radar',
        plot : {
            aspect : 'area',
            animation: {
                effect:3,
                sequence:1,
                speed:700
            }
        },
        scaleV : {
            visible : false
        },
        scaleK : {
            values : '0:2:0',
            labels : ['jeux video','Vin','cryptomonais'],
            item : {
                fontColor : '#607D8B',
                backgroundColor : "white",
                borderColor : "#aeaeae",
                borderWidth : 1,
                padding : '5 10',
                borderRadius : 10
            },
            refLine : {
                lineColor : '#c10000'
            },
            tick : {
                lineColor : '#59869c',
                lineWidth : 2,
                lineStyle : 'dotted',
                size : 20
            },
            guide : {
                lineColor : "#607D8B",
                lineStyle : 'solid',
                alpha : 0.3,
                backgroundColor : "#c5c5c5 #718eb4"
            }
        },
        series : [
            {
                values : [<?= $string; ?>],
                text:'farm'
            },
             {
                 values : [<?= $sting; ?>],
                 lineColor : '#53a534',
                 backgroundColor : '#689F38'
             }
        ]
    };

    zingchart.render({
        id : 'myChart',
        data : myConfig,
        height: '100%',
        width: '100%'
    });



</script>





