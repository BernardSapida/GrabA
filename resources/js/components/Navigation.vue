<template>
    <div id="app">
        <b-navbar class="px-3" toggleable="lg" type="dark" variant="dark">
            <b-navbar-brand href="#"><img src="images/GRABA_G.png" width="40"></b-navbar-brand>
            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav class="me-auto">
                    <div v-if="(this.$route.name == 'analytics' || this.$route.name == 'dashboard')">
                        <router-link class="nav-link" :to="{name: 'projects'}">Projects</router-link>
                    </div>
                    <div v-if="this.$route.name == 'projects'">
                        <router-link class="nav-link" :to="{name: 'analytics', params: { id: 1 }}">Analytics</router-link>
                    </div>
                </b-navbar-nav>
                <b-navbar-nav class="me-right">
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
    },
};
</script>
