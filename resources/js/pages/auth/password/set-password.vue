<template>
    <div class="row">
        <div class="col-12 col-lg-8 mx-auto my-4">
            <alert-success  :message="userNotFound" />
            <card :title="$t('set_password')">
                <form @submit.prevent="setPassword" @keydown="form.onKeydown($event)">
                    <alert-success :form="form" :message="status" />


                    <!-- Email -->
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
                        <div class="col-md-7">
                            <input disabled="disEmail" v-model="email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email" readonly>
                            <has-error :form="form" field="email" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right">{{ $t('password') }}</label>
                        <div class="col-md-7">
                            <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password">
                            <has-error :form="form" field="password" />
                        </div>
                    </div>

                    <!-- Password Confirmation -->
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right">{{ $t('confirm_password') }}</label>
                        <div class="col-md-7">
                            <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-control" type="password" name="password_confirmation">
                            <has-error :form="form" field="password_confirmation" />
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group row">
                        <div class="col-md-9 ml-md-auto">
                            <v-button :loading="form.busy">
                                {{ $t('set_password') }}
                            </v-button>
                        </div>
                    </div>
                </form>
            </card>
        </div>
    </div>
</template>

<script>
    import Form from 'vform'

    export default {
        middleware: 'guest',

        metaInfo () {
            return { title: this.$t('reset_password') }
        },

        data: () => ({
            status: '',
            form: new Form({
                activation_key: '',
                password: '',
                password_confirmation: ''
            }),
            disEmail: true,
            email: '',
            userNotFound: '',
        }),

        created () {
            this.getUserDetail();
        },

        methods: {

            getUserDetail: async function() {
                // get user data from store or api ?
                await axios.get('/api/password/verify-url/' + this.$route.params.id)
                    .then(response => {
                        this.email = response.data.email;
                        this.form.activation_key = response.data.activation_key;
                    }).catch(error =>{
                        this.$router.push({path:'/404'})
                    });
            },

            async setPassword () {
                const { data } = await this.form.post('/api/password/set-password')
                this.status = 'Password successfully has been set! You can login to your account now'
                this.form.reset()
            }
        }
    }
</script>
