<template>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Driver</th>
                    <th>Host</th>
                    <th>Port</th>
                    <th>Database</th>
                    <th>Collation</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(database, index) in databases" is="database-row" :database="database" :index="index" @remove="deleteDatabase(database)"></tr>
                <tr is="database-new" @save="saveDatabase"></tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import DatabaseStore from '../../stores/DatabaseStore';
    import DatabaseRow from "./Row.vue";
    import DatabaseNew from "./New.vue";

    export default {
        components: {
            "database-row": DatabaseRow,
            "database-new": DatabaseNew
        },

        data () {
            return {
                databases: DatabaseStore.state
            };
        },

        methods: {
            deleteDatabase (database) {
                DatabaseStore.remove(database);
            },
            saveDatabase (database) {
                DatabaseStore.add(database);
            },
        },
    };
</script>
