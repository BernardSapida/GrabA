<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div class="dashboard_container">
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
                            v-model="table_options.filter"
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
                <b-table 
                    id="project"
                    :items="posts"
                    :filter="table_options.filter"
                    :sort-by.sync="table_options.sortBy"
                    :sort-desc.sync="table_options.sortDesc"
                    :busy="table_options.isBusy"
                    :per-page="table_options.perPage"
                    :current-page="table_options.currentPage"
                    :fields="table_options.fields"
                    responsive
                    striped
                    show-empty
                    @filtered="onFiltered">
                    <!-- <template #cell(image)="row"> 
                        <div class="mr-3">
                            <img src="/images/default.jpg" class="rounded-circle" alt="User profile" height="70" width="70">
                        </div>
                    </template> -->
                    <template #cell(name)="row">
                        {{ row.item.fullname }}
                    </template>
                    <template #cell(position)="row">
                        {{ row.item.position }}
                    </template>
                    <template #cell(purpose)="row">
                        {{ row.item.purpose }}
                    </template>
                    <template #cell(name_of_hardware)="row">
                        {{ row.item.hardware }}
                    </template>
                    <template #cell(address)="row">
                        {{ row.item.address }}
                    </template>
                    <template #cell(contact)="row">
                        {{ row.item.contact }}
                    </template>
                    <template #cell(show_details)="row">
                        <b-button size="sm" class="mr-2" @click="row.toggleDetails"> Show</b-button>
                    </template>
                    <template #row-details="row">
                        <b-card>
                            <b-row class="mb-2">
                                <b-col sm="3"><b>Items:</b></b-col>
                                <div class="table-responsive mb-3">
                                    <div class="table-responsive">
                                        <b-table striped responsive hover :items="row.item.materials" :fields="fields"></b-table>
                                    </div>
                                </div>
                            </b-row>
                            <b-row class="mb-2">
                                <b-col sm="3"><b>Images:</b></b-col>
                                <b-carousel
                                    id="carousel-fade"
                                    style="text-shadow: 0px 0px 2px #000"
                                    fade
                                    indicators
                                    img-width="1024"
                                    img-height="480"
                                >
                                    <b-carousel-slide
                                        :img-src=row.item.imageName
                                    ></b-carousel-slide>
                                </b-carousel>
                            </b-row>
                            <b-button size="sm" @click="row.toggleDetails">Hide Details</b-button>
                        </b-card>
                    </template>
                </b-table>
            </div>
            <b-col>
                <h6>
                    {{
                        showEntries(
                            table_options.perPage,
                            table_options.currentPage,
                            table_options.perPage,
                            table_options.rows,
                        )
                    }}
                </h6>
            </b-col>
            <b-col class="my-1">
                <b-pagination
                    v-model="table_options.currentPage"
                    :total-rows="table_options.rows"
                    :per-page="table_options.perPage"
                    align="right"
                    size="sm"
                    class="yr-table-paginate"
                    aria-controls="area"
                >
                </b-pagination>
            </b-col>
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
                fields: [],
                table_options: {
                    isBusy: true,
                    sortBy: 'title',
                    sortDesc: false,
                    selected: '',
                    show: false,
                    pageOptions: [5, 10, 20, 50],
                    fields: [
                        { key: 'name', sortable: true },
                        { key: 'position', sortable: true },
                        { key: 'purpose', sortable: true },
                        { key: 'name_of_hardware', sortable: true },
                        { key: 'address', sortable: true },
                        { key: 'contact', sortable: true },
                        { key: 'show_details', sortable: true }
                    ],
                    filter: null,
                    rows: 1,
                    currentPage: 1,
                    perPage: 10,
                },
                
                posts: [],
            }
        },
        computed: {
            rows() {
                return this.posts.length;
            },
        },
        created() {
            this.paramId = this.$route.params.id.toString();
            this.onCreated();
        },
        methods: {
            onCreated() {
                this.$query('getPosts', {
                    postId: this.paramId
                }).then((res) => {
                    if(res.data.errors != null) return this.$router.push({ name: '404'});

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
                    this.table_options.rows = this.posts.length;
                });
            },
            onFiltered(filteredItems) {
                this.table_options.rows = filteredItems.length;

                this.showEntries(
                    this.table_options.perPage,
                    this.table_options.currentPage,
                    this.table_options.perPage,
                    filteredItems.length,
                );
            },
        }
    }
</script>

<style scoped>
    div.dashboard_container {
        width: 100%;
        overflow-x: hidden;
    }

    div section.container {
        position: relative;
    }

    div section.container #btn-newPost {
        position: fixed;
        right: 40px;
        bottom: 40px;
        z-index: 2;
    }
</style>