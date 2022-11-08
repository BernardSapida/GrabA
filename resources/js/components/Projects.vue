<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div>
        <Navigation />
        <section class="container my-5">
            <!-- Button for add project modal -->
            <div class="row justify-content-between">
                <div class="col-auto">
                    <h2 class="mb-2">Projects</h2>
                </div>
                <div class="col-auto">
                    <b-button 
                        v-b-modal.modal-sm="'add-project'" 
                        class="btn" 
                        variant="primary" 
                        size="sm" >
                        Add New Project
                    </b-button>
                </div>
            </div>

            <hr>

            <!-- Table Search -->
            <b-form-group
                label="Search Project"
                label-for="filter-input"
                label-align-sm="left"
                label-size="sm"
                class="mb-3"
            >
                  <b-input-group size="sm">
                        <b-form-input
                        id="filter-input"
                        v-model="table_options.filter"
                        type="search"
                        placeholder="Type to Search"
                        ></b-form-input>
                  </b-input-group>
            </b-form-group>
            <!-- Project Table -->
            <p>List of Projects</p>
            <b-table
                id="project"
                responsive
                hover
                :items="projects"
                :filter="table_options.filter"
                :fields="table_options.fields"
                :sort-by.sync="table_options.sortBy"
                :sort-desc.sync="table_options.sortDesc"
                :busy="table_options.isBusy"
                :per-page="table_options.perPage"
                :current-page="table_options.currentPage"
                striped
                show-empty
                @filtered="onFiltered">
                 <template #cell(person_in_charge)="row">
                        {{ row.item.fullname }}
                    </template>
                <template #cell(views)="row">
                    <b-button router-link class="mr-1 my-1" href="javascript:void(0);" variant="primary" size="sm" :to="{name: 'dashboard', params: { id: row.item.id }}">View Dashboard</b-button>
                    <b-button router-link class="mr-1 my-1" href="javascript:void(0);" variant="success" size="sm" :to="{name: 'analytics', params: { id: row.item.id }}">View Analytics</b-button>
                </template>
                <template #cell(actions)="row">
                    <b-button v-b-modal.modal-sm="'edit-project'" class="mr-1 my-1" variant="dark" size="sm" @click.prevent="onEditProject(row.item)">Edit</b-button>
                    <b-button class="mr-1 my-1" variant="danger" size="sm"  @click="onDeleteProject(row.item.id)">Delete</b-button>
                </template>
            </b-table>
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
        <AddProject @success="onSuccess"/>
        <EditProject :project="project" @success="onSuccess"/>
    </div>
</template>

<script>
    import Navigation from './Navigation';
    import AddProject from './Projects/AddProject';
    import EditProject from './Projects/EditProject';

    export default {
        components: {
            Navigation,
            AddProject,
            EditProject
        },
        data() {
            return {
                table_options: {
                    isBusy: true,
                    sortBy: 'title',
                    sortDesc: false,
                    selected: '',
                    show: false,
                    pageOptions: [5, 10, 20, 50],
                    fields: [
                        { key: 'name', sortable: true },
                        { key: 'location', sortable: true },
                        { key: 'person_in_charge', sortable: true },
                        { key: 'position', sortable: true },
                        { key: 'views' },
                        { key: 'actions' },
                    ],
                    filter: null,
                    rows: 1,
                    currentPage: 1,
                    perPage: 10,
                },
                projects: [],
                project: []
            };
        },
        computed: {
            rows() {
                return this.projects.length;
            },
        },
        created() {
            this.onCreated();
        },
        methods: {
            onCreated() {
                this.$query('getProjects').then((res) => {
                    this.table_options.isBusy = false;
                    this.projects = res.data.data.getProjects;
                    console.log(this.projects)
                    this.table_options.rows = this.projects.length;
                });
            },
            onSuccess() {
                this.onCreated();
            },
            onEditProject(data) {
                this.project = data;
            },
            onDeleteProject(id) {
                this.$swal({
                    title: 'Are you sure?',
                    text: 'You want to delete this record?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                }).then((res) => {
                    if (res.isConfirmed) {
                        this.$query('getProjects', {
                            projectId: id.toString(),
                        }).then(() => {
                            this.$swal({
                                title: 'Success',
                                text: 'Project has been deleted',
                                icon: 'success'
                            });

                            this.onCreated();
                        });
                    }
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
        },
    }
</script>
