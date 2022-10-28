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
                                <b-form-group
                    class="mb-3"
                    label="Fullname"
                    label-for="edit_fullname"
                    :state="state_fullname"
                >
                    <b-form-input id="edit_fullname" v-model="fullname" :state="state_fullname" trim></b-form-input>
                    <b-form-invalid-feedback>{{ err_fullname }}</b-form-invalid-feedback>
                </b-form-group>
                <b-form-group
                    class="mb-3"
                    label="Position"
                    label-for="edit_position"
                    :state="state_position"
                >
                    <b-form-input id="edit_position" v-model="position" :state="state_position" trim></b-form-input>
                    <b-form-invalid-feedback>{{ err_position }}</b-form-invalid-feedback>
                </b-form-group>
                <hr>
                <div class="d-grid pt-1 mb-3">
                    <b-form-group>
                        <b-button
                            v-if="!isSaving"
                            variant="primary"
                            size="sm"
                            type="submit">
                        Edit project
                        </b-button>
                        <b-button
                            v-else
                            variant="primary"
                            size="sm"
                            disabled>
                            <b-spinner small type="grow"></b-spinner>
                        Editing
                        </b-button>
                    </b-form-group>
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
            fullname: "",
            position: "",

            state_projectName: null,
            state_siteLocation: null,
            state_materialCost: null,
            state_fullname: null,
            state_position: null,

            err_projectName: "",
            err_siteLocation: "",
            err_materialCost: "",
            err_fullname: "",
            err_position: "",

            isSaving: false,
            id: "",
        }
    },
    watch: {
        project(proj) {
            this.projectName = proj.name ? proj.name : '';
            this.siteLocation = proj.location ? proj.location : '';
            this.materialCost = proj.total_cost ? proj.total_cost : '';
            this.fullname = proj.fullname ? proj.fullname : '';
            this.position = proj.position ? proj.position : '';
            this.id = proj.id ? proj.id : '';
        }
    },
    methods: {
        onClearFields() {
            this.projectName = this.project.name ? this.project.name : '';
            this.siteLocation = this.project.location ? this.project.location : '';
            this.materialCost = this.project.total_cost ? this.project.total_cost : '';
            this.fullname = this.project.fullname ? this.project.fullname : '';
            this.position = this.project.position ? this.project.position : '';
        },
        onClearErrors() {
            this.err_projectName = '';
            this.state_projectName = null;
            this.err_siteLocation = '';
            this.state_siteLocation = null;
            this.err_materialCost = '';
            this.state_materialCost = null;
            this.err_fullname = '';
            this.state_fullname = null;
            this.err_position = '';
            this.state_position = null;
        },
        submitProjectForm() {
            this.isSaving = true;
            this.onClearErrors();
            this.$query('saveProject', {
                project: {
                    id: this.id.toString(),
                    projectName: this.projectName,
                    siteLocation: this.siteLocation,
                    materialCost: this.materialCost,
                    fullname: this.fullname,
                    position: this.position
                },
            }).then((res) => {
                this.isSaving = false;
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
                    error_message('err_fullname', 'project.fullname', 'state_fullname');
                    error_message('err_position', 'project.position', 'state_position');
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
    }
}
</script>
