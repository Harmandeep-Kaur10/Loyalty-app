<?php
use Illuminate\Support\Facades\Process;


function is_queue_running( $queue, $name )
{
	$cmd  = "ps aux | grep 'php artisan queue:work --tries=1 --name=$name --queue=$queue' | grep -v 'ps aux\|grep'";

	$result = Process::run($cmd);

	if( $result->output() == "" ){
		return "no";
	}

	return "yes";
}

function restart_queue_if_stopped( $queue, $name )
{
	$result = is_queue_running( $queue, $name );

	if( $result == "no" ){
		$project_path = base_path();
		$cmd    = "cd $project_path && nohup php artisan queue:work --tries=1 --name=$name --queue=$queue &";
		$result = Process::run($cmd);
		Log::info("[Queue re run][queue => $queue][name => $name]");
	}
}


function band_paddi_queues_run_karo()
{
	//agar env QUEUES mai kuch ni hai toh
	if( ! env("QUEUES") ){
		return ;
	}

	$queues   = json_decode(env("QUEUES"));
	$app_name = strtolower(str_replace(" ","_",env("APP_NAME")));

	foreach( $queues as $queue )
	{
		$q     = explode("~~",$queue);

		$queue = $q[0];
		$name  = $app_name."_".$queue."_".$q[1];
		restart_queue_if_stopped( $queue, $name );
	}
}
