<?php
    function TasksCountArray($projects)
    {
        $counts = [];
        foreach( $projects as $project ){
            $proCount = $project->tasks->count();
            array_push( $counts, $proCount );
        }

        return $counts;
    }

    function randColor()
    {
        $R = rand(0, 255);
        $G = rand(0, 255);
        $B = rand(0, 255);

        return sprintf("rgba(%d, %d, %d, 0.5)", $R, $G, $B);
    }