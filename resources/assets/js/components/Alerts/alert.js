import AlertStore from "./AlertStore";

export default (message = '', type = 'success') => {
    AlertStore.addAlert({
        type: type,
        message: message,
        hash: Math.random().toString(36).substring(7) + '$' +  Math.random().toString(16).substring(3)
    });
};