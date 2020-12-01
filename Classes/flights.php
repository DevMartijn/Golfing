<?php
class Flights{
	
	// Get flights
	function getFlights ( array $golfers ) : array
	{
		$array = array();
		foreach($golfers as $golfer){
			array_push($array, $golfer[0]);
		}
		
		// Get avarage of all golfers
		$average = round(array_sum($array) / count($array), 1);
		
		$diff = array();
		
		// Difference between each golfer
		foreach ($array as &$value) {
			array_push($diff, $this->calc_diff($value, $average));
		}
		
		asort($diff);
		
		$count = 0;
		$total_array = ceil(count($diff) / 4);
	
		
		// Sort first half of array
		while($total_array > $count){
			
			$first = reset($diff);
			$last = end($diff);
			
			$first = $first + $average;
			$last = $last + $average;
			
			${"flight" . $count} = array($this->getGolfer($golfers, $first), $this->getGolfer($golfers, $last));
			
			array_shift($diff);
			array_pop($diff);
			
			$count++;
		}
		
		// Sort second half of array
		$count2 = 0;
		while($total_array > $count2){
			if(count($diff) > 1){
				$first = reset($diff);
				$last = end($diff);
				
				$first = $first + $average;
				$last = $last + $average;
				
				array_push(${"flight" . $count2}, $this->getGolfer($golfers, $first), $this->getGolfer($golfers, $last));
				
				array_shift($diff);
				array_pop($diff);
			}elseif(count($diff) == 1){
				$last = end($diff);
				$last = $last + $average;
				array_pop($diff);
				array_push(${"flight" . $count2}, $this->getGolfer($golfers, $last));
			}
			$count2++;
		}
		
		// return flights
		$flights = array();
		$count3 = 0;
		while($total_array > $count3){
			array_push($flights, ${"flight" . $count3});
			$count3++;
		}
		return $flights;
	}
	
	function calc_diff($v1, $v2) {
		$diff = $v1 - $v2;
		return $diff;
	}
	
	// Get golfers back
	function getGolfer($golfers, $handicap){
		foreach($golfers as $golfer){
			if($golfer[0] == $handicap){
				return($golfer);
			}
		}
	}
}
?>