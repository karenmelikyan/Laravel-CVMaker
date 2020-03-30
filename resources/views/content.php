<?php
require_once 'header.blade.php';
require_once 'reglog.blade.php';
require_once 'upload.blade.php';
//require_once 'personals.php';
require_once 'footer.blade.php';
?>

<script>
    var vue = new Vue({
        el: '#app',
        data:{
            user: -1,
            message: '',
            cv_step: -1,
            username: '',
        },

        methods:{

            // personalsSave(){
            //
            //     let name = document.personals.name.value;
            //     let last_name = document.personals.last_name.value;
            //     let address = document.personals.address.value;
            //     let phone = document.personals.phone.value;
            //     let email = document.personals.email.value;
            //
            //     axios.get('/index.php/personals/' + name + '/' + last_name + '/' + address + '/' + phone + '/' + email)
            //         .then(response => {
            //             this.message  = response.data.message;
            //             this.cv_step  = response.data.cv_step;
            //             this.user     = response.data.user;
            //             this.username = response.data.username;
            //         })
            // },

            // upload(){
            //     axios.get('/index.php/upload')
            //         .then(response => {
            //         //     this.message  = response.data.message;
            //         //     this.cv_step  = response.data.cv_step;
            //         //     this.user     = response.data.user;
            //         //     this.username = response.data.username;
            //          })
            // },

            logout(){
                axios.get('/index.php/logout')
                    .then(response => {
                        this.message  = response.data.message;
                        this.cv_step  = response.data.cv_step;
                        this.user     = response.data.user;
                        this.username = response.data.username;
                    })

            },

            registration(){

                let username = document.registration.username.value;
                let password = document.registration.password.value;
                let passConf = document.registration.passConf.value;

                axios.get('/index.php/registration/' + username + '/' + password + '/' + passConf)
                    .then(response => {
                        this.message  = response.data.message;
                        this.cv_step  = response.data.cv_step;
                        this.user     = response.data.user;
                        this.username = response.data.username;
                    })
            },

            login(){

                let username = document.login.username.value;
                let password = document.login.password.value;

                axios.get('/index.php/login/' + username + '/' + password)
                    .then(response => {
                        this.message  = response.data.message;
                        this.cv_step  = response.data.cv_step;
                        this.user     = response.data.user;
                        this.username = response.data.username;
                    })
            },

            reg(){
                this.user = 0;
            },

            log(){
                this.user = 1;
            },
        }
    });
</script>
