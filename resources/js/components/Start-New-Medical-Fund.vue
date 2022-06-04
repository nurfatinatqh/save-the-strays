<template>
    <div>
        <table style="border: 1px solid; width: 100%">
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="username">PET NAME </label></td>
                <td style="border: 1px solid; padding: 10px;"><input @keydown.space="(event) => event.preventDefault()" :maxlength=30 style="width: 100%" type="text" id="pet_name" name="pet_name" required></td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="health_condition">HEALTH CONDITION </label></td>
                <td style="border: 1px solid; padding: 10px;">
                    <textarea style="width: 100%" name="health_condition" id="health_condition" cols="30" rows="3" required></textarea>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="phone_number">PHONE NUMBER </label></td>
                <td style="border: 1px solid; padding: 10px;"><input v-on:keypress="NumbersOnly" @keydown.space="(event) => event.preventDefault()" :maxlength=12 :minlength=10 style="width: 100%" type="text" id="phone_number" name="phone_number" required></td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="email">EMAIL </label></td>
                <td style="border: 1px solid; padding: 10px;"><input :maxlength=30 style="width: 100%" type="email" id="email" name="email" required></td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="bank">BANK </label></td>
                <td style="border: 1px solid; padding: 10px;">
                    <select style="width: 100%;" id="bank" name="bank" required>
                        <option> </option>
                        <option>	AFFIN BANK	</option>
                        <option>	AGROBANK	</option>
                        <option>	AL-RAJHI MALAYSIA	</option>
                        <option>	ALLIANCE BANK MALAYSIA BERHAD	</option>
                        <option>	AMBANK	</option>
                        <option>	BANK ISLAM MALAYSIA	</option>
                        <option>	BANK MUAMALAT MALAYSIA BERHAD	</option>
                        <option>	BANK RAKYAT	</option>
                        <option>	BANK SIMPANAN NASIONAL (BSN)	</option>
                        <option>	CIMB BANK BERHAD	</option>
                        <option>	CITIBANK MALAYSIA	</option>
                        <option>	CO-OP BANK PERTAMA	</option>
                        <option>	HONG LEONG BANK	</option>
                        <option>	HSBC BANK MALAYSIA	</option>
                        <option>	MAYBANK	</option>
                        <option>	MBSB BANK BERHAD	</option>
                        <option>	OCBC BANK MALAYSIA	</option>
                        <option>	PUBLIC BANK BERHAD	</option>
                        <option>	RHB BANK	</option>
                        <option>	STANDARD CHARTERED BANK MALAYSIA	</option>
                        <option>	UOB MALAYSIA	</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="bank_no">BANK NUMBER </label></td>
                <td style="border: 1px solid; padding: 10px;"><input v-on:keypress="NumbersOnly" @keydown.space="(event) => event.preventDefault()" :maxlength=19 :minlength=6 style="width: 100%" type="text" id="bank_no" name="bank_no" required></td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="bank_owner_name">BANK OWNER FULL NAME </label></td>
                <td style="border: 1px solid; padding: 10px;"><input :maxlength=30 style="width: 100%" type="text" id="bank_owner_name" name="bank_owner_name" required></td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="expected_amount">EXPECTED AMOUNT </label></td>
                <td style="border: 1px solid; padding: 10px;"><input :max=5000 step=".01" style="width: 100%" type="number" id="expected_amount" name="expected_amount" required></td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="current_amount">CURRENT AMOUNT </label></td>
                <td style="border: 1px solid; padding: 10px;"><input :max=5000 step=".01" style="width: 100%" type="number" id="current_amount" name="current_amount" required></td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="pet_picture">PET PICTURE </label></td>
                <td style="border: 1px solid; padding: 10px;"><input style="width: 100%" id="pet_picture" name="pet_picture" type="file" required></td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="vet_analysis">VET ANALYSIS </label></td>
                <td style="border: 1px solid; padding: 10px;"><input style="width: 100%" id="vet_analysis" name="vet_analysis" type="file" required></td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        methods: {
            displayError() {
                if (errors.length > 0) {
                    alert(`MEDICAL FUND FAIL TO START NOTICE\n\n` + errors.map((i, key) => `${(key+1)}. ${i}`).join('\n'));
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
