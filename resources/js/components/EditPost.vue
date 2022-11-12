<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <section>
        <Navigation/>
        <div class="container my-5">
            <b-form id="PostForm" @submit.prevent="submitPostForm($event)">
                <div class="d-flex mb-5 justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="mr-3">
                            <img src="/images/iconwithhat.png" class="rounded-circle" alt="User profile" height="70" width="70">
                        </div>
                    </div>
                    <div>
                        <b-button 
                            class="btn" 
                            variant="dark" 
                            router-link :to="{name: 'dashboard', params: { id: $route.params.id }}"
                        >
                            Cancel
                        </b-button>
                    </div>
                </div>
                <div v-if="materials_error.length > 0" class="mb-2 py-2 px-3 bg-danger text-white rounded">{{ materials_error }}</div>
                <p>List of materials</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Quantity</th>
                                 <th scope="col">Unit</th>
                                <th scope="col">Unit Cost</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody v-if="materialsDOM.length == 0">
                            <tr>
                                <td class="text-center" colspan="6">There are no records to show</td>
                            </tr>
                        </tbody>
                        <tbody v-for="(material, index) in materialsDOM" v-else :key="index">
                            <tr v-append="material"></tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex bg-red justify-content-end">
                    <b-button 
                        class="btn mt-2 mb-4" 
                        size = "sm" 
                        variant="dark" 
                        type="button"
                        @click="addMaterial"
                    >
                        Add new material
                    </b-button>
                </div>
                
                <b-row>
                     <b-col lg="6" md="6" sm="12">
                        <b-form-group>
                            <label for="fullname">Name:</label>
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
                    </b-col>
                    <b-col lg="6" md="6" sm="12">
                        <b-form-group>
                            <label for="position">Position:</label>
                            <b-form-input
                                id="position"
                                v-model="position"
                                type="text"
                                class="form-control"
                                placeholder="Position"
                                :state="position_state"
                                trim>
                            </b-form-input>
                            <b-form-invalid-feedback>{{ position_error }}</b-form-invalid-feedback>
                        </b-form-group>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col lg="6" md="6" sm="12">
                        <b-form-group>
                            <label for="hardware">Name of hardware:</label>
                            <b-form-input
                                id="hardware"
                                v-model="hardware"
                                type="text"
                                class="form-control"
                                placeholder="Name of hardware"
                                :state="hardware_state"
                                trim>
                            </b-form-input>
                            <b-form-invalid-feedback>{{ hardware_error }}</b-form-invalid-feedback>
                        </b-form-group>
                    </b-col>
                    <b-col lg="6" md="6" sm="12">
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
                    </b-col>
                </b-row>

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

                <div class="custom-file mb-5">
                    <label for="add_post_image">Choose Image</label><br>
                    <input 
                    id="add_post_image"
                    ref="image"
                    type="file" 
                    multiple
                    @change="onHandleUpload($event)">
                </div>
                <span class="text-danger mt-2">{{image_error}}</span>
                <b-carousel
                    id="carousel-fade"
                    v-if="!isActive"
                    style="text-shadow: 0px 0px 2px #000"
                    fade
                    indicators
                    img-width="1024"
                    img-height="480"
                >
                    <b-carousel-slide
                        v-for="image, index in images" :key="index"
                        :img-src=image
                    ></b-carousel-slide>
                </b-carousel>
                <div class="d-flex bg-red justify-content-end">
                    <b-button 
                        class="btn mt-2" 
                        variant="primary" 
                        type="submit"
                    >
                        Post
                    </b-button>
                </div>
            </b-form>
        </div>
        <Footer />
    </section>
</template>

<script>
    import Navigation from './Navigation';
    import Footer from './Footer';

    export default {
        components: {
            Navigation,
            Footer
        },
        data() {
            return {
                materialsList: [],
                fullname: "",
                position: "",
                hardware: "",
                address: "",
                contact: "",
                purpose: "",

                materials_error: '',
                fullname_error: '',
                position_error: '',
                hardware_error: '',
                address_error: '',
                contact_error: '',
                purpose_error: '',

                materialsDOM_state: null,
                fullname_state: null,
                position_state: null,
                hardware_state: null,
                contact_state: null,
                address_state: null,
                purpose_state: null,

                input_id: 0,
                materialsDOM: [],
                image: "",
                image_error: "",
                post: "",
                images: [],
                isActive: false,
                postId: ""
            }
        },
        watch: {
            post(p) {
                this.fullname = p.name;
                this.position = p.position;
                this.hardware = p.fullname;
                this.contact = p.contact;
                this.address = p.address;
                this.purpose = p.purpose;
                this.images = p.images;
                JSON.parse(p.materials).map((mat, index) => {
                    this.materialsDOM.push(`
                    <td>
                        <input
                            id="item_${index}"
                            name="item_${index}"
                            type="text"
                            class="form-control"
                            value="${Object.values(mat)[0]}"
                            >
                        </input>
                    </td>
                    <td>
                        <input
                            id="quantity_${index}"
                            name="quantity_${index}"
                            type="number"
                            class="form-control"
                            value="${Object.values(mat)[1]}"
                            onkeyup="document.getElementById('amount_${index}').value = this.value * document.getElementById('unitCost_${index}').value"
                            >
                        </input>
                    </td>
                    <td>
                        <input
                            id="unit_${index}"
                            name="unit_${index}"
                            type="text"
                            class="form-control"
                            value="${Object.values(mat)[2]}"
                            >
                        </-input>
                    </td>
                    <td>
                        <input
                            id="unitCost_${index}"
                            name="unitCost_${index}"
                            type="number"
                            class="form-control"
                            value="${Object.values(mat)[3]}"
                            onkeyup="document.getElementById('amount_${index}').value = this.value * document.getElementById('quantity_${index}').value"
                            >
                        </input>
                    </td>
                    <td>
                        <input
                            id="amount_${index}"
                            name="amount_${index}"
                            type="number"
                            class="form-control"
                            style="pointer-events: none;"
                            value="${Object.values(mat)[4]}"
                            >
                        </input>
                    </td>
                    <td>
                        <button 
                            class="btn btn-danger" 
                            type="button"
                            onclick="this.parentNode.parentNode.remove()"
                        >
                            Delete
                        </button>
                    </td>`);
                })
                
            }
        }, 
        created(){
            this.postId = parseInt(this.$route.params.postId)
            this.$query('getEditPost', {
                postId: this.postId,
                projectId: parseInt(this.$route.params.id)
            }).then(res => {
                this.post = res.data.data.getEditPost
            })
        },
        methods: {
            onValidate(){ 
                this.fullname != "" ?( this.fullname_error = "", this.fullname_state = null) :( this.fullname_error =  "Fullname is required", this.fullname_state = false);
                this.position != "" ?( this.position_error = "",  this.position_state = null) : (this.position_error =  "Position is required", this.position_state = false);
                this.hardware != "" ? (this.hardware_error = "", this.hardware_state = null) : (this.hardware_error =  "Hardware is required", this.hardware_state = false);
                this.contact != "" ? (this.contact_error = "" ,  this.contact_state = null) :( this.contact_error =  "Contact is required", this.contact_state = false);
                this.address != "" ? (this.address_error = "", this.address_state = null) : (this.address_error =  "Address is required", this.address_state = false);
                this.purpose != "" ? (this.purpose_error = "", this.purpose_state = null) : (this.purpose_error =  "Purpose is required", this.purpose_state = false);
                this.materialsList.length > 0 ? this.materials_error = "" : this.materials_error =  "List of materials are required" , this.materialsDOM_state = false;

                let result = !this.fullname_error && 
                        !this.position_error && 
                        !this.hardware_error && 
                        !this.contact_error && 
                        !this.address_error && 
                        !this.purpose_error && 
                        !this.materials_error;

                return result;
            }, 
            onClearFields() {
                this.materialsDOM = [];
                this.name = '';
                this.position = '';
                this.hardware = '';
                this.contact = '';
                this.address = '';
                this.purpose = '';
            },
            onClearErrors() {
                this.materialsList = [];

                this.materials_error = '';
                this.name_error = '';
                this.position_error = '';
                this.hardware_error = '';
                this.contact_error = '';
                this.address_error = '';
                this.purpose_error = '';

                this.materialsDOM_state = null;
                this.fullname_state = null;
                this.position_state = null;
                this.hardware_state = null;
                this.contact_state = null;
                this.address_state = null;
                this.purpose_state = null;
            },
            addMaterial() {
                let { input_id } = this;
                this.input_id++;
                
                this.materialsDOM.push(`
                    <td>
                        <input
                            id="item_${input_id + parseInt(JSON.parse(this.post.materials).length)}"
                            name="item_${input_id + parseInt(JSON.parse(this.post.materials).length)}"
                            type="text"
                            class="form-control"
                            >
                        </input>
                    </td>
                    <td>
                        <input
                            id="quantity_${input_id + parseInt(JSON.parse(this.post.materials).length)}"
                            name="quantity_${input_id + parseInt(JSON.parse(this.post.materials).length)}"
                            type="number"
                            step="0.01"
                            class="form-control"
                            onkeyup="document.getElementById('amount_${input_id + parseInt(JSON.parse(this.post.materials).length)}').value = this.value * document.getElementById('unitCost_${input_id + parseInt(JSON.parse(this.post.materials).length)}').value"
                            >
                        </input>
                    </td>
                    <td>
                        <input
                            id="unit_${input_id + parseInt(JSON.parse(this.post.materials).length)}"
                            name="unit_${input_id + parseInt(JSON.parse(this.post.materials).length)}"
                            type="text"
                            class="form-control"
                            >
                        </-input>
                    </td>
                    <td>
                        <input
                            id="unitCost_${input_id + parseInt(JSON.parse(this.post.materials).length) }"
                            name="unitCost_${input_id + parseInt(JSON.parse(this.post.materials).length)}"
                            type="number"
                            step="0.01"
                            class="form-control"
                            onkeyup="document.getElementById('amount_${input_id + parseInt(JSON.parse(this.post.materials).length)}').value = this.value * document.getElementById('quantity_${input_id + parseInt(JSON.parse(this.post.materials).length)}').value"
                            >
                        </input>
                    </td>
                    <td>
                        <input
                            id="amount_${input_id + parseInt(JSON.parse(this.post.materials).length)}"
                            name="amount_${input_id + parseInt(JSON.parse(this.post.materials).length)}"
                            type="number"
                            class="form-control"
                            style="pointer-events: none;"
                            value="0"
                            >
                        </input>
                    </td>
                    <td>
                        <button 
                            class="btn btn-danger" 
                            type="button"
                            onclick="this.parentNode.parentNode.remove()"
                        >
                            Delete
                        </button>
                    </td>`);
            },
            submitPostForm(e) {
                this.onClearErrors();
                this.getMaterialList(e.target)
                if (this.onValidate()) {
                    this.$query('saveEditPost', {
                        post: {
                            id: this.$route.params.postId.toString(),
                            project_id: this.$route.params.id.toString(),
                            materials: this.materialsList,
                            fullname: this.fullname,
                            position: this.position,
                            hardware: this.hardware,
                            contact: this.contact,
                            address: this.address,
                            purpose: this.purpose,
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
                                    ? (errors[errors_keys.indexOf(index)].indexOf("post.contact") != -1 ?
                                        errors[errors_keys.indexOf(index)].split("post.contact").join("contact number") 
                                        : errors[errors_keys.indexOf(index)])
                                    : '';

                                if(this[name]) this[state] = false;
                            };

                            error_message('materials_error', 'post.materials', 'materialsDOM_state');
                            error_message('fullname_error', 'post.fullname', 'fullname_state');
                            error_message('position_error', 'post.position', 'position_state');
                            error_message('hardware_error', 'post.hardware', 'hardware_state');
                            error_message('contact_error', 'post.contact', 'contact_state');
                            error_message('address_error', 'post.address', 'address_state');
                            error_message('purpose_error', 'post.purpose', 'purpose_state');
                        } else {
                            let response = res.data.data.saveEditPost;
                                this.$emit('success');
                                this.onClearFields();
                                this.onClearErrors();
                                this.$swal({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success'
                                });
                                this.$router.push({ name: 'dashboard' });

                                if (this.isActive) {
                                    this.$query('saveEditPostImage', {
                                        image: this.image,
                                        postId: this.postId
                                    }).then (res => {
                                        // console.log(res)
                                    })
                                }
                        }
                    });
                } 
                
            },
            getMaterialList(target) {
                const formData = new FormData(target);
                const data = {};
                formData.forEach((value, key) => (data[key] = value));
                const keys = Object.keys(data);
                let tempObj = {};

                if(keys.length == 0) {
                    this.materialsList = '';
                    return;
                }

                for(let i = 0; i < keys.length; i++) {
                    tempObj[keys[i]] = data[keys[i]];

                    if(data[keys[i]].length == 0 || data[keys[i]] <= 0) {
                        this.materialsList = '';
                        this.materialsDOM_state = true;
                        return;
                    }

                    if((i+1) % 5 == 0) {
                        this.materialsList.push(tempObj);
                        tempObj = {};
                    }
                }
                this.materialsList = JSON.stringify(this.materialsList);
            },
            onHandleUpload() {
                this.isActive = true;
                this.image = this.$refs.image.files;
            }
        }
    }
</script>