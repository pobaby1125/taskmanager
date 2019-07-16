<template>
    <div class="row justify-content-center">
        <div class="col-4 mr-3">
            <div class="card mb-4" v-if="inProcess.length">
                <div class="card-header">
                    待完成的步骤（{{ inProcess.length }}）
                    <button class="btn btn-sm btn-success pull-right" @click="completeAll">完成所有</button>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="step in inProcess">
                            <span @dblclick="edit(step)" >{{ step.name }}</span>
                            <span class="pull-right">
                                <button class="btn btn-sm btn-success" @click="toggle(step)">完成</button>
                                <button class="btn btn-sm btn-danger" @click="remove(step)">删除</button>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="form-group">
                        <label v-if="!newStep">要完成当前任务，需要哪些步骤？</label>
                        <input type="text" ref="newStep" v-model="newStep" @keyup.enter="addStep" class="form-control">
                    </div>

                    <button class="btn btn-sm btn-success pull-right" v-if="newStep" @click="addStep">添加步骤</button>
                </div>
            </div>

        </div> 

        <div class="col-4" v-show="processed.length">
            <div class="card">
                <div class="card-header">
                    已完成的步骤（{{ processed.length }}）
                    <button class="btn btn-sm btn-danger pull-right" @click="clearCompleted">清除已完成</button>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="step in processed">
                            <span @dblclick="edit(step)" >{{ step.name }}</span>
                            <span class="pull-right">
                                <button class="btn btn-sm btn-primary" @click="toggle(step)">取消</button>
                                <button class="btn btn-sm btn-danger" @click="remove(step)">删除</button>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import { log } from 'util';
export default {
    props:[
        'route'
    ],
    data(){
        return {
            message: 'hello world!',
            steps:[
                // {name: 'hello world!', completion:false}
            ],
            newStep: ''
        } 
    },
    mounted(){
        this.fetchSteps()
    },
    computed: {
        inProcess(){
            return this.steps.filter((step)=>{
                return !step.completion
            })
        },
        processed(){
            return this.steps.filter((step)=>{
                return step.completion
            })
        }
    },
    methods:{
        fetchSteps(){
            axios.get( this.route ).then((res)=>{
                this.steps = res.data.steps;
            }).catch((err)=>{
                alert(`很抱歉，发生错误，\n ${err.response.data.message} \n 错误码：${err.response.status}` )
            })
        },
        addStep(){  // addStep:function(){}
            axios.post( this.route, { name: this.newStep }).then( (res)=>{
                this.steps.push(res.data.step)
                this.newStep = ''
            }).catch((err)=>{

            })
        },
        toggle(step){
            axios.patch(`${this.route}/${step.id}`, {completion: !step.completion})
                .then((res)=>{
                    step.completion = ! step.completion
                })
        },
        remove(step){
            axios.delete( `${this.route}/${step.id}`).then((res)=>{
                let i = this.steps.indexOf(step)
                this.steps.splice(i, 1)
            })
            
        },
        edit(task){
            // 删除当前step
            this.remove(task)
            // 在输入框中显示当前step的name
            this.newStep = task.name
            // focus当前的输入框
            this.$refs.newStep.focus()
        },
        completeAll(){
            axios.post(`${this.route}/complete`).then((res)=>{
                this.inProcess.forEach((step)=>{
                    step.completion = true
                })
            }) 
        },
        clearCompleted(){
            axios.delete(`${this.route}/clear`).then((res)=>{
                this.steps = this.inProcess
            })
        }
    }
}
</script>


<style>

</style>


