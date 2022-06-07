<template>
    <div>
        <table style="border: 1px solid; width: 100%">
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="username">NAME </label></td>
                <td style="border: 1px solid; padding: 10px;"><input :maxlength=100 style="width: 100%" type="text" id="name" name="name" required></td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label>PET TYPE &nbsp;&nbsp;</label></td>
                <td style="border: 1px solid; padding: 10px;">
                    <div class="row">
                        <div class="col-sm-4">
                            <input type="radio" id="cat" name="type" value="Cat" required>
                            <label for="cat">CAT</label><br>
                        </div>
                        <div class="col-sm-4">
                            <input type="radio" id="dog" name="type" value="Dog" required>
                            <label for="dog">DOG</label><br>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label>GENDER &nbsp;&nbsp;</label></td>
                <td style="border: 1px solid; padding: 10px;">
                    <div class="row">
                        <div class="col-sm-4">
                            <input type="radio" id="male" name="gender" value="Male" required>
                            <label for="male">MALE</label><br>
                        </div>
                        <div class="col-sm-4">
                            <input type="radio" id="female" name="gender" value="Female" required>
                            <label for="female">FEMALE</label><br>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="username">HEALTH CONDITION </label></td>
                <td style="border: 1px solid; padding: 10px;"><input :maxlength=100 style="width: 100%" type="text" id="health_condition" name="health_condition" required></td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="address">LOCATION </label></td>
                <td style="border: 1px solid; padding: 10px;">
                    <textarea style="width: 100%" name="location" id="location" cols="30" rows="3" required></textarea>
                    <label for="state">STATE</label>
                    <select style="width: 40%;" id="state" name="state" v-model='selectedState' v-on:change='setCity(selectedState)' required>
                        <option v-for="location in locations" :key="location.id" v-text="location.state"></option>
                    </select>
                    &nbsp;&nbsp;
                    <label for="city"> CITY</label>
                    <select style="width: 40%;" id="city" name="city" v-model='selectedCity' required>
                        <option v-for="city in cities" :key="city.id" v-text="city"></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="phone_number">PHONE NUMBER </label></td>
                <td style="border: 1px solid; padding: 10px;"><input v-on:keypress="NumbersOnly" @keydown.space="(event) => event.preventDefault()" :maxlength=12 :minlength=10 style="width: 100%" type="text" id="phone_number" name="phone_number" required></td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><label for="pet_picture">PET PICTURE </label></td>
                <td style="border: 1px solid; padding: 10px;"><input style="width: 100%" id="pet_picture" name="pet_picture" type="file" required></td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                locations: [
                    { state: 'JOHOR', area: ['BATU PAHAT', 'JOHOR BAHRU', 'KLUANG', 'KOTA TINGGI', 'KULAI', 'MERSING', 'MUAR', 'PONTIAN', 'SEGAMAT', 'TANGKAK']},
                    { state: 'KEDAH', area: ['SUNGAI PETANI','ALOR SETAR','KULIM','KUBANG PASU','BALING','PENDANG','LANGKAWI','YAN','SIK','PADANG TERAP','POKOK SENA','BANDAR BAHARU']},
                    { state: 'KELANTAN', area: ['KOTA BHARU','PASIR MAS','TUMPAT','BACHOK','TANAH MERAH','PASIR PUTEH','KUALA KRAI','MACHANG','GUA MUSANG','JELI','LOJING']},
                    { state: 'MELAKA', area: ['MELAKA TENGAH',	'ALOR GAJAH','JASIN']},
                    { state: 'NEGERI SEMBILAN', area: ['SEREMBAN','JEMPOL','PORT DICKSON','TAMPIN','KUALA PILAH','REMBAU','JELEBU']},
                    { state: 'PAHANG', area: ['KUANTAN','TEMERLOH','BENTONG','MARAN','ROMPIN','PEKAN','BERA','RAUB','JERANTUT','LIPIS','CAMERON HIGHLANDS']},
                    { state: 'PERAK', area: ['KINTA','LARUT, MATANG DAN SELAMA','MANJUNG','HILIR PERAK','KERIAN','BATANG PADANG','KUALA KANGSAR','PERAK TENGAH','HULU PERAK','KAMPAR','MUALLIM','BAGAN DATUK']},
                    { state: 'PERLIS', area: ['ARAU','KAKI BUKIT','KANGAR','KUALA PERLIS','PADANG AKBAR','SIMPANG EMPAT'] },
                    { state: 'PULAU PINANG', area: ['TIMUR LAUT PULAU PINANG','SEBERANG PERAI TENGAH','SEBERANG PERAI UTARA','BARAT DAYA PULAU PINANG','SEBERANG PERAI SELATAN']},
                    { state: 'SABAH', area: ['KOTA KINABALU','TAWAU','SANDAKAN','LAHAD DATU','KENINGAU','KINABATANGAN','SEMPORNA','PAPAR','PENAMPANG','BELURAN','TUARAN','RANAU','KOTA BELUD','KUDAT','KOTA MARUDU','BEAUFORT','KUNAK','TENOM','PUTATAN','PITAS','TAMBUNAN','TONGOD','SIPITANG','NABAWAN','KUALA PENYU'] },
                    { state: 'SARAWAK', area: ['KUCHING','MIRI','SIBU','BINTULU','SERIAN','SAMARAHAN','SRI AMAN','MARUDI','BETONG','SARIKEI','KAPIT','BAU','LIMBANG','SARATOK','MUKAH','SIMUNJAN','LAWAS','BELAGA','LUNDU','ASAJAYA','DARO','TATAU','MARADONG','KANOWIT','LUBOK ANTU','SELANGAU','SONG','DALAT','MATU','JULAU','PAKAN','PADAWAN'] },
                    { state: 'SELANGOR', area: ['PETALING','HULU LANGAT','KLANG','GOMBAK','KUALA LANGAT','SEPANG','KUALA SELANGOR','HULU SELANGOR','SABAK BERNAM', 'SHAH ALAM']},
                    { state: 'TERENGGANU', area: ['KUALA TERENGGANU','KEMAMAN','DUNGUN','BESUT','MARANG','HULU TERENGGANU','SETIU','KUALA NERUS'] },
                    { state: 'WILAYAH PERSEKUTUAN MALAYSIA', area: ['KUALA LUMPUR','LABUAN','PUTRAJAYA'] },
                ],
                cities : [],
                selectedState: null,
                selectedCity: null
            }
        },
        methods: {
            displayError() {
                if (errors.length > 0) {
                    alert(`PET PROFILE CREATION FAIL NOTICE\n\n` + errors.map((i, key) => `${(key+1)}. ${i}`).join('\n'));
                }
            },
            setCity(location) {
                this.locations.forEach(temp => {
                    if (temp.state == location) {
                        this.cities = temp.area;
                    }
                });
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
