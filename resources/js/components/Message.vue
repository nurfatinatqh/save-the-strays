<template>
    
    <div class="box">
        <p>
            <slot></slot>
        </p>
    </div>

</template>

<script>

    export default {
        
    }

</script>

<style>

    .box {
        background: wheat;
        padding: 10px;
        border: 1px solid blueviolet;
        margin-bottom: 1em;
    }

</style>