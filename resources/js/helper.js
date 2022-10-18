import Vue from 'vue';
import moment from 'moment';

Vue.mixin({
    methods: {
        onCapitalize: (word) => {
            let arr = word.split(' ');
            let capitalize = arr.map((w) => {
                return w.charAt(0).toUpperCase() + w.slice(1);
            });
            return capitalize.join(' ');
        },
        formatDate: (date) => {
            return moment(String(date)).format('MMMM DD, YYYY');
        },
        onGetInitials(first, last) {
            return first.charAt(0).toUpperCase() + last.charAt(0).toUpperCase();
        },
        /**
         * Displaying an Alert Message
         *
         * @params {string} text - Message of an alert
         * @params {string} type - Type of an alert
         */
        onAlert(title, text, type) {
            this.$swal({
                title: title,
                text: text,
                icon: type,
                customClass: {
                    popup: `yr-modal-alert yr-modal-alert-${type}`,
                    confirmButton: `yr-modal-btn-alert yr-modal-btn-alert-${type}`,
                    title: `yr-modal-header-alert yr-modal-header-alert-${type}`,
                    htmlContainer: 'yr-modal-body-text',
                },
            });
        },
        showEntries(page, current, perPage, rows) {
            let current_page =
                rows === 0
                    ? 0
                    : current === 1
                    ? 1
                    : current * page + 1 - perPage;
            return `${current_page} - ${
                rows < current * page ? rows : current * page
            } of ${rows} entries`;
        },
    },
});
