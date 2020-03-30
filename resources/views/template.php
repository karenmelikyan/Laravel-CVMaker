

<!---->
<!--<html>-->
<!--<head>-->
<!--    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>-->
<!--    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>-->
<!---->
<!--</head>-->
<!--<body>-->

<?php

require_once 'header.php';
?>
<form name="contact_form" >
    <input type="text" name="contact_name" placeholder="name">
</form>

<div id="app">
    {{item}}
    <template v-if="item == 1">
        <p>All OK</p>

    </template>

    <a @click="sendRequest()">Send Request</a>
</div>

<script>
    new Vue({
        el: '#app',
        data:{
            item: 0,
        },

        methods: {

            sendRequest() {
                let name = document.contact_form.contact_name.value;

                axios.get('/index.php/test/' + name)
                    .then(response => {
                        this.item = response.data
                    })
            }
        }

    })
</script>

</body>
</html>
