<?php
include_once 'DataAdapter.php';
class SqlScript extends DataAdapter
{
  public function __construct($mysqli)
  {
    parent::__construct($mysqli);
  }
  public function setConnect($dataStart,$dataEnd,$id,$type)
  {
    $sql=$this->_mysqli->prepare("SELECT count( id ) as value, date_format( data, '%Y-%m-%d ' ) as my_date FROM stat WHERE  `data` BETWEEN ? AND ? AND source_id=? AND  type=? GROUP BY my_date");
    $sql->bind_param('ssii',$dataStart,$dataEnd,$id,$type);
    $status=$sql->execute();
    if($status){
                $result = $sql->get_result ();
                $returnArray=array ();
          $row  =  $result->fetch_assoc ();
                while ($row) {
                    $returnArray[] = $row ;
                    $row = $result->fetch_assoc ();
                }
          $result -> free ();
          return $returnArray;
  }
}
public function setInsert($data,$id,$type,$count)
{
  $sql=$this->_mysqli->prepare("INSERT INTO `statistic` (`id`, `data`, `source_id`, `type`, `count`) VALUES (NULL, ?,?,?,?)");
  $sql->bind_param('siii',$data,$id,$type,$count);
  $status=$sql->execute();
}

public function setDelete($id,$dataStart,$dataEnd,$type)
{
$sql=$this->_mysqli->prepare("DELETE FROM `stat` WHERE  `data` BETWEEN ?
 AND ? AND  `source_id`=? AND  `type`=?");
 $sql->bind_param('ssii',$dataStart,$dataEnd,$id,$type);
 $status=$sql->execute();
}
public function setStatus($id,$data,$type)
{
  $sql=$this->_mysqli->prepare("SELECT * FROM `statistic` WHERE `source_id`=? AND `data`=? AND `type`=?");
  $sql->bind_param('isi',$id,$data,$type);
  $status=$sql->execute();
  if($status){
              $result = $sql->get_result ();
              $returnArray=array ();
        $row  =  $result->fetch_assoc ();
              while ($row) {
                  $returnArray[] = $row ;
                  $row = $result->fetch_assoc ();
              }
        $result -> free ();
        return $returnArray;
}
}
}
