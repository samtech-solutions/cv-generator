<?php
include  "../connection.php"; 
//$SQL = "SELECT  * from borrowers";
session_start();

$current_user_id = $_SESSION["user-id"];
$new_trans_id = $_SESSION["newuser"];
$sql = "SELECT * FROM payment WHERE id='$new_trans_id '";
$res = mysqli_query($conn, $sql);

$header = '';
$result ='';
$exportData = mysqli_query ($conn,$sql ) or die ("Sql error : " . mysqli_error( ) );
 
$fields = mysqli_num_fields ( $exportData );
 
for ( $i = 0; $i < $fields; $i++ )
{
   // $header .= mysqli_field_name( $exportData , $i ) . "\t";
}
 
while( $row = mysqli_fetch_row( $exportData ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $result .= trim( $line ) . "\n";
}
$result = str_replace( "\r" , "" , $result );
 
if ( $result == "" )
{
    $result = "\nNo Record(s) Found!\n";                        
}
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exportinvoice.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$result";
 
?>