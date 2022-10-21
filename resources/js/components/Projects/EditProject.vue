<template>
    <div>
         <b-modal id="edit-project" ref="edit-project" title="Project Registration" hide-footer centered @hidden="onResetModal" >
            <b-form @submit.prevent="submitProjectForm">
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
                    <b-button type="submit" class="mb-2" variant="primary" size="sm">Edits project</b-button>
                </div>
            </b-form>
        </b-modal>
    </div>
</template>

<script>

export default {
    props: ['project'],
    data() {
        return {
            projectName: "",
            siteLocation: "",
            materialCost: "",
            id: "",

            state_projectName: null,
            state_siteLocation: null,
            state_materialCost: null,
            
            err_projectName: "",
            err_siteLocation: "",
            err_materialCost: "",
        }
    },
    methods: {
        onClearFields() {
            this.projectName = this.project.name ? this.project.name : '';
            this.siteLocation = this.project.location ? this.project.location : '';
            this.materialCost = this.project.total_cost ? this.project.total_cost : '';
        },
        onClearErrors() {
            this.err_projectName = '';
            this.state_projectName = null;
            this.err_siteLocation = '';
            this.state_siteLocation = null;
            this.err_materialCost = '';
            this.state_materialCost = null;
        },
        submitProjectForm() {
            this.onClearErrors();
            this.$query('saveProject', {
                project: {
                    id: this.id.toString(),
                    projectName: this.projectName,
                    siteLocation: this.siteLocation,
                    materialCost: this.materialCost
                },
            }).then((res) => {
                this.is_saving = false;
                if (res.data.errors) {
                    let errors = Object.values(
                        res.data.errors[0].extensions.validation,
                    ).flat();
                    let errors_keys = Object.keys(
                        res.data.errors[0].extensions.validation,
                    ).flat();

                    const error_message = (name, index, state) => {
                        this[name] = errors_keys.some((q) => q == index)
                            ? errors[errors_keys.indexOf(index)]
                            : '';

                        if (this[name]) {
                            this[state] = false;
                        }
                    };
                    error_message('err_projectName', 'project.projectName', 'state_projectName');
                    error_message('err_siteLocation', 'project.siteLocation', 'state_siteLocation');
                    error_message('err_materialCost', 'project.materialCost', 'state_materialCost');
                } else {
                    let response = res.data.data.saveProject;
                    if (response.error) {
                        this.$swal({
                            title: 'Error',
                            text: response.message,
                            icon: 'error'
                        });
                    } else {
                        this.$emit('success');
                        this.$refs['edit-project'].hide();
                        this.onClearErrors();
                        this.$swal({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            customClass: {
                                popup: 'yr-modal-alert yr-modal-alert-success',
                                confirmButton:
                                    'yr-modal-btn-alert yr-modal-btn-alert-success',
                                title: 'yr-modal-header-alert yr-modal-header-alert-success',
                                htmlContainer: 'yr-modal-body-text',
                            },
                        });
                    }
                }
            });
        },
        onResetModal() {
            this.onClearFields();
            this.onClearErrors();
        },
    },
    watch: {
        project(proj) {
            this.projectName = proj.name ? proj.name : '';
            this.siteLocation = proj.location ? proj.location : '';
            this.materialCost = proj.total_cost ? proj.total_cost : '';
            this.id = proj.id ? proj.id : '';
        }
    },
}
</script>
