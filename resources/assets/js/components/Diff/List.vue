<template>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Primary Database</th>
                    <th></th>
                    <th>Secondary Database</th>
                    <th>Tables</th>
                    <th>Columns</th>
                    <th>Successful</th>
                    <th>Failures</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>&hellip;</td>
                    <td>
                        <input type="text" v-model="name" class="form-control input-sm">
                    </td>
                    <td colspan="2">
                        <select v-model="leftDatabase" class="form-control input-sm">
                            <option v-for="(database, index) in databases" :value="index">
                                {{ database.name }} ({{ database.host }}:{{ database.port }})
                            </option>
                        </select>
                    </td>
                    <td class="text-center">=></td>
                    <td colspan="5">
                        <select v-model="rightDatabase" class="form-control input-sm">
                            <option v-for="(database, index) in databases" :value="index">
                                {{ database.name }} ({{ database.host }}:{{ database.port }})
                            </option>
                        </select>
                    </td>
                    <td class="text-center">
                        <button v-if="!running" class="btn btn-sm btn-success" @click="runDiff"><i class="fa fa-fw fa-play"></i></button>
                        <button v-if="running" class="btn btn-sm btn-success" disabled><i class="fa fa-fw fa-spin fa-spinner"></i></button>
                    </td>
                </tr>
                <tr v-for="diff in diffs" is="diff-row" :diff="diff"></tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import DatabaseStore from '../../stores/DatabaseStore';
    import DiffRow from './Row.vue';
    import alert from '../Alerts/alert';

    export default {
        components: {
            'diff-row': DiffRow,
        },

        created () {
            this.loadDiffs();

            setInterval(() => {
                if (!this.loading) {
                    this.loadDiffs();
                }
            }, 3000);
        },

        data () {
            return {
                diffs: [],
                databases: DatabaseStore.state,
                leftDatabase: null,
                rightDatabase: null,
                name: null,
                loading: false,
                running: false,
            };
        },

        methods: {
            loadDiffs () {
                this.loading = true;

                this.$http.get('/api/diff').then((response) => {
                    this.diffs = response.body;
                    this.loading = false;
                }, (response) => {
                    alert('Error loading diffs!', 'danger');
                    this.loading = false;
                });
            },
            runDiff () {
                this.running = true;

                this.$http.post('/api/diff/run', {
                    name: this.name,
                    leftDatabase: this.databases[this.leftDatabase],
                    rightDatabase: this.databases[this.rightDatabase]
                }).then((response) => {
                    if (response.json.running) {
                        this.diffs.push(response.body);
                    }

                    this.running = false;

                    alert('Diff is now running!', 'success');
                }, (response) => {
                    alert('Error running diff!', 'danger');
                });
            },
        },
    };
</script>
