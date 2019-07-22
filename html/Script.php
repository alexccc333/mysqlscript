<?php
include_once 'bd.php';
include_once 'Admin/SqlScript.php';
$newDate = new DateTime('-7 days');
$date=$newDate->format('Y-m-d');
$index=new SqlScript($mysqli);
$dataStart=$date . ' 00:00:01';
$dataEnd=$date .' 23:59:59';
for ($id=0; $id <= 10000; $id++){
    for ($type=1; $type <=3; $type++) {
        $vivod=$index->setConnect($dataStart,$dataEnd,$id,$type);
      if(isset($vivod[0]))
      {
          echo "OK 1";
        $count=intval($vivod[0]['value']);
        $data=strval($vivod[0]['my_date']);
        $index->setInsert($data,$id,$type,$count);
        $logs=$index->setStatus($id,$date,$type);
        if($logs)
        {
          $index->setDelete($id,$dataStart,$dataEnd,$type);
        }
        else
        {
          $file='logs.txt';
          $fOpen=fopen($file,a);
          $text='ошибка переноса обьект ненайден в новой таблице';
          fwrite($fOpen,$text);
          fclose($fOpen);
          die();

        }
      }
      else
      {
          continue;
      }
    }
}
