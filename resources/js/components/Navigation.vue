<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div>
        <b-navbar class="px-3" toggleable="lg" type="dark" variant="gray">
            <b-navbar-brand href="#"><img src="/images/GRABA_G.png" width="40"></b-navbar-brand>
            <div class="d-md-none d-sm-block">
                <div v-if="($route.name == 'projects')">
                    <p class="text-white m-0" style="font-size: 24px;"><strong>PROJECTS</strong></p>
                </div>
                    <div v-if="($route.name == 'analytics')">
                    <p class="text-white m-0" style="font-size: 24px;"><strong>ANALYTICS</strong></p>
                </div>
                    <div v-if="($route.name == 'dashboard')">
                    <p class="text-white m-0" style="font-size: 24px;"><strong>DASHBOARD</strong></p>
                </div>
            </div>
            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

           
            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav class="me-auto d-none d-lg-flex align-items-center">
                    <div v-if="($route.name == 'projects')">
                        <p class="text-white m-0" style="font-size: 24px;"><strong>PROJECTS</strong></p>
                    </div>
                     <div v-if="($route.name == 'analytics')">
                        <p class="text-white m-0" style="font-size: 24px;"><strong>ANALYTICS</strong></p>
                    </div>
                     <div v-if="($route.name == 'dashboard')">
                        <p class="text-white m-0" style="font-size: 24px;"><strong>DASHBOARD</strong></p>
                    </div>
                </b-navbar-nav>
                <b-navbar-nav class="graba mx-auto d-none d-lg-block">
                    <b-navbar-brand href="#">
                    <img src="/images/white.png" width="120">
                    </b-navbar-brand>
                </b-navbar-nav>
                <b-navbar-nav class="ml-auto">
                    <b-nav-item @click="onLogout">Sign Out</b-nav-item>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                member: '',
            };
        },
        created() {
            this.onCheckMemberLoggedIn();
        },
        methods: {
            onLogout() {
                this.$store.commit('resetState');
                this.$appEvents.$emit('member-logout');
                this.$router.push({ name: 'signin' });
            },
            onCheckMemberLoggedIn() {
                if (this.$store.state.member_api_token) {
                    this.$query('getMember').then((res) => {
                        this.member = res.data.data.getMember;
                    });
                    return true;
                } else {
                    return false;
                }
            },
        }
    };
</script>
