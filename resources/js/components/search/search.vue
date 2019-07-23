<template>
    <div class="instant-search">
        <form class="form-inline">
            <div class="input-group">
                <input type="text" v-model="searchStr" @focus="fetch" @blur="leave" class="form-control" placeholder="--实时任务检索--" aria-label="search" aria-describedby="basic-addon1">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-btn fa-search"></i></span>
                </div>
            </div>
        </form>

        <ul class="list-group search-list" v-if="show">
            <li class="list-group-item" v-for="task in filtered">
               <a :href="url(task)">{{ task.name }}</a>
            </li>
        </ul>
    </div>
</template>    



<script>
import { log } from 'util';
import { setInterval, setTimeout } from 'timers';
import { Loading } from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'

export default {
    props:{
        taskList: Array
    },
    data(){
        return {
            tasks:[],
            show : false,
            loaded: false,   // 标记是否已经加载数据
            searchStr: ''
        }
    },
    computed:{
        filtered(){
            let str = this.searchStr.trim().toLowerCase()
            return this.tasks.filter( (task)=>{
                if ( task.name.toLowerCase().indexOf(str) !== -1 )
                {
                    return true
                }
            })
        }
    },
    methods:{
        fetch(){
            if ( ! this.loaded )
            {
                let loading = Loading.service({ target: '.instant-search', spinner: 'el-icon-loading' })
                this.tasks = this.taskList
                this.show = true
                this.loaded = true
                loading.close()
                console.log('load tasks');
                
                
                // axios.get('/tasks/search').then((res)=>{
                //     this.tasks = res.data.tasks;
                // }).catch((err)=>{
                // })
            }
            else
            {
                this.show = true
            }
            
        },
        leave(){
            setTimeout(()=>{
                this.show = false
            }, 2000) 
        },
        url(task){
            return `/tasks/${ task.id }/steps`
        }
    }
}
</script>

<style lang="scss">
    .instant-search {
        height: 3rem;
        z-index: 1000;
        .search-list{
            max-height: 30rem;
            overflow: auto;
        }
    }
</style>


