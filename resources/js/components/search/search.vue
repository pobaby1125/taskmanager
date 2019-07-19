<template>
    <form class="form-inline">
        <div class="input-group">
            
            <input type="text" @focus="fetch" class="form-control" placeholder="--实时任务检索--" aria-label="search" aria-describedby="basic-addon1">

            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-btn fa-search"></i></span>
            </div>
        </div>
    </form>
</template>

<script>
import { log } from 'util';
export default {
    props:{
        taskList: Array
    },
    data(){
        return {
            tasks:[]
        }
    },
    methods:{
        fetch(){
            console.log('getTaskList');
            
            console.log(this.taskList);
            
            this.tasks = this.taskList
            // axios.get('/tasks/search').then((res)=>{
            //     this.tasks = res.data.tasks;
            // }).catch((err)=>{

            // })
        }
    }
}
</script>

