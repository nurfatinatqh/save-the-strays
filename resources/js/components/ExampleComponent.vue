<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <hr>
                <input @keydown.space="(event) => event.preventDefault()" type="text" name="input" id="input" v-model="message">
                <p>The value is {{ message }}</p>

                <hr>

                <ul>
                    <li v-for="name in names" :key="name.id" v-text="name"></li>
                </ul>
                <input type="text" name="input" id="input" v-model="newName">
                <button v-on:click="addName">Add Name</button>
                <!-- <button @click="addName">Add Name</button> -->
                <hr>
                <button :class="className" :title="title">Hello</button>

                <hr>

                <h2> {{ reversedMessage}}</h2>
                
                <hr>
                
                <h3>All Task</h3>
                <ul>
                    <li v-for="task in tasks" :key="task.id" v-text="task.description"></li>
                </ul>
                <h3>Incomplete Task</h3>
                <ul>
                    <li v-for="task in incompleteTasks" :key="task.id" v-text="task.description"></li>
                </ul>
                
                <hr>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: 'Hello World',
                names: ['Joe', 'Jimmy', 'John', 'Nathan'],
                newName: '',
                title: "It's me",
                className: 'color-red',
                tasks: [
                    { description: 'Clean room', completed: true },
                    { description: 'Make donation', completed: false },
                    { description: 'Do assignment', completed: true },
                    { description: 'Grocery shopping', completed: false },
                ]
            }
        },
        methods: {

            addName () {
                this.names.push(this.newName);
            }
        },
        computed: {

            reversedMessage() {
                return this.message.split('').reverse().join('');
            },

            incompleteTasks() {
                return this.tasks.filter(task => ! task.completed);
                // return this.tasks.filter(task => task.completed == 'false');
            }
        }
    }
</script>
