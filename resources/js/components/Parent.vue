<template>
    <div id="appContain">
        <pre> {{ origin }} </pre>
        <child :data="origin"></child>
    </div>
</template>

<script>
    import Child from "./Child.vue";
    
    export default {
        components:{
            Child
        },
        data(){
            return {
                origin: [
                    { name: 'parent data change 01' },
                    { name: 'parent data change 02' }
                ]
            };
        }
    };
</script>

