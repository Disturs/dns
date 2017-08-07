<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
if(!isset($_GET['ip'])){
?>
<form id="form1" name="form1" method="get" action="">
  <table width="466" border="0" align="center">
    <tr>
      <td width="136" align="right">ip：</td>
      <td width="178"><label for="ip"></label>
      <input type="text" name="ip" id="ip" /></td>
      <td width="138"><input type="submit" value="查询" /></td>
    </tr>
  </table>
</form>
<?php
}else{
        $ak='';//请输入ak密钥
        $a = @file_get_contents('https://api.map.baidu.com/highacciploc/v1?qcip='.$_GET['ip'].'&ak='.$ak.'&qterm=pc&extensions=1&coord=bd09ll&callback_type=json');
        //$a= '{"content":{"location":{"lat":37.847698,"lng":112.566548},"locid":"f3b3c8aaa749c395b14605fdf0933e9f","radius":8956,"confidence":0.2,"address_component":{"country":"中国","province":"山西省","city":"太原市","district":"迎泽区","street":"解放南路","street_number":"77","admin_area_code":140106},"formatted_address":"山西省太原市迎泽区解放南路77","business":"双塔西街,并州北路,亲贤北街"},"result":{"error":161,"loc_time":"2016-10-31 09:21:13"}} ';
        if(!empty($a)){
        $re = json_decode($a,true);
        foreach($re as $key => $va){
                if($key == "result"){
                        foreach($va as $key2 => $va2){
                                if($key2 == "loc_time")echo'查询时间：'.$va2.'<br>';
                        }        
                }
                foreach($va as $key2 => $va2){
                        if($key2 == "location"){
                                foreach($va2 as $key3 => $va3){
                                        if($key3 == "lat")echo'纬度：'.$va3.'<br>';
                                        if($key3 == "lng")echo'经度：'.$va3.'<br>';
                                }
                        }
                        if($key2 == "formatted_address"){
                                echo '查询ip的地址为：'.$va2.'<br>';
                        }
                        if($key2 == "business"){
                                echo '详细地址为：'.$va2.'<br>';
                        }
                }
        }
        }else{
                echo '查询失败！';
        }
}
?>
