<template>
    <div>
        <table style="border: 1px solid; width: 100%">
            <tr>
                <td style="border: 1px solid; padding: 10px;">
                    <input style="width: 100%;" type="text" name="street" id="street" placeholder="Street" required ><br><br>
                    <input style="width: 100%;" type="text" name="area" id="area" placeholder="Area" required ><br><br>
                    <label for="state">STATE</label>
                    <select style="width: 40%;" id="state" name="state" v-model='selectedState' v-on:change='setDistrict(selectedState)' required>
                        <option v-for="location in locations" :key="location.id" v-text="location.state"></option>
                    </select>
                    &nbsp;&nbsp;
                    <label for="district"> DISTRICT</label>
                    <select style="width: 40%;" id="district" name="district" v-model='selectedDistrict' required>
                        <option v-for="district in districts" :key="district.id" v-text="district"></option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                locations: [
                    { state: 'JOHOR', district: ['BATU PAHAT', 'JOHOR BAHRU', 'KLUANG', 'KOTA TINGGI', 'KULAI', 'MERSING', 'MUAR', 'PONTIAN', 'SEGAMAT', 'TANGKAK']},
                    { state: 'KEDAH', district: ['SUNGAI PETANI','ALOR SETAR','KULIM','KUBANG PASU','BALING','PENDANG','LANGKAWI','YAN','SIK','PADANG TERAP','POKOK SENA','BANDAR BAHARU']},
                    { state: 'KELANTAN', district: ['KOTA BHARU','PASIR MAS','TUMPAT','BACHOK','TANAH MERAH','PASIR PUTEH','KUALA KRAI','MACHANG','GUA MUSANG','JELI','LOJING']},
                    { state: 'MELAKA', district: ['MELAKA TENGAH',	'ALOR GAJAH','JASIN']},
                    { state: 'NEGERI SEMBILAN', district: ['SEREMBAN','JEMPOL','PORT DICKSON','TAMPIN','KUALA PILAH','REMBAU','JELEBU']},
                    { state: 'PAHANG', district: ['KUANTAN','TEMERLOH','BENTONG','MARAN','ROMPIN','PEKAN','BERA','RAUB','JERANTUT','LIPIS','CAMERON HIGHLANDS']},
                    { state: 'PERAK', district: ['KINTA','LARUT, MATANG DAN SELAMA','MANJUNG','HILIR PERAK','KERIAN','BATANG PADANG','KUALA KANGSAR','PERAK TENGAH','HULU PERAK','KAMPAR','MUALLIM','BAGAN DATUK']},
                    { state: 'PERLIS', district: ['ARAU','KAKI BUKIT','KANGAR','KUALA PERLIS','PADANG AKBAR','SIMPANG EMPAT'] },
                    { state: 'PULAU PINANG', district: ['TIMUR LAUT PULAU PINANG','SEBERANG PERAI TENGAH','SEBERANG PERAI UTARA','BARAT DAYA PULAU PINANG','SEBERANG PERAI SELATAN']},
                    { state: 'SABAH', district: ['KOTA KINABALU','TAWAU','SANDAKAN','LAHAD DATU','KENINGAU','KINABATANGAN','SEMPORNA','PAPAR','PENAMPANG','BELURAN','TUARAN','RANAU','KOTA BELUD','KUDAT','KOTA MARUDU','BEAUFORT','KUNAK','TENOM','PUTATAN','PITAS','TAMBUNAN','TONGOD','SIPITANG','NABAWAN','KUALA PENYU'] },
                    { state: 'SARAWAK', district: ['KUCHING','MIRI','SIBU','BINTULU','SERIAN','SAMARAHAN','SRI AMAN','MARUDI','BETONG','SARIKEI','KAPIT','BAU','LIMBANG','SARATOK','MUKAH','SIMUNJAN','LAWAS','BELAGA','LUNDU','ASAJAYA','DARO','TATAU','MARADONG','KANOWIT','LUBOK ANTU','SELANGAU','SONG','DALAT','MATU','JULAU','PAKAN','PADAWAN'] },
                    { state: 'SELANGOR', district: ['PETALING','HULU LANGAT','KLANG','GOMBAK','KUALA LANGAT','SEPANG','KUALA SELANGOR','HULU SELANGOR','SABAK BERNAM', 'SHAH ALAM']},
                    { state: 'TERENGGANU', district: ['KUALA TERENGGANU','KEMAMAN','DUNGUN','BESUT','MARANG','HULU TERENGGANU','SETIU','KUALA NERUS'] },
                    { state: 'WILAYAH PERSEKUTUAN MALAYSIA', district: ['KUALA LUMPUR','LABUAN','PUTRAJAYA'] },
                ],
                districts : [],
                selectedState: null,
                selectedDistrict: null
            }
        },
        methods: {
            displayError() {
                if (errors.length > 0) {
                    alert(`VOLUNTEER REGISTRATION FAIL NOTICE\n\n` + errors.map((i, key) => `${(key+1)}. ${i}`).join('\n'));
                }
            },
            setDistrict(location) {
                this.locations.forEach(temp => {
                    if (temp.state == location) {
                        this.districts = temp.district;
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
