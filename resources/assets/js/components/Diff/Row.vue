<template>
    <tr>
        <td>{{ diff.id }}</td>
        <td>{{ diff.name }}</td>
        <td>
            <span class="text-success" v-if="!diff.running">Complete</span>
            <span class="text-warning" v-if="diff.running">Running</span>
        </td>
        <td>{{ diff.primary_database_name }}</td>
        <td>=></td>
        <td>{{ diff.secondary_database_name }}</td>
        <td>{{ diff.total_tables }}</td>
        <td>{{ diff.total_columns }}</td>
        <td class="text-success"><strong>{{ diff.successful_logs_count }}</strong></td>
        <td class="text-danger"><strong>{{ diff.failed_logs_count }}</strong></td>
        <td class="text-center">
            <a v-if="!diff.running" :href="'/diff/' + diff.id" class="btn btn-sm btn-primary">
                <i class="fa fa-fw fa-search"></i>
            </a>
            <button v-if="diff.running" class="btn btn-sm btn-primary" disabled>
                <i class="fa fa-fw fa-spin fa-spinner"></i>
            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        props: {
            diff: Object,
        },

        data () {
            return {

            };
        },
    };
</script>
