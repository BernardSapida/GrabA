<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <section>
        <Navigation/>
        <div class="container my-5">
            <b-form @submit.prevent="submitPostForm">
                <div class="d-flex mb-5 justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="mr-3">
                            <img src="/images/default.jpg" class="rounded-circle" alt="User profile" height="70" width="70">
                        </div>
                        <div class="ms-3">
                            <p class="m-0"><strong>Nickerson Torres</strong></p>
                            <p class="m-0"><strong>Site Engineer</strong></p>
                        </div>
                    </div>
                    <div>
                        <b-button 
                            class="btn" 
                            variant="primary" 
                            type="submit"
                        >
                            Add new post
                        </b-button>
                    </div>
                </div>

                <p>List of materials</p>
                <b-table striped responsive hover :items="items" :fields="fields"></b-table>

                <b-form-group>
                    <label for="Purpose">Purpose:</label>
                    <b-form-textarea
                        id="purpose"
                        v-model="purpose"
                        placeholder="Enter something..."
                        :state="purpose_state"
                        rows="3"
                        max-rows="6"
                    ></b-form-textarea>
                    <b-form-invalid-feedback>{{ purpose_error }}</b-form-invalid-feedback>
                </b-form-group>

                <b-form-group>
                    <label for="fullname">Fullname:</label>
                    <b-form-input
                        id="fullname"
                        v-model="fullname"
                        type="text"
                        class="form-control"
                        placeholder="Fullname"
                        :state="fullname_state"
                        trim>
                    </b-form-input>
                    <b-form-invalid-feedback>{{ fullname_error }}</b-form-invalid-feedback>
                </b-form-group>

                <b-form-group>
                    <label for="address">Address:</label>
                    <b-form-input
                        id="address"
                        v-model="address"
                        type="text"
                        class="form-control"
                        placeholder="Address"
                        :state="address_state"
                        trim>
                    </b-form-input>
                    <b-form-invalid-feedback>{{ address_error }}</b-form-invalid-feedback>
                </b-form-group>

                <b-form-group>
                    <label for="contact">Contact No.:</label>
                    <b-form-input
                        id="contact"
                        v-model="contact"
                        type="text"
                        class="form-control"
                        placeholder="Contact no."
                        :state="contact_state"
                        trim>
                    </b-form-input>
                    <b-form-invalid-feedback>{{ contact_error }}</b-form-invalid-feedback>
                </b-form-group>
            </b-form>
        </div>
    </section>
</template>

<script>
    import Navigation from './Navigation';

    export default {
        components: {
            Navigation
        },
        data() {
            return {
                purpose: "",
                fullname: "",
                address: "",
                contact: "",

                purpose_error: '',
                fullname_error: '',
                address_error: '',
                contact_error: '',

                purpose_state: null,
                fullname_state: null,
                address_state: null,
                contact_state: null,

                fields: [
                    {
                        key: 'quantity',
                        sortable: true
                    },
                    {
                        key: 'unit',
                        sortable: true
                    },
                    {
                        key: 'item',
                        sortable: true,
                    },
                    {
                        key: 'unit_cost',
                        sortable: true,
                    },
                    {
                        key: 'amount',
                        sortable: true,
                    }
                ],
                items: [
                    {
                        quantity: 100,
                        unit: "70 M3",
                        item: "Item 1",
                        unit_cost: 26000,
                        amount: 26000,
                    },
                    {
                        quantity: 100,
                        unit: "70 M3",
                        item: "Item 1",
                        unit_cost: 26000,
                        amount: 26000,
                    }
                ]
            }
        },
        methods: {
            onClearFields() {
                this.purpose = '';
                this.fullname = '';
                this.address = '';
                this.contact = '';
            },
            onClearErrors() {
                this.purpose_error = '';
                this.fullname_error = '';
                this.address_error = '';
                this.contact_error = '';

                this.purpose_state = null;
                this.fullname_state = null;
                this.address_state = null;
                this.contact_state = null;
            },
            submitPostForm() {
                this.onClearErrors();
                this.$query('savePost', {
                    post: {
                        id: '0',
                        materials: '[{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"},{"quantity": "100","unit": "70 M3","item": "Item 1","unit_cost": "1000","amount": "100000"}]',
                        purpose: this.purpose,
                        fullname: this.fullname,
                        address: this.address,
                        contact: this.contact,
                        project_id: this.$route.params.id
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

                            if(this[name]) this[state] = false;
                        };
                        error_message('purpose_error', 'post.purpose', 'purpose_state');
                        error_message('fullname_error', 'post.fullname', 'fullname_state');
                        error_message('address_error', 'post.address', 'address_state');
                        error_message('contact_error', 'post.contact', 'contact_state');
                    } else {
                        let response = res.data.data.savePost;
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
                        }
                    }
                });
            }
        }
    }
</script>