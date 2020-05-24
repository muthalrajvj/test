<?php 
function getPaymentSchedule($date1,$date2,$amount)
{
	$output = [];
	 $begin = new DateTime( $date1 );
    $end = new DateTime( $date2 );
    $interval = DateInterval::createFromDateString('1 month');
    $period = new DatePeriod($begin, $interval, $end);
    $counter = 0;
    foreach($period as $dt) {
        $counter++;
    }
$start   = strtotime($date1);
$finish   = date('m-Y', strtotime($date2));
$mdiff = date('m',$finish) - date('m',$start);
for($x=1;$x<=$counter;$x++){
    $month = date('m-Y', $start);
    if($x==1){
    	$total = date('t', $start) - date('d',$start);
    	$due =($amount/date('t',$start))*($total+1);
    	$due = round($due);
    $output[$x] = [
    	'due_no' => $x,
        'due_date' => $date1,
        'due_amount' => intval($due),
    ];
}elseif($x== $counter){
	$total = date('d',strtotime($date2));
	$due=($amount/date('t',strtotime($date2)))*$total;
	$due = round($due);
    $output[$x] = [
    	'due_no' => $x,
        'due_date' => $date2,
        'due_amount' => intval($due),
    ];
}
else{
	$total = date('t',$start);
    $output[$x] = [
    	'due_no' => $x,
        'due_date' => "01-".$month,
        'due_amount' => $amount,
    ];
}

    $start = strtotime('+1 month', $start);
}
return var_dump($output);
}
$start_date = '2020-04-17';
$end_date = '2020-08-24';
$regular_amount = 10000;
echo getPaymentSchedule($start_date,$end_date,$regular_amount);
?>