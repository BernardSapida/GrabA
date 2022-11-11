<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <main>
        <section class="h-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col col-xl-10">
                        <div class="row">
                            <div class="col-md-6 col-lg-5 d-none d-md-flex align-items-center">
                                <img src="images/GRABA_LOGO.png" alt="signup form" style="display: block; width: 100%; height: 300px;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div id="app" class="card-body p-4 p-lg-5 text-black">
                                    <b-form novalidate @submit.prevent="submitSignupForm">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <img src="images/GRABA_GRAY.png" alt="GRABA LOGO" width="130"/>
                                            <!-- <h1 class="h1 fw-bold mb-0"><strong>GRABA</strong></h1> -->
                                        </div>
                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Create your account</h5>
                                        <div class="row">
                                            <b-form-group
                                                class="col-md-6 col-sm-12 mb-3"
                                                label="First Name"
                                                label-for="firstname"
                                                :state="state_firstname"
                                            >
                                                <b-form-input id="firstname" v-model="firstname" :state="state_firstname" placeholder="First Name" trim></b-form-input>
                                                <b-form-invalid-feedback>{{ err_firstname }}</b-form-invalid-feedback>
                                            </b-form-group>
                                            <b-form-group
                                                class="col-md-6 col-sm-12 mb-3"
                                                label="Last Name"
                                                label-for="lastname"
                                                :state="state_lastname"
                                            >
                                                <b-form-input id="lastname" v-model="lastname" :state="state_lastname" placeholder="Last Name" trim></b-form-input>
                                                <b-form-invalid-feedback>{{ err_lastname }}</b-form-invalid-feedback>
                                            </b-form-group>
                                        </div>
                                        <div class="mb-3">
                                            <b-form-group
                                                label="Email Address"
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
                                                <b-form-input id="jobPosition" v-model="jobPosition" :state="state_jobPosition" placeholder="Job Position" trim></b-form-input>
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
                                        <div class="row mb-3">
                                            <div v-if="invalidFormat">
                                                <div class="col-12">
                                                    <span :class="pass_length ? 'text-success' : 'text-danger'">
                                                        Longer than 7 characters
                                                    </span>
                                                </div>
                                                <div class="col-12">
                                                    <span :class="has_uppercase ? 'text-success' : 'text-danger'">
                                                        Has a Capital Letter
                                                    </span>
                                                </div>
                                                 <div class="col-12">
                                                    <span :class="has_lowercase ? 'text-success' : 'text-danger'">
                                                        Have Lowercase Letter
                                                    </span>
                                                </div>   
                                                <div class="col-12">
                                                    <span :class="has_number ? 'text-success' : 'text-danger'">
                                                        Has a number
                                                    </span>
                                                </div>
                                                <div class="col-12">
                                                    <span :class="has_special ? 'text-success' : 'text-danger'">
                                                        Has a special character
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-grid mb-3">
                                            <b-button type="submit" class="btn btn-dark">Create account</b-button>
                                        </div>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Do you have an account? <router-link :to="{name: 'signin'}">Sign In here</router-link></p>
                                    </b-form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <Footer />
    </main>
</template>

<script>
    import Footer from './Footer';

    export default {
        components: {
            Footer
        },
        data() {
            return {
                firstname: "",
                lastname: "",
                email: "",
                jobPosition: "",
                password: "",
                password_confirmation: "",

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
        watch: {
            password() {
                this.pass_length = this.onValidPassword(this.password).length;
                this.has_number = this.onValidPassword(this.password).number;
                this.has_lowercase = this.onValidPassword(this.password).lowercase;
                this.has_uppercase = this.onValidPassword(this.password).uppercase;
                this.has_special = this.onValidPassword(this.password).special;

                if(this.pass_length && this.has_number && this.has_lowercase && this.has_uppercase && this.has_special) this.invalidFormat = false;
                else if(!this.password) this.invalidFormat = false;
                else this.invalidFormat = true;
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
                            });
                            this.$router.push({ name: 'signin' });
                        }
                    }
                });
            },
            onValidPassword: password => {
                const length = password.length >= 8;
                const number = /\d/.test(password);
                const lowercase = /[a-z]/.test(password);
                const uppercase = /[A-Z]/.test(password);
                const special   = /[!@#\$%\^\&*\)\(+=._-]/.test(password);
                return {length: length, number: number, lowercase: lowercase, uppercase: uppercase, special: special};
            },
        }
    }
</script>
