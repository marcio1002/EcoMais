let connection;

/**
 * funções para manipular os elementos
 * 1 - Limpar os inputs,
 * 2 - Eventos de conexão
 * 3 - Verificação de email
 */

window.ononline = () => {
    // if (connection === "OFFLINE") 
    connection = "ONLINE";
};
window.onoffline = () => {
    connection = "OFFLINE";
};
