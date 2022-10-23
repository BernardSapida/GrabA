<template>
    <div id="app">
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    components: {
    
    },
    data() {
        return {
            member: '',
            messageStr: '',
            member_logged_in: this.onCheckMemberLoggedIn(),
        };
    },
    computed: {
        isIdle() {
            if (typeof this.$store.state.idleVue.isIdle === 'boolean') {
                this.onWatchComponent(this.$store.state.idleVue.isIdle);
            }
            return this.$store.state.idleVue.isIdle;
        },
    },
    created() {
        this.$appEvents.$on('member-login', () => {
            this.member_logged_in = true;
        });

        this.$appEvents.$on('member-logout', () => {
            this.member_logged_in = false;
        });
    },
    methods: {
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

        onResetMember() {
            this.$store.commit('resetState');
            this.$appEvents.$emit('member-logout');
            this.$router.push({ name: 'signin' });
        },
        onWatchComponent(is_idle) {
            if (is_idle) {
                if (this.member_logged_in) {
                    this.$swal({
                        title: 'Information',
                        text: 'Session expired! Please login again',
                        icon: 'info'
                    }).then((res) => {
                        if (res.isConfirmed) {
                            this.onResetMember();
                        }
                    });
                }
            }
            return this.$store.state.idleVue.isIdle;
        },
    },
};
</script>
