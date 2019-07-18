<template>
    <div class="card mb-4" v-if="steps.length">
        
        <slot></slot>

        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item" v-for="(step, i) in steps">
                    <span @dblclick="edit(step, i)" ref="stepName" >{{ step.name }}</span>
                    <input type="text" v-model="editedStep"  @keyup.enter="update(step)" ref="stepInput" style="display:none;" class="form-control" />
                    
                    <span class="pull-right">
                        <button class="btn btn-sm btn-success" @click="toggle(step)">完成</button>
                        <button class="btn btn-sm btn-danger" @click="remove(step)">删除</button>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { log } from 'util';

export default {
    props:{
        route: String,
        steps: Array
    },
    data(){
        return {
            editedStep: ""
        }
    },
    methods:{
        toggle(step){
            axios.patch(`${this.route}/${step.id}/toggle`, {completion: !step.completion})
                .then((res)=>{
                    window.location.reload()
                })
        },
        remove(step){
            axios.delete( `${this.route}/${step.id}`).then((res)=>{
                window.location.reload()
            })
            
        },
        edit(step, i){
            console.log(this.$refs.stepInput)
            this.$refs.stepName[i].style.display = 'none'
            this.$refs.stepInput[i].style.display = 'block'
            this.editedStep = step.name
        },
        update(step){
            axios.patch(`${this.route}/${step.id}`, {name: this.editedStep})
                .then((res)=>{
                    window.location.reload()
                })
        }
    }
}
</script>

