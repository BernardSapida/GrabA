<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div id="app">
        <Navigation />
        <section class="container my-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h2>Analytics</h2>
                    <p>Project name: Project A</p>
                </div>
                <div>
                    <router-link class="btn btn-dark" :to="{name: 'dashboard', params: { id: 1 }}">Go to dashboard</router-link>
                </div>
            </div>
            <hr>
            <div class="row justify-content-between">
                <div class="col-6">
                    <p class="m-0 text-muted"><strong>MATERIAL COST ATM</strong></p>
                    <p class="fs-3 m-0"><strong>Php {{ formatToMoney(computed_cost) }}</strong></p>
                </div>
                <div class="col-4">
                    <p class="text-primary text-end">Out of <strong>Php {{ formatToMoney(capital_budget) }}</strong></p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-label="Example 20px high" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <b-table striped responsive hover :items="items" :fields="fields"></b-table>
            </div>
        </section>
    </div>
</template>

<script>
    import Navigation from './Navigation';

    export default {
        components: {
            Navigation
        },
        data() {
            return {
                capital_budget: 7056000,
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
                        key: 'cost',
                        sortable: true,
                    }
                ],
                items: [
                    {
                        name: "Sand",
                        quantity: "70 M3",
                        cost: 26000,
                    },
                    {
                        name: "Cement",
                        quantity: "100 BAGS",
                        cost: 24000,
                    },
                    {
                        name: "Gravel",
                        quantity: "60 M3",
                        cost: 20000,
                    },
                    {
                        name: "10MM Stell Bars",
                        quantity: "2 PCS",
                        cost: 560,
                    },
                ]
            }
        },
        computed: {
            computed_cost() {
                let totalCost = 0;
                this.items.forEach(item => totalCost += item.cost);
                return totalCost;
            }
        },
        methods: {
            formatToMoney(n) {
                return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        }
    }
</script>
