<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div id="app">
        <Navigation />
        <section class="container my-5" style="min-height: 650px;">
            <div class="d-flex justify-content-between align-items-center px-3" style="flex-wrap: wrap; gap: 15px;">
                <p class="m-0 p-0" style="font-size: 24px">Project Name: <strong>{{ projectName }}</strong></p>
                <b-row class="d-flex align-items-center justify-content-between" style="gap: 10px;">
                    <b-col class="m-0 p-0" style="width: 130px;">
                        <router-link class="btn btn-dark m-0" style="width: 135px;" :to="{name: 'projects'}"><b-icon icon="arrow-right"></b-icon> Go to Projects</router-link>
                    </b-col>
                    <b-col class="m-0 p-0" style="width: 180px;">
                        <router-link class="btn btn-dark m-0" style="width: 165px;" :to="{name: 'dashboard', params: { id: paramId }}"><b-icon icon="arrow-right"></b-icon> Go to Dashboard</router-link>
                    </b-col>
                </b-row>
            </div>
            <hr>
            <div class="d-flex justify-content-between align-items-center px-3" style="flex-wrap: wrap; gap: 15px;">
                <div style="width: 100%; max-width: 250px;">
                    <p class="m-0 text-muted"><strong>MATERIAL COST ATM</strong></p>
                    <p class="fs-3 m-0"><strong>Php {{ formatToMoney(computed_cost) }}</strong></p>
                </div>
                <div style="width: 100%; min-width: 250px; max-width: 350px;">
                    <p class="text-primary text-end m-0" :class="{ 'text-danger': costProgress > 100, 'text-primary': costProgress <= 100 }">Out of <strong>Php {{ formatToMoney(capitalBudget) }}</strong></p>
                    <b-progress v-if="computed_cost <= capitalBudget" variant="primary" :value="computed_cost" :max="capitalBudget"></b-progress>
                    <b-progress v-else variant="danger" :value="computed_cost" :max="capitalBudget"></b-progress>
                    <p>Progress: <strong :class="{ 'text-danger': costProgress > 100, 'text-primary': costProgress <= 100 }">{{ costProgress > 100 ? costProgress + " %" : costProgress + " %"}}</strong></p>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <b-table striped responsive hover :items="items" :fields="fields"></b-table>
            </div>
        </section>
        <Footer />
    </div>
</template>

<script>
    import Navigation from './Navigation';
    import Footer from './Footer';

    export default {
        components: {
            Navigation,
            Footer
        },
        data() {
            return {
                projectName: '',
                capitalBudget: 0,
                fields: [
                    {
                        key: 'name',
                        sortable: true
                    },
                    {
                        key: 'quantity',
                        sortable: true
                    },
                    {
                        key: 'unit',
                        sortable: true
                    },
                    {
                        key: 'cost',
                        sortable: true,
                    }
                ],
                items: []
            }
        },
        computed: {
            computed_cost() {
                let materialCost = 0;
                this.items.forEach(item => materialCost += item.cost);
                return materialCost;
            },
            costProgress() {
                let materialCost = 0;
                this.items.forEach(item => materialCost += item.cost);
                return Math.floor(materialCost/this.capitalBudget*100);
            }
        },
        created() {
            this.paramId = this.$route.params.id.toString();
            this.onCreated();
        },
        methods: {
            formatToMoney(n) {
                return n.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            },
            onCreated() {
                this.$query('getPosts', {
                    postId: this.paramId
                }).then((res) => {
                    let postObj;

                    if(res.data.errors != null) return this.$router.push({ name: '404'});

                    postObj = res.data.data.getPosts.map((value) => {
                        let parsedMaterialArr = JSON.parse(value.materials);
                        value.materials = [];

                        parsedMaterialArr.forEach(materials => {
                            let tempObj = {};
                            for(const key in materials) {
                                let underscoreIndex = key.indexOf("_");
                                tempObj[key.slice(0, underscoreIndex)] = materials[key];
                            }

                            value.materials.push(tempObj);
                        })

                        return value;
                    });

                    this.setTableValues(postObj);
                });

                this.getProjects();
            },
            setTableValues(object){
                let cacheObj = {};


                object.filter(post => {
                    let materialsArr = post.materials;

                    for(let index in materialsArr) {
                        let materialObj = materialsArr[index];
                        let itemName = Object.keys(materialObj)[0];

                        if(Object.prototype.hasOwnProperty.call(cacheObj, materialObj[itemName])) {
                            cacheObj[materialObj[itemName]]['quantity'] += +materialObj['quantity'];
                            cacheObj[materialObj[itemName]]['cost'] += (+materialObj['amount']);
                        } else {
                            cacheObj[materialObj[itemName]] = {
                                'name': materialObj[itemName],
                                'unit': materialObj['unit'],
                                'cost': +materialObj['amount'],
                                'quantity': +materialObj['quantity']
                            };
                        }
                    }
                })

                this.items = Object.values(cacheObj);
            },
            getProjects() {
                this.$query('getProjects').then((res) => {
                    this.projects = res.data.data.getProjects;

                    this.projects.filter(projectObj => {
                        if(projectObj['id'] == this.paramId) {
                            this.projectName = projectObj['name'];
                            this.capitalBudget = Number(projectObj['total_cost']);
                        }
                    }) 
                });
            }
        }
    }
</script>
