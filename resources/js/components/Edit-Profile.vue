<template>
    <div>
        <table style="border: 1px solid; width: 100%">
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="username">USERNAME </label></td>
                <td style="border: 1px solid; padding: 10px;"><input @keydown.space="(event) => event.preventDefault()" :minlength="6" style="width: 100%" type="text" id="username" name="username" v-model="name" required></td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="email">EMAIL &nbsp;&nbsp;</label></td>
                <td style="border: 1px solid; padding: 10px;"><input @keydown.space="(event) => event.preventDefault()" style="width: 100%" type="email" id="email" name="email" v-model="email" required></td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="phone_number">PHONE NUMBER </label></td>
                <td style="border: 1px solid; padding: 10px;"><input v-on:keypress="NumbersOnly" @keydown.space="(event) => event.preventDefault()" :minlength=9 style="width: 100%" type="text" id="phone_number" name="phone_number" v-model="phone_number" required></td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="address">ADDRESS </label></td>
                <td style="border: 1px solid; padding: 10px;"><textarea style="width: 100%" name="address" id="address" cols="30" rows="3" v-model="address" required></textarea></td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="password">PASSWORD </label></td>
                <td style="border: 1px solid; padding: 10px;">
                    <input style="width: 100%" type="password" autocomplete="new-password" :minlength="8" id="password" name="password" placeholder="For password change only."></td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="password">CONFIRM PASSWORD </label></td>
                <td style="border: 1px solid; padding: 10px;"><input style="width: 100%" id="password_confirmation" autocomplete="off" :minlength="8" type="password" name="password_confirmation" placeholder="For password change only."></td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="password">PROFILE PICTURE </label></td>
                <td style="border: 1px solid; padding: 10px;"><input style="width: 100%" id="image" name="image" accept="image/*" type="file"></td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: user['username'],
                email: user['email'],
                phone_number: user['phone_number'],
                address: user['address'],
            }
        },
        methods: {
            displayError() {
                if (errors.length > 0) {
                    alert(`UPDATE PROFILE FAIL NOTICE\n\n` + errors.map((i, key) => `${(key+1)}. ${i}`).join('\n'));
                }
            },
            NumbersOnly(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                    evt.preventDefault();;
                } else {
                    return true;
                }
            }
        },
        mounted() {
            this.displayError();
        }
    }
</script>
