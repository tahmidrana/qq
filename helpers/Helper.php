<?php
/**
* 
*/
class Helper {

	public function validation($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function stringModify($data){
		return substr($data, 0, 40);
	}

	public function nameModify($data){
		$str = "";
		for($i = 0; $i!= strlen($data) ; $i++){
			$str .= $data[$i];
			if($data[$i] == " ")
				break;
			else
				continue;
		}
		return $str;
	}

	public function convertDateToTime($datetime, $full = false){
		date_default_timezone_set('Asia/Dhaka');
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
		    'y' => 'year',
		    'm' => 'month',
		    'w' => 'week',
		    'd' => 'day',
		    'h' => 'hour',
		    'i' => 'minute',
		    's' => 'second',
		);
		foreach ($string as $k => &$v) {
		    if ($diff->$k) {
		        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		    } else {
		        unset($string[$k]);
		    }
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';

	}

	public function dateFormate($date){
		return date('F j, Y, g:i a', strtotime($date));
	}



	
}
?>