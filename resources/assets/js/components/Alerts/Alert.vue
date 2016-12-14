<template>
    <div :class="'alert alert-' + alert.type">
        {{ alert.message }}
    </div>
</template>

<script>
    export default {
        props: {
            alert: Object,
            onClose: Function,
        },

        created () {
            this.timeout = setTimeout(() => {
                this.onClose(this.alert);
            }, this.alert.timeout || 3000);
        },

        data () {
            return {
                timeout: null
            };
        },
    };
</script>
