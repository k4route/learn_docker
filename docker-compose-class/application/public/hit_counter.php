<?php

    try {

        $redis = new Redis();
        $redis->connect('redis', 6379);
        $redis->auth('EXAMPLE_PASSWORD');

        $siteVisitsMap  = 'siteStats';
        $visitorHashKey = '';           

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

           $visitorHashKey = $_SERVER['HTTP_CLIENT_IP'];

        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

           $visitorHashKey = $_SERVER['HTTP_X_FORWARDED_FOR'];

        } else {

           $visitorHashKey = $_SERVER['REMOTE_ADDR'];
        }
      
        $totalVisits = 0;

        if ($redis->hExists($siteVisitsMap, $visitorHashKey)) {

            $visitorData = $redis->hMget($siteVisitsMap,  array($visitorHashKey));
            $totalVisits = $visitorData[$visitorHashKey] + 1;

        } else {

            $totalVisits = 1;

        }

        $redis->hSet($siteVisitsMap, $visitorHashKey, $totalVisits);

        echo "Welcome, you've visited this page " .  $totalVisits . " times\n";

    } catch (Exception $e) {
        echo $e->getMessage();
    }
?>
