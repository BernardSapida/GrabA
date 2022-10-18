<template>
    <div id="app">
        <Navigation />
        <section class="container my-5">
            <!-- Button for add project modal -->
            <div class="row justify-content-between">
                <div class="col-auto">
                    <h2 class="mb-2">Projects</h2>
                </div>
                <div class="col-auto">
                    <b-button class="btn" variant="primary" size="sm" @click="$bvModal.show('add-projectModal')">Add new project</b-button>
                </div>
            </div>

            <!-- Add project modal -->
            <b-modal id="add-projectModal" title="Project Registration" hide-footer>
                <b-form @submit.prevent="submitProjectForm" method="POST">
                    <b-form-group
                        class="mb-3"
                        label="Project Name"
                        label-for="add_projectName"
                        :state="state_projectName"
                    >
                        <b-form-input id="add_projectName" v-model="projectName" :state="state_projectName" trim></b-form-input>
                        <b-form-invalid-feedback>{{ err_projectName }}</b-form-invalid-feedback>
                    </b-form-group>

                    <b-form-group
                        class="mb-3"
                        label="Site location"
                        label-for="add_siteLocation"
                        :state="state_siteLocation"
                    >
                        <b-form-input id="add_siteLocation" v-model="siteLocation" :state="state_siteLocation" trim></b-form-input>
                        <b-form-invalid-feedback>{{ err_siteLocation }}</b-form-invalid-feedback>
                    </b-form-group>

                    <b-form-group
                        class="mb-3"
                        label="Total Material Cost"
                        label-for="add_materialCost"
                        :state="state_materialCost"
                    >
                        <b-form-input id="add_materialCost" v-model="materialCost" :state="state_materialCost" trim></b-form-input>
                        <b-form-invalid-feedback>{{ err_materialCost }}</b-form-invalid-feedback>
                    </b-form-group>
                    <hr>
                    <div class="d-grid pt-1 mb-3">
                        <b-button type="submit" class="mb-2" variant="primary" size="sm">Add project</b-button>
                        <b-button type="button" variant="outline-dark" size="sm" @click="hideModal('add-projectModal')">Close</b-button>
                    </div>
                </b-form>
            </b-modal>
            <hr>

            <!-- Table Search -->
            <b-form-group
                label="Search project"
                label-for="filter-input"
                label-cols-sm="3"
                label-align-sm="right"
                label-size="sm"
                class="mb-3"
            >
                  <b-input-group size="sm">
                        <b-form-input
                        id="filter-input"
                        v-model="filter"
                        type="search"
                        placeholder="Type to Search"
                        ></b-form-input>
                  </b-input-group>
            </b-form-group>

            <!-- Project Table -->
            <b-table
                :items="items" 
                :fields="fields"
                :filter="filter"
                show-empty
                striped 
                responsive 
                hover
            >
                <template #cell(views)="row">
                    <b-button router-link class="mr-1 my-1" variant="primary" size="sm" :to="{name: 'dashboard', params: { id: row.index }}">View Dashboard</b-button>
                    <b-button router-link class="mr-1 my-1" variant="success" size="sm" :to="{name: 'analytics', params: { id: row.index }}">View Analytics</b-button>
                </template>
                <template #cell(actions)="row">
                    <b-button class="mr-1 my-1" variant="dark" size="sm" v-b-modal.edit-projectModal @click="info(row.item, row.index, $event.target)">Edit</b-button>
                    <b-button class="mr-1 my-1" variant="danger" size="sm"  @click="info(row.item, row.index, $event.target)">Delete</b-button>
                </template>
            </b-table>

            <!-- edit project modal -->
            <b-modal id="edit-projectModal" title="Edit Project" hide-footer>
                <b-form @submit.prevent="submitProjectForm" method="POST">
                    <b-form-group
                        class="mb-3"
                        label="Project Name"
                        label-for="edit_projectName"
                        :state="state_projectName"
                    >
                        <b-form-input id="edit_projectName" v-model="projectName" :state="state_projectName" trim></b-form-input>
                        <b-form-invalid-feedback>{{ err_projectName }}</b-form-invalid-feedback>
                    </b-form-group>

                    <b-form-group
                        class="mb-3"
                        label="Site location"
                        label-for="edit_siteLocation"
                        :state="state_siteLocation"
                    >
                        <b-form-input id="edit_siteLocation" v-model="siteLocation" :state="state_siteLocation" trim></b-form-input>
                        <b-form-invalid-feedback>{{ err_siteLocation }}</b-form-invalid-feedback>
                    </b-form-group>

                    <b-form-group
                        class="mb-3"
                        label="Total Material Cost"
                        label-for="edit_materialCost"
                        :state="state_materialCost"
                    >
                        <b-form-input id="edit_materialCost" v-model="materialCost" :state="state_materialCost" trim></b-form-input>
                        <b-form-invalid-feedback>{{ err_materialCost }}</b-form-invalid-feedback>
                    </b-form-group>
                    <hr>
                    <div class="d-grid pt-1 mb-3">
                        <b-button type="submit" class="mb-2" variant="primary" size="sm">Save changes</b-button>
                        <b-button type="button" variant="outline-dark" size="sm" @click="hideModal('edit-projectModal')">Close</b-button>
                    </div>
                </b-form>
            </b-modal>
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
                // Form state
                projectName: "",
                siteLocation: "",
                materialCost: "",

                state_projectName: null,
                state_siteLocation: null,
                state_materialCost: null,
                
                err_projectName: null,
                err_siteLocation: null,
                err_materialCost: null,
                
                // Table state
                filter: null,
                fields: [
                    {
                        key: 'project_name',
                        sortable: true
                    },
                    {
                        key: 'site_location',
                        sortable: true
                    },
                    {
                        key: 'material_cost',
                        sortable: true,
                    },
                    {
                        key: 'views',
                        label: 'Views'
                    },
                    {
                        key: 'actions',
                        label: 'Actions'
                    }
                ],
                items: [
                    {
                        project_name: "Project A",
                        site_location: "Indang, Cavite",
                        material_cost: 1_000_000,
                    },
                    {
                        project_name: "Project B",
                        site_location: "Indang, Cavite",
                        material_cost: 1_000_000,
                    },
                    {
                        project_name: "Project C",
                        site_location: "Indang, Cavite",
                        material_cost: 1_000_000,
                    },
                    {
                        project_name: "Project D",
                        site_location: "Indang, Cavite",
                        material_cost: 1_000_000,
                    },
                ]
            }
        },
        methods: {
            hideModal(modalID) {
                this.clearState();
                this.$bvModal.hide(modalID);
            },
            submitProjectForm() {
                this.validateFormInputs();
            },
            validateFormInputs() {
                // Send API request to validate form inputs
                const result = {
                    projectName: "Project name is required",
                    siteLocation: "Site location is required",
                    materialCost: "Material cost is required",
                }

                // Looping through the object keys and passing the key and value to the updateStates
                Object.keys(result).forEach(key => this.updateStates(key, result[key]));
            },
            // A function that updates the state of the form inputs and the error message.
            updateStates(key, response) {
                if(response == "valid") eval(`this.state_${key} = true`);
                else {
                    eval(`this.state_${key} = false`);
                    eval(`this.err_${key} = '${response}'`);
                }
            },
            clearState() {
                // Reset form state
                this.projectName = "";
                this.siteLocation = "";
                this.materialCost = "";

                // Reset form input state
                this.state_projectName = null;
                this.state_siteLocation = null;
                this.state_materialCost = null;

                // Reset error form input state
                this.err_projectName = null;
                this.err_siteLocation = null;
                this.err_materialCost = null;
            }
        }
    }
</script>
