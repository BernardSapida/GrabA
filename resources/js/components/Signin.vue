<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <main>
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xl-10">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="images/GRABA_LOGO.png" alt="GRABA LOGO" class="img-fluid"/>
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <b-form @submit.prevent="onSubmitForm">
                                        <img src="images/GRABA_GRAY.png" class="mb-3" alt="GRABA LOGO" width="130"/>
                                        <!-- <h1 class="h1 fw-bold mb-0"><strong>GRABA</strong></h1> -->
                                        <h5 class="signin-label mb-3 pb-3" style="letter-spacing: 1px">Sign into your account</h5>
                                        <b-form-group>
                                            <b-form-input
                                                v-model="email"
                                                type="text"
                                                class="form-control form-control-lg"
                                                placeholder="Enter email"
                                                :state="email_state"
                                                trim>
                                            </b-form-input>
                                            <b-form-invalid-feedback>{{ email_error }}</b-form-invalid-feedback>
                                        </b-form-group>
                                        <b-form-group>
                                             <b-form-input
                                                v-model="password"
                                                type="password"
                                                class="form-control form-control-lg"
                                                placeholder="Enter Password"
                                                autocomplete="off"
                                                :state="password_state">
                                            </b-form-input>
                                            <b-form-invalid-feedback>{{ password_error }}</b-form-invalid-feedback>
                                        </b-form-group>
                                        <div class="d-grid pt-1 mb-3">
                                            <b-form-group>
                                                <b-button
                                                    v-if="!isSaving"
                                                    class="btn btn-dark btn-lg btn-block"
                                                    type="submit">
                                                Sign in
                                                </b-button>
                                                <b-button
                                                    v-else
                                                    class="btn btn-dark btn-lg btn-block"
                                                    disabled>
                                                    <b-spinner small type="grow"></b-spinner>
                                                    Signing In
                                                </b-button>
                                            </b-form-group>
                                        </div>
                                        <p class="account-registration mb-5">
                                            Don't have an account?
                                            <router-link :to="{name: 'signup'}">Sign Up here</router-link>
                                        </p>
                                    </b-form>
                                </div>
                            </div>
                        </div>
                        <b-avatar v-b-modal.modal-scrollable badge badge-variant="dark" text="?" class="grabaInfo m-0 py-2 px-3"></b-avatar>
                        
                        <b-modal id="modal-scrollable" ref="my-modal" centered scrollable hide-footer>
                            <div slot="modal-title">
                                <img src="images/GRABA_GRAY.png" alt="GRABA LOGO" width="130"/>
                            </div>
                            <p class="my-4 text-justify">
                            "GRABA" is a user-friendly website that can be accessed online designed to provide a tracker 
                            of construction matertials inventory utilized on-site. Regular users, contractors, managers, 
                            and admins can use this website.<br/><br/>
                            This website is a pilot testing for the undergraduate capstone in partial fulfillment for our 
                            Bachelor of Science in Civil Engineering in Cavite State University - Main Campus, of the following...<br/><br/>
                            Authors: Jennielle Ann P. Tafalla, Nickerson C. Torres.<br/>
                            Developers: Enrique B. Tañada III, Bernard V. Sapida.
                            </p>
                            <div class="col-md-12 text-right">
                                <b-button class="mt-2 text-right" variant="primary" @click="toggleModal">Ok</b-button>
                            </div>
                        </b-modal>
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
                email: "",
                password: "",

                email_error: '',
                password_error: '',

                email_state: null,
                password_state: null,

                isSaving: false
            }
        },
        methods: {
            onClearErrors() {
                this.email_error = '';
                this.password_error = '';
                this.email_state = null;
                this.password_state = null;
            },
            onSubmitForm() {
                this.isSaving = true;
                this.onClearErrors();
                this.$query('saveLogin', {
                    member: {
                        email: this.email,
                        password: this.password
                    },
                }).then((res) => {
                    this.isSaving = false;

                    if (res.data.errors) {
                        let errors = Object.values(res.data.errors[0].extensions.validation).flat();
                        let errors_keys = Object.keys(res.data.errors[0].extensions.validation).flat();

                        const error_message = (name, index, state) => {
                            this[name] = errors_keys.some((q) => q == index)
                                ? errors[errors_keys.indexOf(index)]
                                : '';

                            if (this[name]) this[state] = false;
                        };

                        error_message('email_error', 'member.email', 'email_state');
                        error_message('password_error','member.password','password_state');

                    } else {
                        let response = res.data.data.saveLogin;
                        this.$store.commit('setLogin', response);
                        this.$router.push({ name: 'projects' });
                        if (response.error) {
                            this.$swal({
                                title: 'Error',
                                text: response.message,
                                icon: 'error'
                            });
                        }
                    }
                });
            },
            toggleModal() {
                this.$refs['my-modal'].toggle('#toggle-btn')
            }
        }
    }
</script>

<style lang="scss" scoped>
    main {
        position: relative;

        section {
            div.container {
                div.row {
                    div.col {
                        .grabaInfo {
                            position: fixed;
                            bottom: 40px;
                            right: 40px;
                        }
                    }
                }
            }
        }
    }
</style>
