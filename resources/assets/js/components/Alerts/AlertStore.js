const AlertStore = {
    state: [],

    addAlert (alert) {
        this.state.push(alert);
    },

    removeAlert (toClose) {
        let index = this.state.indexOf(toClose);
        this.state.splice(index, 1);
    },
};

export default AlertStore;