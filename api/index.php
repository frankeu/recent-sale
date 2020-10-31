<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

preg_match_all('/<p class="h4 mt-0">(.*?) <small/', file_get_contents('https://www.random-name-generator.com/indonesia?country=id_ID&gender=&n=20'), $data);
// print_r($data);exit();
foreach ($data[1] as $name) {
	$result[] = naming($name);
}
header('Content-Type: application/javascript');
//echo "recent(".json_encode($result).");";
echo "var recentSales = [".json_encode($result)."];setInterval(function(){var o=array[Math.random()*array.length|0];document.getElementById("random").innerHTML=o,$(".custom-social-proof").slideToggle("fast")},5e3),$(".custom-close").click(function(){$(".custom-social-proof").stop().slideToggle("fast")});";



function to_time_ago( $time ) { 
    $diff = time()-(time() - $time); 
    if( $diff < 1 ) {  
        return 'baru saja';  
    }
    $time_rules = array (
		60 * 60 	=> 'jam', 
		60	=> 'menit', 
		1	=> 'detik'
    ); 
    foreach( $time_rules as $secs => $str ) { 
        $div = $diff / $secs; 
        if( $div >= 1 ) {
            $t = round( $div );
            return "$t $str yang lalu"; 
        } 
    } 
} 

function naming($name){
	if(strlen($name) <= 20){
		$p = $name;
	}else{
		$p = substr($name,0,17).'...';
	}
	$p .= "<br>Transaksi Rekber senilai<br><b>Rp ".nominal()."</b><small> ".to_time_ago(rand(1,86400))."</small>";
	return $p;
}

function nominal(){
	return number_format((int) (1000 * ceil(rand(10000,1000000) / 1000)));
}
