<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div>
        <b-navbar class="px-3" toggleable="lg" type="dark" variant="gray">
            <b-navbar-brand href="#"><img src="/images/GRABA_G.png" width="40"></b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

           
            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav class="me-auto d-none d-sm-block">
                    <div v-if="(this.$route.name == 'projects')">
                        <router-link class="links" :to="{name: 'projects'}">PROJECTS</router-link>
                    </div>
                     <div v-if="(this.$route.name == 'analytics')">
                        <router-link class="links" :to="{name: 'analytics'}">ANALYTICS</router-link>
                    </div>
                     <div v-if="(this.$route.name == 'dashboard')">
                        <router-link class="links" :to="{name: 'dashboard'}">DASHBOARD</router-link>
                    </div>
                </b-navbar-nav>
                <b-navbar-nav class="graba mx-auto d-none d-sm-block">
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
