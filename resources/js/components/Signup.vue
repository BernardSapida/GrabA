<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <main id="app">
        <section class="vh-100">
            <div class="container py-5">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col col-xl-10">
                        <div class="row">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="../../../public/images/GRABA_LOGO.png" alt="signup form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 100%;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div id="app" class="card-body p-4 p-lg-5 text-black">
                                    <b-form method="POST" class="needs-validation" novalidate @submit.prevent="submitForm" >
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
                                                <b-form-input id="firstname" v-model="firstname" :state="state_firstname" trim></b-form-input>
                                                <b-form-invalid-feedback>{{ err_firstname }}</b-form-invalid-feedback>
                                            </b-form-group>
                                            <b-form-group
                                                class="col-md-6 col-sm-12 mb-3"
                                                label="Lastname"
                                                label-for="lastname"
                                                :state="state_lastname"
                                            >
                                                <b-form-input id="lastname" v-model="lastname" :state="state_lastname" trim></b-form-input>
                                                <b-form-invalid-feedback>{{ err_lastname }}</b-form-invalid-feedback>
                                            </b-form-group>
                                        </div>
                                        <div class="mb-3">
                                            <b-form-group
                                                label="Email address"
                                                label-for="email"
                                                :state="state_email"
                                            >
                                                <b-form-input id="email" v-model="email" :state="state_email" trim></b-form-input>
                                                <b-form-invalid-feedback>{{ err_email }}</b-form-invalid-feedback>
                                            </b-form-group>
                                        </div>
                                        <div class="mb-3">
                                            <b-form-group
                                                label="Job Position"
                                                label-for="jobPosition"
                                                :state="state_jobPosition"
                                            >
                                                <b-form-input id="jobPosition" v-model="jobPosition" :state="state_jobPosition" trim></b-form-input>
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
                                                <b-form-input id="password" v-model="password" :state="state_password" trim></b-form-input>
                                                <b-form-invalid-feedback>{{ err_password }}</b-form-invalid-feedback>
                                            </b-form-group>

                                            <b-form-group
                                                class="col-md-6 col-sm-12 mb-4"
                                                label="Confirm password"
                                                label-for="confirmPassword"
                                                :state="state_confirmPassword"
                                            >
                                                <b-form-input id="confirmPassword" v-model="password" :state="state_confirmPassword" trim></b-form-input>
                                                <b-form-invalid-feedback>{{ err_confirmPassword }}</b-form-invalid-feedback>
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
                email: "",
                jobPosition: "",
                password: "",
                confirmPassword: "",

                state_firstname: null,
                state_lastname: null,
                state_email: null,
                state_jobPosition: null,
                state_password: null,
                state_confirmPassword: null,

                err_firstname: null,
                err_lastname: null,
                err_email: null,
                err_jobPosition: null,
                err_password: null,
                err_confirmPassword: null,
            }
        },
        methods: {
            submitForm() {
                this.validateFormInputs();
            },
            validateFormInputs() {
                // Send API request to validate form inputs
                const result = {
                    firstname: "valid",
                    lastname: "valid",
                    email: "Invalid email address",
                    jobPosition: "Job position is required",
                    password: "Password is required",
                    confirmPassword: "Confirm password is required",
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
            }
        }
    }
</script>
