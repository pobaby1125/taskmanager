<template>
    <div>
        <h1>loading from child component</h1>
        <pre>{{ data }}</pre>
        <pre>{{ localData }}</pre>
        <button @click="changeData">单击改变属性</button>
    </div>
</template>

<script>
export default {
    props:{
        data: Array
    },
    computed:{
        localData(){
            // return this.data.toUpperCase()
        }
    },
    data(){
        return {

        };
    },
    methods:{
        changeData(){
            this.data[1].name = 'hello world form child'
        }
    }
}
</script>

