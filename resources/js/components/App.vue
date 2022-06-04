<template>
    
    <div>
        <message>Hello There!</message>
        <counter>Iam Jenny!</counter>
    </div>

</template>

<script>

    import Message from './Message.vue';
    import Counter from './Counter.vue'

    export default {
        components: { Message, Counter},

        data() {
            return {}
        }
    }

</script>

<style>

</style>