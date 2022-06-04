<template>
    <div>
        <h1>The counter is {{ counter}}</h1>
        <p>
            <button @click="counter += 1">Increment</button>
        </p>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                counter: 0
            }
        }
    }

</script>