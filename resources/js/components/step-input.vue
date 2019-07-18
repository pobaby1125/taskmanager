<template>
    <div class="card">
        <div class="card-header">
            <div class="form-group">
                <label v-if="!newStep">要完成当前任务，需要哪些步骤？</label>
                <input type="text" ref="newStep" v-model="newStep" @keyup.enter="addStep" class="form-control">
            </div>

            <button class="btn btn-sm btn-success pull-right" v-if="newStep" @click="addStep">添加步骤</button>
        </div>
    </div>
</template>


<script>
    import { Message } from 'element-ui'
    import 'element-ui/lib/theme-chalk/index.css'

    export default {
        props:[
            'route'
        ],
        data(){
            return {
                'newStep' : ''  
            }   
        },
        methods:{
            addStep(){
                axios.post( this.route, { name: this.newStep }).then( (res)=>{
                    // this.$emit('add', res.data.step)
                    // this.newStep = ''
                    //添加后直接刷新
                    window.location.reload();
                }).catch((err)=>{
                    if ( err.response.status === 422 )
                    {
                        Message.error(err.response.data.errors.name[0])
                    }
                })
            }
        }
    }
</script>

