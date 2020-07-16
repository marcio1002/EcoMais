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

function isValidEmail(email) {

    const array_Exp = new Array(
        ".com",
        ".br",
        ".org",
        ".net",
        ".sp",
        ".info",
        ".biz",
        ".name",
        ".cc",
        ".ws",
        ".mobi",
        ".in",
        ".me",
        ".online",
        ".site",
        ".top",
        ".club",
        ".website",
        ".link",
        ".vc",
        ".click",
        ".cool",
        ".men",
        ".gratis",
        ".plus",
        ".legal",
        ".email",
        ".host",
        ".tech",
        ".download",
        ".cloud",
        ".digital",
        ".software",
        ".webcam",
        ".chat",
        ".blog",
        ".network",
        ".vlog",
        ".flog",
        ".sale",
        ".store",
        ".shopping",
        ".shop",
        ".promo",
        ".news",
        ".live",
        ".review",
        ".love",
        ".capital",
        ".trade",
        ".work",
        ".business",
        ".ltda",
        ".company",
        ".ind",
        ".bar",
        ".pizza",
        ".beer",
        ".fit",
        ".pub",
        ".vodka",
        ".cafe",
        ".diet",
        ".wine",
        ".delivery",
        ".studio",
        ".hospital",
        ".stream",
        ".dog",
        ".pet",
        ".camera",
        ".gardem",
        ".global",
        ".sc",
        ".us",
        ".city",
        ".world",
        ".contagem",
        ".sampa",
        ".bsb",
        ".campinas",
        ".curitiba",
        ".floripa",
        ".goiana",
        ".joinville",
        ".poa",
        ".recife",
        ".rio",
        ".pro",
        ".taxi",
        ".bio",
        ".vet",
        ".coach",
        ".adm",
        ".adv",
        ".arq",
        ".cnt",
        ".eng",
        ".eti",
        ".med",
        ".mus",
        ".odo",
        ".gov"
    );
    const expDomain = array_Exp.join("|");
    const regExp = new RegExp("(.)+\@[a-z]+(" + expDomain + "){1,3}$", "g");

    return (regExp.test(email)) ? true : false;

}
