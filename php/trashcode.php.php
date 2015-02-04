<?php
	// The request is a JSON request.
	// We must read the input.
	// $_POST or $_GET will not work!


	$data = json_decode(file_get_contents("php://input"));

	$connection = mysqli_connect('localhost',$username,$password,$dbname);


	mysql_select_db('test', $con);

	$qry_em = 'select count(*) as cnt from users where email ="' . $uemail . '"';
	$qry_res = mysql_query($qry_em);
	$res = mysql_fetch_assoc($qry_res);
 
if ($res['cnt'] == 0) {
    $qry = 'INSERT INTO users (name,pass,email) values ("' . $usrname . '","' . $upswd . '","' . $uemail . '")';
    $qry_res = mysql_query($qry);
    if ($qry_res) {
        $arr = array('msg' => "User Created Successfully!!!", 'error' => '');
        $jsn = json_encode($arr);
        print_r($jsn);
    } else {
        $arr = array('msg' => "", 'error' => 'Error In inserting record');
        $jsn = json_encode($arr);
        print_r($jsn);
    }
} else {
    $arr = array('msg' => "", 'error' => 'User Already exists with same email');
    $jsn = json_encode($arr);
    print_r($jsn);
}

	// Static array for this demo
	$values = array('php', 'web', 'angularjs', 'js');

	// Check if the keywords are in our array
	if(in_array($objData->data, $values)) {
		echo 'I have found what you\'re looking for!';
	}
	else {
		echo 'Sorry, no match!';
	}
?>