async function searchCep(cep) {
    if (!/\d{8}$/.test(cep)) throw TypeError('Invalid zip code');

    const info = await $.get(`https://viacep.com.br/ws/${cep}/json/`);
    
    if (info.erro) return null;
    return info;
}

/**
 * 
 * @param {object | null} opt
 * Defini uma opção de parâmetros para o ajax; 
 * option = {
 * method: String,
 * type: String,
 * url: String,
 * cache: Boolean,
 * mycustomtype: String,
 * contentType: String | Boolean,
 * processData: Boolean,
 * dataType: String,
 * async: Boolean,
 * data: Object,
 * accepts: Object,
 * xhrFields: Object,
 * statusCode: Object,
 * beforeSend: Function,
 * complete: Function,
 * error: Function,
 * dataFilter: Function,
 * success: Function,
 * complete: Function} 
 */
function reqAjax(opt) { $.ajax(opt); }



const apiNotification = {

    setPermission: async () => { return await requestPermission(); },

    /**
        * @param {Object} msg
        * message ={
        * title: String,
        * opt: {
            * badge: String,
            * body: String,
            * data: null,
            * dir: "auto",
            * icon: String,
            * image: String,
            * lang: String,
            * tag: String,
            * sound: String,
            * timestamp: Number,
            * vibrate: [Number],
            * noscreen: String,
            * sticky: Boolean,
            * renotify: Boolean,
            * actions: [Object],
            * requireInteraction: Boolean,
            * silent: Boolean
        * }
        *}
        */
    message: (msg) => {
        let notify = new Notification(msg.title, msg.opt);
        return notify
    },
}