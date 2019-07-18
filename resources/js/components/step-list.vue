<template>
    <div class="card mb-4" v-if="steps.length">
        
        <slot></slot>

        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item" v-for="step in steps">
                    <span @dblclick="edit(step)" >{{ step.name }}</span>
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

export default {
    props:{
        route: String,
        steps: Array
    },
    methods:{
        toggle(step){
            axios.patch(`${this.route}/${step.id}`, {completion: !step.completion})
                .then((res)=>{
                    window.location.reload()
                })
        },
        remove(step){
            axios.delete( `${this.route}/${step.id}`).then((res)=>{
                window.location.reload()
            })
            
        },
        edit(step){
            // 删除当前step
            this.remove(step)
            Hub.$emit('edit', step)
        },
    }
}
</script>

