<?php
  $srchtext = $_REQUEST['text'];
  $con=mysql_connect("localhost","root","admin");
  $sql=mysql_select_db("wallet");
  $resulttext = "";
  $query = "select *from population where location like '%".$srchtext."%' order by population desc limit 10;";
  $rowselem = array();
  if($sql)
  {
	 $result=mysql_query($query,$con);
	 $nres=mysql_num_rows($result);
	 if($nres > 0){
	    while($row = mysql_fetch_array($result))
	    $rowselem[] = $row;
	    $i = 0;
	    foreach($rowselem as $elem){
	 	$resulttext .=  '<input type="hidden" id="cityid" value='.$elem['id'].'>';
		$resulttext .= '<input type="hidden" id="location" value='.$elem['location'].'>';
		$resulttext .= '<input type="hidden" id="slug" value='.$elem['slug'].'>';
		$resulttext .=  '<input type="hidden" id="popul" value='.$elem['population'].'>';
		$i++;
		}
	 }
  }
  $rowsjson = json_encode($rowselem);
  $resarr = (array('json'=>$rowselem,'html'=>$resulttext));
  extract($resarr);
  echo json_encode($resarr);

?>