<template>
    <div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-4">
                    <input type="radio" id="adopter" name="role" value="ADOPTER" required>
                    <label for="adopter">ADOPTER</label><br>
                </div>
                <div class="col-sm-4">
                    <input type="radio" id="volunteer" name="role" value="VOLUNTEER" required>
                    <label for="volunteer">VOLUNTEER</label><br>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <div class="form-group">
            <input @keydown.space="(event) => event.preventDefault()" :minlength="6" :maxlength="30" class="form-control"  placeholder="Username" id="username" type="text" name="username" required />
        </div>
        <div class="form-group">
            <input class="form-control" placeholder="Email" id="email" type="email" name="email" required />
        </div>
        <div class="form-group">
            <input class="form-control" id="password" type="password" :minlength="8" :maxlength="18" name="password" placeholder="Password" required autocomplete="new-password"/>
        </div>
        <div class="form-group">
            <input class="form-control" id="password_confirmation" :minlength="8" :maxlength="18" type="password" name="password_confirmation" placeholder="Confirm Password" required/>
        </div>
        <div class="form-group">
            <button class="btn btn-login"><b>Register</b></button>
        </div>
    </div>
</template>

<script>
    export default {

        methods: {
            displayError() {
                if (errors.length > 0) {
                    alert(`REGISTRATION FAIL NOTICE\n\n` + errors.map((i, key) => `${(key+1)}. ${i}`).join('\n'));
                }
            }
        },
        mounted() {
            this.displayError();
        }
    }
</script>
