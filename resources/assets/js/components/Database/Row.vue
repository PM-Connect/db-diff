<template>
    <tr>
        <td>#{{ index }}</td>
        <td>{{ database.name }}</td>
        <td>{{ database.driver }}</td>
        <td>{{ database.host }}</td>
        <td>{{ database.port }}</td>
        <td>{{ database.database }}</td>
        <th>{{ database.collation }}</th>
        <td>{{ database.username }}</td>
        <td>{{ protectedPassword }}</td>
        <td>
            <button class="btn btn-sm btn-danger" @click="remove">
                <i class="fa fa-fw fa-times"></i>
            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ["index", "database"],

        data () {
            return {

            };
        },

        methods: {
            remove () {
                this.$emit('remove');
            },
        },

        computed: {
            protectedPassword () {
                return "*".repeat(this.database.password.length || 0);
            }
        },
    }
</script>
