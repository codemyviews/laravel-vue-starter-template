var Notify = require('./../../../misc/notify');

export default Vue.extend({

    data() {
        return {
            user: {},

            profile: {
                name: '',
                email: ''
            },

            password: {
                current_password: '',
                new_password: '',
                new_password_confirmation: ''
            },

            updatingProfile: false,
            updatingPassword: false
        }
    },

    ready() {
        this.fetchUser();
    },

    methods: {

        fetchUser() {
            this.$http.get('/api/users/me', (res) => {
                this.setUser(res.data);
            });
        },

        setUser(user) {
            this.user = user;

            this.profile = {
                name: user.name,
                email: user.email
            };

            this.password = {
                current_password: '',
                new_password: '',
                new_password_confirmation: ''
            };

        },

        updateProfile() {
            this.updatingProfile = true;

            this.$http.put(`/api/users/me/profile`, this.profile, (res) => {
                Notify.success('Profile settings have been updated');
                this.setUser(res.data);
            }).always(() => {
                this.updatingProfile = false;
            });
        },

        updatePassword() {
            this.updatingPassword = true;

            this.$http.put(`/api/users/me/password`, this.password, (res) => {
                Notify.success('Password settings have been updated');
                this.setUser(res.data);
            }).always(() => {
                this.updatingPassword = false;
            });
        }

    }

});