<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div>
        <Navigation />
        <section class="container my-5">
            <b-button id="btn-newPost" class="rounded-circle" router-link :to="{name: 'post'}" variant="primary">+</b-button>
            <div class="row justify-content-between g-2">
                <div class="col-auto">
                    <b-form-group
                        label-for="filter-input"
                        label-align-sm="right"
                        label-size="sm"
                        class="mb-3"
                    >
                        <b-input-group size="sm">
                            <b-form-input
                            id="filter-input"
                            v-model="filter"
                            type="search"
                            placeholder="Search post"
                            ></b-form-input>
                        </b-input-group>
                    </b-form-group>
                </div>
                <div class="col-auto">
                    <b-button router-link variant="dark" :to="{name: 'analytics', params: { id: 1 }}">Go to analytics</b-button>
                </div>
            </div>
            <div id="container_posts">
                <div v-for="item in items" :key="item.id" class="mb-5">
                    <hr class="mb-4">
                    <div class="d-flex mb-3 justify-content-between">
                        <div class="d-flex">
                            <div class="mr-3">
                                <img src="/images/default.jpg" class="rounded-circle" alt="User profile" height="70" width="70">
                            </div>
                            <div class="ms-3">
                                <p class="m-0"><strong>{{ item.username }}</strong></p>
                                <p class="m-0"><strong>{{ item.jobPosition }}</strong></p>
                                <p class="m-0 text-muted">{{ item.date }}</p>
                            </div>
                        </div>
                        <div>
                            <b-dropdown id="dropdown-right" right text="•••" variant="none" class="m-2">
                                <b-dropdown-item href="#">Edit</b-dropdown-item>
                                <b-dropdown-item href="#">Delete post</b-dropdown-item>
                            </b-dropdown>
                        </div>
                    </div>
                    <div class="table-responsive mb-3">
                        <div class="table-responsive">
                            <b-table striped responsive hover :items="item.table" :fields="fields"></b-table>
                        </div>
                    </div>
                    <p><strong>Purpose: </strong>{{ item.purpose }}</p>
                    <p><strong>Hardware: </strong></p>
                    <p><strong>Name: </strong>{{ item.name }}</p>
                    <p><strong>Address: </strong>{{ item.address }}</p>
                    <p><strong>Contact No.: </strong>{{ item.contact }}</p>
                    {{ item.image }}
                    <b-carousel
                        id="carousel-fade"
                        style="text-shadow: 0px 0px 2px #000"
                        fade
                        indicators
                        img-width="1024"
                        img-height="480"
                    >
                        <b-carousel-slide
                            v-for="image, index in item.images" :key="index"
                            :img-src=image
                        ></b-carousel-slide>
                    </b-carousel>
                </div>
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
                filter: null,
                fields: [
                    {
                        key: 'item',
                        sortable: true,
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
                        key: 'unitCost',
                        sortable: true,
                    },
                    {
                        key: 'amount',
                        sortable: true,
                    }
                ],
                posts: [],
                items: [
                    {
                        id: '0',
                        username: 'Nickerson Torres',
                        jobPosition: 'Site Engineer',
                        date: 'October 01, 2022',
                        table: [
                            {
                                item: 'Item 2',
                                quantity: '0',
                                unit: '0',
                                unitCost: '0',
                                amount: '0',
                            },
                            {
                                item: 'Item 3',
                                quantity: '0',
                                unit: '0',
                                unitCost: '0',
                                amount: '0',
                            },
                            {
                                item: 'Item 4',
                                quantity: '0',
                                unit: '0',
                                unitCost: '0',
                                amount: '0',
                            },
                            {
                                item: 'Item 5',
                                quantity: '0',
                                unit: '0',
                                unitCost: '0',
                                amount: '0',
                            },
                            {
                                item: 'Item 6',
                                quantity: '0',
                                unit: '0',
                                unitCost: '0',
                                amount: '0',
                            }
                        ],
                        purpose: "Construction of footing 1 and 2",
                        name: "Jen Hardware",
                        address: "001 Indang, Cavite",
                        contact: '09129461876',
                        images: [
                            'https://picsum.photos/1024/480/?image=1',
                            'https://picsum.photos/1024/480/?image=2',
                            'https://picsum.photos/1024/480/?image=3',
                        ]
                    },
                    {
                        id: 1,
                        username: 'Nickerson Torres',
                        jobPosition: 'Site Engineer',
                        date: 'October 01, 2022',
                        table: [
                            {
                                item: 'Item 1',
                                quantity: 1,
                                unit: 1,
                                unitCost: 1,
                                amount: 1,
                            },
                            {
                                item: 'Item 2',
                                quantity: 1,
                                unit: 1,
                                unitCost: 1,
                                amount: 1,
                            },
                            {
                                item: 'Item 3',
                                quantity: '0',
                                unit: '0',
                                unitCost: '0',
                                amount: '0',
                            },
                            {
                                item: 'Item 4',
                                quantity: '0',
                                unit: '0',
                                unitCost: '0',
                                amount: '0',
                            },
                            {
                                item: 'Item 5',
                                quantity: '0',
                                unit: '0',
                                unitCost: '0',
                                amount: '0',
                            },
                            {
                                item: 'Item 6',
                                quantity: '0',
                                unit: '0',
                                unitCost: '0',
                                amount: '0',
                            }
                        ],
                        purpose: "Construction of footing 3 and 4",
                        name: "Zo Hardware",
                        address: "001 Imus, Cavite",
                        contact: '09472126029',
                        images: [
                            'https://picsum.photos/1024/480/?image=4',
                            'https://picsum.photos/1024/480/?image=5',
                            'https://picsum.photos/1024/480/?image=6',
                        ]
                    }
                ]
            }
        },
        created() {
            this.onCreated();
        },
        methods: {
            onCreated() {
                this.$query('getPosts', {
                    postId: '2'
                }).then((res) => {
                    console.log(res.data.data.getPosts);
                });

                // this.$query('getPosts', {
                //     postId: 1,
                // }).then((res) => {
                //     this.posts = res.data.data.getPosts;
                //     console.log(this.posts)
                // });
            },
        }
    }
</script>