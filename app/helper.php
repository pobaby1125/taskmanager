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