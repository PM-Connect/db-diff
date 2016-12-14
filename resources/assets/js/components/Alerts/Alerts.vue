<template>
    <div class="alerts">
        <alert v-for="alert in alerts" :alert="alert" :on-close="close"></alert>
    </div>
</template>

<style>
    .alerts {
        width: 300px;
        position: fixed;
        top: 10px;
        right: 10px;
    }
</style>

<script>
    import Alert from "./Alert.vue";
    import AlertStore from "./AlertStore";
    import alert from "./alert";

    export default {
        components: {
            "alert": Alert
        },

        created () {
            alert("Welcome!", "info");
        },

        data () {
            return {
                alerts: AlertStore.state
            };
        },

        methods: {
            close (alertToClose) {
                AlertStore.removeAlert(alertToClose);
            },
        },
    };
</script>
