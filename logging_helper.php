<?php 

function elog($msg, $msd='0', $stakeholder='0', $json='0'){ // mtlb event logs
        if($json){
                if(gettype($json) != "string"){
                        $json = json_encode($json);
                }
                $dump_key = rand(1111,9999); // ye grep marke dump nikalne k kaam aygi
                Log::info("[ELOG] $msd | $stakeholder | $msg | dump_key=$dump_key");
                Log::info("[JSON_DUMP] dump_key=$dump_key | $json");
        } else {
                Log::info("[ELOG] $msd | $stakeholder | $msg");
        }
}

