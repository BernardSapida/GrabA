<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <main>
        <section class="vh-100">
            <div class="container py-5">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col col-xl-10">
                        <div class="row">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="images/GRABA_LOGO.png" alt="signup form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 100%;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div id="app" class="card-body p-4 p-lg-5 text-black">
                                    <b-form novalidate @submit.prevent="submitSignupForm">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0">Grab.A</span>
                                        </div>
                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Create your account</h5>
                                        <div class="row">
                                            <b-form-group
                                                class="col-md-6 col-sm-12 mb-3"
                                                label="Firstname"
                                                label-for="firstname"
                                                :state="state_firstname"
                                            >
                                                <b-form-input id="firstname" v-model="firstname" :state="state_firstname" placeholder="Firstname" trim></b-form-input>
                                                <b-form-invalid-feedback>{{ err_firstname }}</b-form-invalid-feedback>
                                            </b-form-group>
                                            <b-form-group
                                                class="col-md-6 col-sm-12 mb-3"
                                                label="Lastname"
                                                label-for="lastname"
                                                :state="state_lastname"
                                            >
                                                <b-form-input id="lastname" v-model="lastname" :state="state_lastname" placeholder="Lastname" trim></b-form-input>
                                                <b-form-invalid-feedback>{{ err_lastname }}</b-form-invalid-feedback>
                                            </b-form-group>
                                        </div>
                                        <div class="mb-3">
                                            <b-form-group
                                                label="Email address"
                                                label-for="email"
                                                :state="state_email"
                                            >
                                                <b-form-input id="email" v-model="email" :state="state_email" placeholder="Email" trim></b-form-input>
                                                <b-form-invalid-feedback>{{ err_email }}</b-form-invalid-feedback>
                                            </b-form-group>
                                        </div>
                                        <div class="mb-3">
                                            <b-form-group
                                                label="Job Position"
                                                label-for="jobPosition"
                                                :state="state_jobPosition"
                                            >
                                                <b-form-input id="jobPosition" v-model="jobPosition" :state="state_jobPosition" placeholder="Password" trim></b-form-input>
                                                <b-form-invalid-feedback>{{ err_jobPosition }}</b-form-invalid-feedback>
                                            </b-form-group>
                                        </div>
                                        <div class="row">
                                            <b-form-group
                                                class="col-md-6 col-sm-12 mb-4"
                                                label="Password"
                                                label-for="password"
                                                :state="state_password"
                                            >
                                                <b-form-input id="password" v-model="password" type="password" :state="state_password" placeholder="Password" trim></b-form-input>
                                                <b-form-invalid-feedback>{{ err_password }}</b-form-invalid-feedback>
                                            </b-form-group>

                                            <b-form-group
                                                class="col-md-6 col-sm-12 mb-4"
                                                label="Confirm password"
                                                label-for="password_confirmation"
                                                :state="state_password_confirmation"
                                            >
                                                <b-form-input id="password_confirmation" v-model="password_confirmation" type="password" :state="state_password_confirmation" placeholder="Confirm password" trim></b-form-input>
                                                <b-form-invalid-feedback>{{ err_password_confirmation }}</b-form-invalid-feedback>
                                            </b-form-group>
                                        </div>
                                        <div class="d-grid mb-3">
                                            <b-button type="submit" class="btn btn-dark">Create account</b-button>
                                        </div>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Do you have an account? <router-link :to="{name: 'signin'}">Signin here</router-link></p>
                                    </b-form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
    export default {
        data() {
            return {
                firstname: "Bernard",
                lastname: "Sapida",
                email: "bernard.sapida@cvsu.edu.ph",
                jobPosition: "Software Engineer",
                password: "@Oop1708131117",
                password_confirmation: "@Oop1708131117",

                state_firstname: null,
                state_lastname: null,
                state_email: null,
                state_jobPosition: null,
                state_password: null,
                state_password_confirmation: null,

                err_firstname: null,
                err_lastname: null,
                err_email: null,
                err_jobPosition: null,
                err_password: null,
                err_password_confirmation: null,
            }
        },
        methods: {
            onClearFields() {
                this.firstname = '';
                this.lastname = '';
                this.email = '';
                this.jobPosition = '';
                this.password = '';
                this.password_confirmation = '';
            },
            onClearErrors() {
                this.err_firstname = '';
                this.err_lastname = '';
                this.err_email = '';
                this.err_jobPosition = '';
                this.err_password = '';
                this.err_password_confirmation = '';

                this.state_firstname = null;
                this.state_lastname = null;
                this.state_email = null;
                this.state_jobPosition = null;
                this.state_password = null;
                this.state_password_confirmation = null;
            },
            submitSignupForm() {
                this.onClearErrors();
                this.$query('saveAccount', {
                    account: {
                        firstname: this.firstname,
                        lastname: this.lastname,
                        email: this.email,
                        jobPosition: this.jobPosition,
                        password: this.password,
                        password_confirmation: this.password_confirmation,
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
                                ? (errors[errors_keys.indexOf(index)].indexOf("account.password") != -1 ?
                                    errors[errors_keys.indexOf(index)].split("account.password").join("password") 
                                    : errors[errors_keys.indexOf(index)])
                                : '';

                            if(this[name]) this[state] = false;
                        };

                        error_message('err_firstname', 'account.firstname', 'state_firstname');
                        error_message('err_lastname', 'account.lastname', 'state_lastname');
                        error_message('err_email', 'account.email', 'state_email');
                        error_message('err_jobPosition', 'account.jobPosition', 'state_jobPosition');
                        error_message('err_password', 'account.password', 'state_password');
                        error_message('err_password_confirmation', 'account.password_confirmation', 'state_password_confirmation');
                    } else {
                        let response = res.data.data.saveAccount;
                        if (response.error) {
                            this.$swal({
                                title: 'Error',
                                text: response.message,
                                icon: 'error'
                            });
                        } else {
                            this.$emit('success');
                            this.onClearFields();
                            this.onClearErrors();
                            this.$swal({
                                title: 'Success',
                                text: response.message,
                                icon: 'success'
                            }).then(() => window.location.href = 'http://www.graba.test/');
                        }
                    }
                });
            }
        }
    }
</script>
