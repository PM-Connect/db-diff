class DatabaseStore {
    constructor () {
        this.state = [];
        this.load();
    }

    load () {
        this.state = JSON.parse(window.localStorage.getItem('databases')) || [];
    }

    add (database) {
        this.state.push(database);
        this.save();
    }

    remove (database) {
        let index = this.state.indexOf(database);

        if (index !== null && index !== false) {
            this.state.splice(index, 1);

            this.save();
        }
    }

    save () {
        window.localStorage.setItem('databases', JSON.stringify(this.state));
    }
}

export default new DatabaseStore;