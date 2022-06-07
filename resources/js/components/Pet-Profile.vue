<template>
    <div>
        <section class="module pet-profile pb-0" id="works">
            <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">OWN YOURSELF A SWEET PET</h2>
                <div class="module-subtitle font-serif"></div>
                </div>
            </div>
            </div>
            <div class="container">
            <div class="row">
                <div class="col-sm-12">
                <ul class="filter font-alt" id="filters">
                    <li>
                        <label for="gender">GENDER</label>
                        <select id="gender" name="gender" v-model='filterGender' v-on:change='filterList(1)' required>
                            <option> MALE </option>
                            <option> FEMALE </option>
                        </select>
                    </li>
                    <li>
                        <label for="type">TYPE</label>
                        <select id="type" name="type" v-model='filterType' v-on:change='filterList(2)' required>
                            <option> CAT </option>
                            <option> DOG </option>
                        </select>
                    </li>
                    <li>
                        <label for="state">STATE</label>
                        <select id="state" name="state" v-model='filterState' v-on:change='filterList(3)' required>
                            <option v-for="location in locations" :key="location.id" v-text="location.state"></option>
                        </select>
                    </li>
                    <li>
                        <label for="city"> CITY</label>
                        <select id="city" name="city" v-model='filterCity' v-on:change='filterList(4)' required>
                            <option v-for="city in cities" :key="city.id" v-text="city"></option>
                        </select>
                    </li>
                </ul>
                </div>
            </div>
            </div>
            <ul class="works-grid works-grid-gut works-grid-4 works-hover-w" id="works-grid">
                    <li v-for="(pet, index) in filterList()" :key="index" class="work-item" :class="pet.type">
                        <div class="post">
                            <div class="post-thumbnail align-center"><img :src=pet.pet_picture style="height: 200px; position:relative;" width="auto" alt="Blog-post Thumbnail"/></div>
                            <div class="post-header font-alt">
                                <h2 class="post-title"> {{pet.name}} <a :href="'/hello-pets/update-adoption-status/' + pet.id"><button style="float: right; font-size:13px;" class="btn btn-warning btn-xs">UPDATE ADOPTION STATUS</button></a> </h2>
                                <div class="post-meta"><br>
                                    BY {{pet.volunteer['username']}} | {{pet.phone_number}}&nbsp;<br>
                                    {{pet.city}}, {{pet.state}} 
                                </div>
                            </div>
                            <div class="post-entry">
                            <p style="font-size: small;">
                                Gender: {{pet.gender}} <br>
                                Location: {{pet.location}} <br>
                                Health Condition: {{pet.health_condition}}
                            </p>
                            </div>
                        </div>
                    </li>
            </ul>
        </section>
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
            filterList(option) {
                if(option == 1) {
                    this.pets = this.originalList;
                    this.pets = this.pets.filter(pet => pet.gender.toLowerCase() == gender.toLowerCase());
                    this.filterType != null ? this.pets = this.pets.filter(pet => pet.type.toLowerCase() == this.filterType.toLowerCase()) : null;
                    this.filterState != null ? this.pets = this.pets.filter(pet => pet.state == this.filterState) : null;
                    this.filterCity != null ? this.pets = this.pets.filter(pet => pet.city == this.filterCity) : null;
                    return this.pets;
                }
                if(option == 2) {
                    this.pets = this.originalList;
                    this.pets = this.pets.filter(pet => pet.type.toLowerCase() == type.toLowerCase());
                    this.filterGender != null ? this.pets = this.pets.filter(pet => pet.gender.toLowerCase() == this.filterGender.toLowerCase()) : null;
                    this.filterState != null ? this.pets = this.pets.filter(pet => pet.state == this.filterState) : null;
                    this.filterCity != null ? this.pets = this.pets.filter(pet => pet.city == this.filterCity) : null;
                    return this.pets;
                }
                if(option == 3) {
                    this.locations.forEach(temp => {
                        if (temp.state == state) {
                            this.cities = temp.area;
                        }
                    });
                    this.pets = this.originalList;
                    this.pets = this.pets.filter(pet => pet.state == state);
                    this.filterGender != null ? this.pets = this.pets.filter(pet => pet.gender.toLowerCase() == this.filterGender.toLowerCase()) : null;
                    this.filterType != null ? this.pets = this.pets.filter(pet => pet.type.toLowerCase() == this.filterType.toLowerCase()) : null;
                    this.filterCity != null ? this.pets = this.pets.filter(pet => pet.city == this.filterCity) : null;
                    return this.pets;
                }
                if(option == 4) {
                    this.pets = this.originalList;
                    this.pets = this.pets.filter(pet => pet.city == city);
                    this.filterGender != null ? this.pets = this.pets.filter(pet => pet.gender.toLowerCase() == this.filterGender.toLowerCase()) : null;
                    this.filterType != null ? this.pets = this.pets.filter(pet => pet.type.toLowerCase() == this.filterType.toLowerCase()) : null;
                    this.filterState != null ? this.pets = this.pets.filter(pet => pet.state == this.filterState) : null;
                    return this.pets;
                }
                return this.originalList;
            },
            setGender(gender) {
                this.pets = this.originalList;
                this.pets = this.pets.filter(pet => pet.gender.toLowerCase() == gender.toLowerCase());
                this.filterType != null ? this.pets = this.pets.filter(pet => pet.type.toLowerCase() == this.filterType.toLowerCase()) : null;
                this.filterState != null ? this.pets = this.pets.filter(pet => pet.state == this.filterState) : null;
                this.filterCity != null ? this.pets = this.pets.filter(pet => pet.city == this.filterCity) : null;
            },
            setType(type) {
                this.pets = this.originalList;
                this.pets = this.pets.filter(pet => pet.type.toLowerCase() == type.toLowerCase());
                this.filterGender != null ? this.pets = this.pets.filter(pet => pet.gender.toLowerCase() == this.filterGender.toLowerCase()) : null;
                this.filterState != null ? this.pets = this.pets.filter(pet => pet.state == this.filterState) : null;
                this.filterCity != null ? this.pets = this.pets.filter(pet => pet.city == this.filterCity) : null;
            },
            setState(state) {
                this.locations.forEach(temp => {
                    if (temp.state == state) {
                        this.cities = temp.area;
                    }
                });
                this.pets = this.originalList;
                this.pets = this.pets.filter(pet => pet.state == state);
                this.filterGender != null ? this.pets = this.pets.filter(pet => pet.gender.toLowerCase() == this.filterGender.toLowerCase()) : null;
                this.filterType != null ? this.pets = this.pets.filter(pet => pet.type.toLowerCase() == this.filterType.toLowerCase()) : null;
                this.filterCity != null ? this.pets = this.pets.filter(pet => pet.city == this.filterCity) : null;
            },
            setCity(city) {
                this.pets = this.originalList;
                this.pets = this.pets.filter(pet => pet.city == city);
                this.filterGender != null ? this.pets = this.pets.filter(pet => pet.gender.toLowerCase() == this.filterGender.toLowerCase()) : null;
                this.filterType != null ? this.pets = this.pets.filter(pet => pet.type.toLowerCase() == this.filterType.toLowerCase()) : null;
                this.filterState != null ? this.pets = this.pets.filter(pet => pet.state == this.filterState) : null;
            },
            getUrl(url) {
                axios.get("http://127.0.0.1:8000/url", {
                    params : {
                        url : url
                    }
                }).then((response) => { 
                    this.hello = response.data
                });
                return this.hello;
            }
        },

        mounted() {
            
        }
    }
</script>
