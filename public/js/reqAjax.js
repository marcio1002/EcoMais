$('document').ready(function (){
    
    $('#submit').click(() =>{
        let data = {
            name : $('#name').val(),
            email: $("#email").val(),
            pwd: $('#pwd').val()
        };
    
        $.post( '../controller/add.php',data,)
        .done(() => M.toast({html: 'Cadastrado com sucesso!'}))
        .fail((xhr,desc,err)=> console.log(`ErrXHR: ${xhr} \n Description: ${desc} \n Error: ${err}`))
    });

    $('#btnDltImage').click(function (){
        if(!confirm('Deseja realmente deletar!')) return;
        const data = {img: $('input[name=image]').val()};

        $.post('../controller/deleteImage.php', data)
            .done((data) =>{  
                const res = JSON.parse(data);
                return (!res.error) ? M.toast({html: 'Imagem deletada', classes: "text",outDuration: 210}): console.log(res.status,res.msg);
            })
            .fail((xhr,desc,err)=> console.log(`ErrXHR: ${xhr} \n Description: ${desc} \n Error: ${err}`));
    })
    $('#btnUpdate').click(function (){
        const data = {
            name: $('input[name=name]').val(),
            email: $('input[name=email]').val(),
            passwd: $('input[name=passwd]').val(),
            id: $('input[name=id]').val(),
        }
        $.post('../controller/update.php', data)
            .done((data) =>{
                const res = JSON.parse(data);
                return (!res.error) ? M.toast({html: 'Dados Atualizado', classes: "text",outDuration: 210}): console.log(res.status,res.msg);
            })
            .fail((xhr,desc,err)=> console.log(`ErrXHR: ${xhr} \n Description: ${desc} \n Error: ${err}`));
    })
    $('#btndelete').click(() =>{
        const data = { id: $('input[name=id]').val() }

        $.post('../controller/deleteUser.php',data)
            .done((data) =>{
                const res = JSON.parse(data);
                return (!res.error) ? M.toast({html: 'Usuario deleteado', classes: "text",outDuration: 210}): console.log(res.status,res.msg);
            })
            .fail((xhr,desc,err)=> console.log(`ErrXHR: ${xhr} \n Description: ${desc} \n Error: ${err}`))

    })
});