<template>
    <div>
        <div class="form-group">
            <input class="form-control" placeholder="Email" id="email" type="text" name="email" required autofocus />
        </div>
        <div class="form-group">
            <button class="btn btn-login"><b>Email Password Reset Link</b></button>
        </div>
    </div>
</template>

<script>
    export default {

        methods: {
            displayError() {
                if (errors.length > 0) {
                    alert(`PASSWORD RESET FAIL NOTICE\n\n` + errors.map((i, key) => `${(key+1)}. ${i}`).join('\n'));
                }
            }
        },
        mounted() {
            this.displayError();
        }
    }
</script>
