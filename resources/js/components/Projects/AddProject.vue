<template>
    <div>
         <b-modal id="add-project" ref="add-project" title="Project Registration" hide-footer centered @hidden="onResetModal" >
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
                    label-for="add_fullname"
                    :state="state_fullname"
                >
                    <b-form-input id="add_fullname" v-model="fullname" :state="state_fullname" trim></b-form-input>
                    <b-form-invalid-feedback>{{ err_fullname }}</b-form-invalid-feedback>
                </b-form-group>
                <b-form-group
                    class="mb-3"
                    label="Position"
                    label-for="add_position"
                    :state="state_position"
                >
                    <b-form-input id="add_position" v-model="position" :state="state_position" trim></b-form-input>
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
                        Add project
                        </b-button>
                        <b-button
                            v-else
                            variant="primary"
                            size="sm"
                            disabled>
                            <b-spinner small type="grow"></b-spinner>
                        Adding
                        </b-button>
                    </b-form-group>
                </div>
            </b-form>
        </b-modal>
    </div>
</template>

<script>

export default {
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
        }
    },
    methods: {
        onClearFields() {
            this.projectName = '';
            this.siteLocation = '';
            this.materialCost = '';
            this.position = '';
            this.fullname = '';
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
                    id: '0',
                    projectName: this.projectName,
                    siteLocation: this.siteLocation,
                    materialCost: this.materialCost,
                    fullname: this.fullname,
                    position: this.position,
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

                        if (this[name]) this[state] = false;
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
                        this.$refs['add-project'].hide();
                        this.onClearFields();
                        this.onClearErrors();
                        this.$swal({
                            title: 'Success',
                            text: response.message,
                            icon: 'success'
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
