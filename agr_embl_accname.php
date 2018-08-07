<?php

if(isset($_POST['username']))
{
    $result= get_response_json($_POST['username'],$_POST['passwd'],$_POST['accession']);
} else {$result = "";}

function get_response_json($username,$password,$accession)
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
    $url_accname = 'https://www.ebi.ac.uk/biosamples/samples?filter=acc:'.$accession;//gives me just the data for accession posted .
    $ch2 = curl_init();
    curl_setopt($ch2,CURLOPT_URL,$url_accname);
    curl_setopt($ch2,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch2,CURLOPT_HEADER, $headr);
    $result=curl_exec($ch2);
    if ($result === false)
    {

        $result='Curl error retrieving accession name: ' . curl_error($ch);
    }
    curl_close($ch2);
    return $result;
}
?>

<html>
<title>EMBL-Name for accession</title>
<body>

    <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">        
        Username:<input type="text" name="username" />
        Password:<input type="text" name="passwd" />
        Accession:<input type="text" name="accession" />
        <button type="submit">Submit</button> 
    </form>
    <div id="results">
        <?php
        echo("Name for accession: ".$result);
        ?>
    </div>
</body>

</html>