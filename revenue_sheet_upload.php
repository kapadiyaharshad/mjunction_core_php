<?php
    require './aws-autoloader.php';
    // error_reporting(E_ALL);
    if(isset($_POST['importsaprevenue'])){
        $tmpfile = $_FILES['doc']['tmp_name'];
        $file = $_FILES['doc'];
        $filename = $_FILES['doc']['name'];
        $filename = date("Y-m-d_H:i:s")."-".$filename;
        $filename = 'revenue_record/'.$filename;
        
        $s3 = new Aws\S3\S3Client([
            'version' => 'latest',
            'region' => '',
        ]);
        try {
            $result = $s3->putObject([
                'Bucket' => '',
                'Key' => $filename,
                'SourceFile' => $tmpfile,
            ]);
            // echo "<script>console.log('hi')</script>";
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage() . "\n";
            $expt= $e->getMessage();
            echo "<script>console.log('$expt')</script>";
        }
    }
    else{
        echo "<script>window.location.href = './sap-dump'</script>";
    }
?>
