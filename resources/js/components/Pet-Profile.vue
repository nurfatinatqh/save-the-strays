<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <ul class="filter font-alt" id="filters" style="padding:0px 0px 0px;">
                    <li style="padding:0px 0px 0 0px;">
                        <label for="gender">GENDER</label>
                        <select id="gender" name="gender" v-model='filterGender'>
                            <option> MALE </option>
                            <option> FEMALE </option>
                        </select>
                    </li>
                    <li style="padding:0 0 0 0px;">
                        <label for="type">TYPE</label>
                        <select id="type" name="type" v-model='filterType' >
                            <option> CAT </option>
                            <option> DOG </option>
                        </select>
                    </li>
                    <li style="padding:0 0 0 0px;">
                        <label for="state">STATE</label>
                        <select id="state" name="state" v-model='filterState' v-on:change='setState(filterState)' >
                            <option v-for="location in locations" :key="location.id" v-text="location.state"></option>
                        </select>
                    </li>
                    <li style="padding:0 0 0 0px;">
                        <label for="city"> CITY</label>
                        <select id="city" name="city" v-model='filterCity' >
                            <option v-for="city in cities" :key="city.id" v-text="city"></option>
                        </select>
                    </li>
                    <li>
                        <button type="submit">SEARCH</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                hello : null,
                pictures_pet: pictures,
                originalList : pets,
                pets : pets,
                filterGender : null,
                filterType : null,
                filterState: null,
                filterCity: null,
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
                selectedCity: null
            }
        },
        methods: {
            // setGender(gender) {
            //     this.pets = this.originalList;
            //     this.pets = this.pets.filter(pet => pet.gender.toLowerCase() == gender.toLowerCase());
            //     this.filterType != null ? this.pets = this.pets.filter(pet => pet.type.toLowerCase() == this.filterType.toLowerCase()) : null;
            //     this.filterState != null ? this.pets = this.pets.filter(pet => pet.state == this.filterState) : null;
            //     this.filterCity != null ? this.pets = this.pets.filter(pet => pet.city == this.filterCity) : null;
            // },
            // setType(type) {
            //     this.pets = this.originalList;
            //     this.pets = this.pets.filter(pet => pet.type.toLowerCase() == type.toLowerCase());
            //     this.filterGender != null ? this.pets = this.pets.filter(pet => pet.gender.toLowerCase() == this.filterGender.toLowerCase()) : null;
            //     this.filterState != null ? this.pets = this.pets.filter(pet => pet.state == this.filterState) : null;
            //     this.filterCity != null ? this.pets = this.pets.filter(pet => pet.city == this.filterCity) : null;
            // },
            setState(state) {
                this.locations.forEach(temp => {
                    if (temp.state == state) {
                        this.cities = temp.area;
                    }
                });
                // this.pets = this.originalList;
                // this.pets = this.pets.filter(pet => pet.state == state);
                // this.filterGender != null ? this.pets = this.pets.filter(pet => pet.gender.toLowerCase() == this.filterGender.toLowerCase()) : null;
                // this.filterType != null ? this.pets = this.pets.filter(pet => pet.type.toLowerCase() == this.filterType.toLowerCase()) : null;
                // this.filterCity != null ? this.pets = this.pets.filter(pet => pet.city == this.filterCity) : null;
            },
            // setCity(city) {
            //     this.pets = this.originalList;
            //     this.pets = this.pets.filter(pet => pet.city == city);
            //     this.filterGender != null ? this.pets = this.pets.filter(pet => pet.gender.toLowerCase() == this.filterGender.toLowerCase()) : null;
            //     this.filterType != null ? this.pets = this.pets.filter(pet => pet.type.toLowerCase() == this.filterType.toLowerCase()) : null;
            //     this.filterState != null ? this.pets = this.pets.filter(pet => pet.state == this.filterState) : null;
            // },
            // getUrl(url) {
            //     axios.get("http://127.0.0.1:8000/url", {
            //         params : {
            //             url : url
            //         }
            //     }).then((response) => { 
            //         this.hello = response.data
            //     });
            //     return this.hello;
            // }
        },

        mounted() {
            
        },
    }
</script>
