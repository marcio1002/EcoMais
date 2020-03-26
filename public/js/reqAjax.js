$('body').ready(function (){
    
    $('#submit').click(() =>{
        let data = {
            name : $('#name').val(),
            email: $("#email").val(),
            pwd: $('#pwd').val()
        };
    
        $.post( '../controller/add.php',data)
        .done((result) => {
            const res = JSON.parse(result);
            if (!res.error) {
                M.toast({html: 'Cadastro realizado com sucesso', classes: "text",outDuration: 210});
                $('input').val("");
            } else{
                M.toast({html: 'Cadastro realizado com sucesso', classes: "alert",outDuration: 210});
                return console.log(res.status,res.msg);
            } 
        })
        .fail((xhr,desc,err)=> console.log(`ErrXHR: ${xhr} \n Description: ${desc} \n Error: ${err}`));
    });

    $('#btnDltImage').click(function (){
        if(!confirm('Deseja realmente deletar!')) return;
        const data = {img: $('input[name=image]').val()};
    
        $.post('../controller/deleteImage.php', data)
            .done((result) =>{  
                const res = JSON.parse(result);
                return (!res.error) ? M.toast({html: 'Imagem deletada', classes: "text",outDuration: 210}): console.log(res.status,res.msg);
            })
            .fail((xhr,desc,err)=> console.log(`ErrXHR: ${xhr} \n Description: ${desc} \n Error: ${err}`));
    });


    $('#btnUpdate').click(function (){
        const data = {
            name: $('input[name=name]').val(),
            email: $('input[name=email]').val(),
            passwd: $('input[name=passwd]').val(),
            id: $('input[name=id]').val(),
        }
        $.post('../controller/update.php', data)
            .done((result) =>{
                const res = JSON.parse(result);
                return (!res.error) ? M.toast({html: 'Dados Atualizado', classes: "text",outDuration: 210}): console.log(res.status,res.msg);
            })
            .fail((xhr,desc,err)=> console.log(`ErrXHR: ${xhr} \n Description: ${desc} \n Error: ${err}`));
    });

    $('#btndelete').click(() =>{
        const data = { id: $('input[name=id]').val() }
        if(!confirm("Deseja realmente deletar!")) return;
        $.post('../controller/deleteUser.php',data)
            .done((result) =>{
                const res = JSON.parse(result);
                return (!res.error) ? M.toast({html: 'Usuario deleteado', classes: "text",outDuration: 210}): console.log(res.status,res.msg);
            })
            .fail((xhr,desc,err)=> console.log(`ErrXHR: ${xhr} \n Description: ${desc} \n Error: ${err}`))
    });

    $('#login').click(()  => {
        $.get('./controller/login.php',{ email: $("#email").val(),pwd: $('#pwd').val() })
            .done((result) => {
            const res = JSON.parse(result);
            console.log(res);
            if (!res.error) {
                location.href = "./motrar.php";
            } else{
                M.toast({html: 'Email ou senha inválidos', classes: "alert",outDuration: 210});
                return console.log(res.status,res.msg);
            } 
        })
        .fail((xhr,desc,err)=> {
            console.log(`ErrXHR: ${xhr.status} \n Description: ${desc} \n Error: ${err}`);
        })
    })
});