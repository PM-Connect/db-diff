<template>
    <tr>
        <td>&hellip;</td>
        <td><input type="text" v-model="name" class="form-control input-sm" /></td>
        <td>
            <select v-model="driver" class="form-control input-sm">
                <option value="mysql">MySQL</option>
                <option value="pgsql">PostgreSQL</option>
            </select>
        </td>
        <td><input type="text" v-model="host" class="form-control input-sm" /></td>
        <td><input type="text" v-model="port" class="form-control input-sm" /></td>
        <td><input type="text" v-model="database" class="form-control input-sm" /></td>
        <td><input type="text" v-model="collation" class="form-control input-sm" /></td>
        <td><input type="text" v-model="username" class="form-control input-sm" /></td>
        <td><input type="password" v-model="password" class="form-control input-sm" /></td>
        <td>
            <button class="btn btn-sm btn-primary" @click="save">
                <i class="fa fa-fw fa-save"></i>
            </button>
        </td>
    </tr>
</template>

<script>
    import alert from "../Alerts/alert";

    export default {
        data () {
            return {
                name: null,
                host: null,
                port: 3306,
                database: null,
                username: null,
                password: null,
                driver: null,
                collation: 'utf8mb4_general_ci'
            };
        },

        methods: {
            save () {
                let database = {
                    name: this.name,
                    host: this.host,
                    port: this.port,
                    database: this.database,
                    username: this.username,
                    password: this.password,
                    driver: this.driver,
                    collation: this.collation
                };

                if (!database.name || !database.host || !database.database || !database.username || !database.password || !database.port || !database.driver) {
                    alert('Unable to save! Not enough info!', 'danger');
                } else {
                    this.$emit('save', database);
                    this.name = this.host = this.database = this.username = this.password = this.driver = null;
                    this.port = 3306;
                    this.collation = 'utf8mb4_general_ci';
                }
            },
        },
    };
</script>
