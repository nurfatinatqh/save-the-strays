<template>
    <div>
        <div class="form-group">
            <input class="form-control" placeholder="Username" id="username" type="text" name="username"  required autofocus />
        </div>
        <div class="form-group">
            <input class="form-control" id="password" type="password" name="password" placeholder="Password" required autocomplete="current-password"/>
        </div>
        <div class="form-group">
            <button class="btn btn-login"><b>Login</b></button>
        </div>
    </div>
</template>

<script>
    export default {

        methods: {
            displayError() {
                if (errors.length > 0) {
                    alert(`LOGIN FAIL NOTICE\n\n` + errors.map((i, key) => `${(key+1)}. ${i}`).join('\n'));
                }
            }
        },
        mounted() {
            this.displayError();
        }
    }
</script>
