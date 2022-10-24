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
                    <b-button router-link variant="dark" :to="{name: 'analytics', params: { id: paramId }}">Go to analytics</b-button>
                </div>
            </div>
            <div id="container_posts">
                <div v-for="post in posts" :key="post.id" class="mb-5">
                    <hr class="mb-4">
                    <div class="d-flex mb-3 justify-content-between">
                        <div class="d-flex">
                            <div class="mr-3">
                                <img src="/images/default.jpg" class="rounded-circle" alt="User profile" height="70" width="70">
                            </div>
                            <div class="ms-3">
                                <p class="m-0"><strong>{{ post.username }}</strong></p>
                                <p class="m-0"><strong>Site Engineer</strong></p>
                                <p class="m-0 text-muted">{{ post.created_at }}</p>
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
                            <b-table striped responsive hover :items="post.materials" :fields="fields"></b-table>
                        </div>
                    </div>
                    <p><strong>Purpose: </strong>{{ post.purpose }}</p>
                    <p><strong>Name: </strong>{{ post.fullname }}</p>
                    <p><strong>Address: </strong>{{ post.address }}</p>
                    <p><strong>Contact No.: </strong>{{ post.contact }}</p>
                    {{ post.image }}
                    <b-carousel
                        id="carousel-fade"
                        style="text-shadow: 0px 0px 2px #000"
                        fade
                        indicators
                        img-width="1024"
                        img-height="480"
                    >
                        <b-carousel-slide
                            v-for="image, index in post.images" :key="index"
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
            }
        },
        created() {
            this.paramId = this.$route.params.id;
            this.onCreated();
        },
        methods: {
            onCreated() {
                this.$query('getPosts', {
                    postId: this.paramId
                }).then((res) => {
                    if(res.data.errors != null) return this.$router.push({ name: '404'});

                    console.log(res.data.data.getPosts)

                    this.posts = res.data.data.getPosts.map((value) => {
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
                });
            },
        }
    }
</script>