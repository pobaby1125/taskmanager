<template>
    <div class="row justify-content-center">
        <div class="col-4 mr-3">
            <step-list :route="route" :steps="inProcess">
                <div class="card-header">
                    待完成的步骤（{{ inProcess.length }}）
                    <button class="btn btn-sm btn-success pull-right" @click="completeAll">完成所有</button>
                </div>
            </step-list>

            <step-input :route="route" @add="sync"></step-input>
        </div> 

        <div class="col-4" v-show="processed.length">
            <step-list :route="route" :steps="processed">
                <div class="card-header">
                    已完成的步骤（{{ processed.length }}）
                    <button class="btn btn-sm btn-danger pull-right" @click="clearCompleted">清除已完成</button>
                </div>
            </step-list>
        </div>
    </div>
</template>


<script>
import { log } from 'util';
import StepInput from './step-input'
import StepList from './step-list'
import { Hub } from '../event-bus'

export default {
    props:[
        'route'
    ],
    components:{
        'step-input': StepInput,
        'step-list': StepList
    },
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
        Hub.$on('remove', this.remove)   // 调用 Hub.$emit('remove')
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
        sync(step){
            this.steps.push(step)
        },
        remove(step){
            let i = this.steps.indexOf(step)
            this.steps.splice(i, 1)
 
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


