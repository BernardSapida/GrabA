<template>
    <div>
        <div v-if="admin_logged_in || member_logged_in" class="yr-base-main">
            <div class="yr-base-sidebar-wrap yr-base-sidebar-wrap-fixed">
                <admin-sidebar
                    v-if="admin_logged_in"
                    :is_idle="isIdle"
                ></admin-sidebar>
                <member-sidebar
                    v-else-if="member_logged_in"
                    :is_idle="isIdle"
                    :member_data="member"
                ></member-sidebar>
            </div>
            <div class="yr-base-wrap">
                <div class="yr-base-header">
                    <admin-navbar v-if="admin_logged_in"></admin-navbar>
                    <member-navbar v-else-if="member_logged_in"></member-navbar>
                </div>
                <div class="yr-base-content">
                    <b-container fluid>
                        <router-view></router-view>
                    </b-container>
                </div>
            </div>
        </div>
        <div v-else>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    components: {
    
    },
    data() {
        return {
            admin: '',
            member: '',
            messageStr: '',
            admin_logged_in: this.onCheckAdminLoggedIn(),
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
        this.$appEvents.$on('admin-login', () => {
            this.admin_logged_in = true;
        });

        this.$appEvents.$on('admin-logout', () => {
            this.admin_logged_in = false;
        });

        this.$appEvents.$on('member-login', () => {
            this.member_logged_in = true;
        });

        this.$appEvents.$on('member-logout', () => {
            this.member_logged_in = false;
        });
    },
    methods: {
        onCheckAdminLoggedIn() {
            if (this.$store.state.admin_api_token) {
                this.$query('getAdmin').then((res) => {
                    this.admin = res.data.data.getAdmin;
                });
                return true;
            } else {
                return false;
            }
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
        onResetAdmin() {
            this.$store.commit('resetState');
            this.$appEvents.$emit('admin-logout');
            this.$router.push({ name: 'admin' });
        },
        onResetMember() {
            this.$store.commit('resetState');
            this.$appEvents.$emit('member-logout');
            this.$router.push({ name: 'member' });
        },
        onWatchComponent(is_idle) {
            if (is_idle) {
                if (this.member_logged_in || this.admin_logged_in) {
                    this.$swal({
                        title: 'Information',
                        text: 'Session expired! Please login again',
                        icon: 'info',
                        customClass: {
                            popup: 'yr-modal-alert yr-modal-alert-info',
                            confirmButton:
                                'yr-modal-btn-alert yr-modal-btn-alert-info',
                            title: 'yr-modal-header-alert yr-modal-header-alert-info',
                            htmlContainer: 'yr-modal-body-text',
                        },
                    }).then((res) => {
                        if (res.isConfirmed) {
                            if (this.admin_logged_in) {
                                this.onResetAdmin();
                            } else if (this.member_logged_in) {
                                this.onResetMember();
                            }
                        }
                    });
                }
            }
            return this.$store.state.idleVue.isIdle;
        },
    },
};
</script>
