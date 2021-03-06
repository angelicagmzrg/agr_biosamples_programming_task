<?php

if(isset($_POST['username']))
{
    $result= get_response_json($_POST['username'],$_POST['passwd'],$_POST['attribute'],$_POST['attvalue']);
} else {$result = "";}

function get_response_json($username,$password,$attribute,$attvalue)
{

    $url = 'https://'.$username.':'.$password.'@api.aai.ebi.ac.uk/auth';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $token = curl_exec($ch);
    curl_close($ch);
    if ($token === false)
    {

        $token='Curl error retrieving token: ' . curl_error($ch);
        return $token;
    }

    $headr = array();
    $headr[] = 'Accept: application/hal+json';
    $headr[] = 'Content-Type: application/hal+json';
    $headr[] = 'Authorization: Bearer '.$token;
    $url_accsattrvalue = 'https://www.ebi.ac.uk/biosamples/samples/?filter=attr:'.$attribute.'+part:'.$attvalue;//giving an attribute and a value return the accessions of samples with that specific attribute:value pair
    $ch2 = curl_init();
    curl_setopt($ch2,CURLOPT_URL,$url_accsattrvalue);
    curl_setopt($ch2,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch2,CURLOPT_HEADER, $headr);
    $result=curl_exec($ch2);
    if ($result === false)
    {

        $result='Curl error retrieving accessions of samples: ' . curl_error($ch);
    }
    curl_close($ch2);
    return $result;
}
?>

<html>
<title>EMBL-Accesssions of samples</title>
<body>

    <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">        
        Username:<input type="text" name="username" />
        Password:<input type="text" name="passwd" />
        Attribute:<input type="text" name="attribute" />
        Attribute Value:<input type="text" name="attvalue" />
        <button type="submit">Submit</button> 
    </form>
    <div id="results">
        <?php
        echo("Accessions of samples: ".$result);
        ?>
    </div>
</body>

</html>